<?php

namespace App\Http\Controllers\Admin;

use App\Common\CommonDatatable;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\JobDetail;
use App\Models\Payment;
use App\Models\PriceList;
use App\Models\ServiceManage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Payment::with(['user.customer', 'servicemanage', 'pricelist'])->latest()->get();
            return CommonDatatable::create($data);
        }
        return view('admin.payment.index');
    }
    public function create()
    {
        $users = User::all();
        $service_manages = ServiceManage::all();
        $price_lists = PriceList::all();
        return view('admin.payment.create', compact('users', 'service_manages', 'price_lists'));
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'user_id' => 'required',
            'service_manages_id' => 'required',
            'price_lists_id' => 'required',
            'quantity' => 'required',
            'total' => 'required',
            'status' => 'required',
        ]);
        $user = User::find($input['user_id']);
        if (!$user) {
            abort(404);
        }

        $servicemanage = ServiceManage::find($input['service_manages_id']);
        if (!$servicemanage) {
            abort(404);
        }
        $pricelist = PriceList::find($input['price_lists_id']);
        if (!$pricelist) {
            abort(404);
        }

        // return dd($input);

        Payment::create($input);
        return redirect()->route('payment.index')->with('success', 'Data berhasil ditambahkan');
    }
    public function edit($id)
    {
        $payments = Payment::find($id);
        $users = User::all();
        $service_manages = ServiceManage::all();
        $price_lists = PriceList::all();
        return view('admin.payment.edit', compact('payments','users', 'service_manages', 'price_lists'));
    }
    public function update(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'user_id' => 'required',
            'service_manages_id' => 'required',
            'price_lists_id' => 'required',
            'quantity' => 'required',
            'total' => 'required',
            'status' => 'required',
        ]);
        $user = User::find($input['user_id']);
        if (!$user) {
            abort(404);
        }

        $servicemanage = ServiceManage::find($input['service_manages_id']);
        if (!$servicemanage) {
            abort(404);
        }
        $pricelist = PriceList::find($input['price_lists_id']);
        if (!$pricelist) {
            abort(404);
        }

        // return dd($input);

        Payment::create($input);
        return redirect()->route('payment.index')->with('success', 'Data berhasil ditambahkan');
    }
    public function destroy($id)
    {
        $payments = Payment::find($id);
        $payments->delete();
        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
    private function validateReq(Request $req)
    {
        $req->validate([
            'user_id' => 'required',
            'service_manages_id' => 'required',
            'price_lists_id ' => 'required',
            'quantity' => 'required',
            'total' => 'required',
            'status' => 'required',
        ]);
    }



    // public function index()
    // {
    //     $payments = Payment::all();
    //     return response()->json(
    //         [
    //             'status' => true,
    //             'data' => $payments,
    //         ]
    //     );
    // }

    // public function show($id)
    // {
    //     $payment = Payment::find($id);
    //     if (!$payment) {
    //         return response()->json(
    //             [
    //                 'status' => false,
    //                 'message' => 'Payment Not Found'
    //             ],
    //             404
    //         );
    //     }
    //     return response()->json(
    //         [
    //             'status' => true,
    //             'data' => $payment
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

    //     $payment = Payment::create($data);

    //     return response()->json([
    //         'status' => true,
    //         'data' => $payment,
    //     ]);
    // }

    // public function update(Request $request, $id)
    // {
    //     $payment = Payment::find($id);
    //     if (!$payment) {
    //         return response()->json(
    //             [
    //                 'status' => false,
    //                 'message' => 'data not found'
    //             ],
    //             404
    //         );
    //     }
    //     $payment->update($request->all());
    //     return response()->json([
    //         'status' => true,
    //         'data' => $payment,
    //     ]);
    // }

    // public function destroy($id)
    // {
    //     $payment = Payment::find($id);
    //     if (!$payment) {
    //         return response()->json(
    //             [
    //                 'status' => false,
    //                 'message' => 'data not found'
    //             ],
    //             404
    //         );
    //     }
    //     $payment->delete();
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'data succcessfully deleted'
    //     ]);
    // }
}
