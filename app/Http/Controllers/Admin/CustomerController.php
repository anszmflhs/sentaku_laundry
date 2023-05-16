<?php

namespace App\Http\Controllers\Admin;

use App\Common\CommonDatatable;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Karyawan;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['permission:read-customer'])->only(['index']);
    //     $this->middleware(['permission:create-customer'])->only(['store']);
        // $this->middleware(['permission:update-department'])->only(['edit', 'update']);
        // $this->middleware(['permission:delete-department'])->only(['destroy']);
    // }
    public function index()
    {
        if (request()->ajax()) {
            $data = Customer::with('user')->latest()->get();
            return CommonDatatable::create($data);
        }
        return view('admin.customer.index');
    }
    public function store(Request $request)
    {
        $inputCustomer = $request->only([
            'status',
            'nohp',
            'alamat'
        ]);

        $inputUser = $request->only([
            'name',
            'email',
            'password',
        ]);
        $role = $request->input('role');
        $this->validateReq($request, false);

        $inputUser['password'] = Hash::make('customer1234');
        $user = User::create($inputUser);
        $user->assignRole($role);

        $inputCustomer['user_id'] = $user->id;
        Customer::create($inputCustomer);
        return redirect()->route('customer.index')->with('success', 'Data berhasil ditambahkan');
    }
    public function create()
    {
        $customer = Customer::all();
        return view('admin.customer.create', compact('customer'));
    }
    public function edit($id)
    {
        $customer = $this->validateFind($id);
        return view('admin.customer.edit', compact('customer'));
    }
    public function update(Request $request, $id)
    {
        $inputCustomer = $request->only([
            'status',
            'nohp',
            'alamat'

        ]);

        $inputUser = $request->only([
            'name',
            'email',
            'password',
        ]);

        $customer = $this->validateFind($id);
        $this->validateReq($request, true);
        $role = $request->input('role');

        if (isset($inputCustomer)) {
            $customer->user()->update($inputUser);
        }

        if (isset($role)) {
            $customer->user()->syncRoles($role);
        }

        $customer->update($inputCustomer);
        return redirect()->route('customer.index')->with('success', 'Sukses Update Data');

    }

    public function destroy($id)
    {
        $customer = $this->validateFind($id);
        $user = User::find($customer->user_id);
        $customer->delete();
        $user->delete();
        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);

    }

    private function validateFind($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json([
                'error' => 'Customer not found'
            ]);
        }
        return $customer;
    }
    private function validateReq(Request $req, bool $isUpdate)
    {
        if ($isUpdate) {
            $req->validate(
                [
                    'nohp' => 'required|string|max:20',
                    'alamat' => 'nullable|string',
                    'status' => 'required|string|in:Inactive,Active',
                ]
            );
        } else {
            $req->validate(
                [
                    'nohp' => 'required|string|max:20',
                    'alamat' => 'nullable|string',
                    'status' => 'required|string|in:Inactive,Active',
                ]
            );
        }
    }


















    // public function index()
    // {
    //     $customers = Customer::all();
    //     return response()->json(
    //         [
    //             'status' => true,
    //             'data' => $customers,
    //         ]
    //     );
    // }

    // public function show($id)
    // {
    //     $customer = Customer::find($id);
    //     if (!$customer) {
    //         return response()->json(
    //             [
    //                 'status' => false,
    //                 'message' => 'Customer Not Found'
    //             ],
    //             404
    //         );
    //     }
    //     return response()->json(
    //         [
    //             'status' => true,
    //             'data' => $customer
    //         ]
    //     );
    // }

    // public function create(Request $request)
    // {
    //     $data = $request->all();
    //     $rules = [
    //         'status' => 'required',
    //     ];

    //     $validator = Validator::make($data, $rules);
    //     if ($validator->fails()) {
    //         return response()->json(
    //             [
    //                 'status' => false,
    //                 'message' => $validator->errors()
    //             ],
    //             400
    //         );
    //     }

    //     $customer = Customer::create($data);

    //     return response()->json([
    //         'status' => true,
    //         'data' => $customer,
    //     ]);
    // }

    // public function update(Request $request, $id)
    // {
    //     $customer = Customer::find($id);
    //     if (!$customer) {
    //         return response()->json(
    //             [
    //                 'status' => false,
    //                 'message' => 'data not found'
    //             ],
    //             404
    //         );
    //     }
    //     $customer->update($request->all());
    //     return response()->json([
    //         'status' => true,
    //         'data' => $customer,
    //     ]);
    // }

    // public function destroy($id)
    // {
    //     $customer = Customer::find($id);
    //     if (!$customer) {
    //         return response()->json(
    //             [
    //                 'status' => false,
    //                 'message' => 'data not found'
    //             ],
    //             404
    //         );
    //     }
    //     $customer->delete();
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'data succcessfully deleted'
    //     ]);
    // }
}
