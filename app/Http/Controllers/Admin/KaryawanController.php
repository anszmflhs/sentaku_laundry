<?php

namespace App\Http\Controllers\Admin;

use App\Common\CommonDatatable;
use App\Common\CommonFunction;
use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\ServiceManage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = Karyawan::with(['user', 'servicemanage'])->latest()->get();
            return CommonDatatable::create($data);
        }
        return view('admin.karyawan.index');
    }
    public function create()
    {
        $karyawan = Karyawan::all();
        $service_manages = ServiceManage::all();
        return view('admin.karyawan.create', compact('karyawan', 'service_manages'));
    }

    public function store(Request $request)
    {
        $inputKaryawan = $request->only([
            'photo',
            'name',
            'contact',
            'hire_date',
            'gender',
            'address',
            'service_manage_id',
            'user_id',
        ]);

        $inputUser = $request->only([
            'name',
            'email',
            'password',
        ]);
        $this->validateReq($request, false);
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('uploads/users/', $fileName);
            $inputKaryawan['photo'] = $fileName;
        }

        $inputUser['password'] = Hash::make('karyawan1234');
        $user = User::create($inputUser);
        $user->assignRole('karyawan');

        $inputKaryawan['user_id'] = $user->id;
        Karyawan::create($inputKaryawan);
        return redirect()->route('karyawan.index')->with('success', 'Data berhasil ditambahkan');
    }
    public function edit($id)
    {
        $karyawan = Karyawan::find($id);
        $service_manages = ServiceManage::all();
        return view('admin.karyawan.edit', compact('karyawan', 'service_manages'));
    }
    public function update(Request $request, $id)
    {
        $inputKaryawan = $request->only([
            'photo',
            'name',
            'contact',
            'hire_date',
            'gender',
            'address',
            'service_manage_id',
        ]);
        $karyawan = $this->validateFind($id);
        $this->validateReq($request, true);

        if ($request->hasFile('photo')) {
            $path = 'uploads/users/' . $karyawan->photo;
            CommonFunction::deleteImage($path);
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('uploads/users/', $fileName);
            $inputKaryawan['photo'] = $fileName;
        }
        $karyawan->update($inputKaryawan);
        return redirect()->route('karyawan.index')->with('success', 'Sukses Update Data');
    }
    public function destroy($id)
    {
        $karyawan = $this->validateFind($id);
        $path = 'uploads/users/' . $karyawan->photo;
        CommonFunction::deleteImage($path);
        $karyawan->delete();
        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
    private function validateFind($id)
    {
        $karyawan = Karyawan::find($id);
        if (!$karyawan) {
            return response()->json([
                'error' => 'Karyawan not found'
            ]);
        }
        return $karyawan;
    }

    private function validateReq(Request $req, bool $isUpdate)
    {
        if ($isUpdate) {
            $req->validate(
                [
                    'photo' => 'nullable|image|mimes:jpg,jpeg,png|file|max:1024',
                    'name' => 'required|string|max:255',
                    'contact' => 'required|string|max:20',
                    'hire_date' => 'required|date',
                    'gender' => 'required|string|in:L,P',
                    'address' => 'nullable|string',

                ]
            );
        } else {
            $req->validate(
                [
                    'photo' => 'nullable|image|mimes:jpg,jpeg,png|file|max:1024',
                    'name' => 'required|string|max:255',
                    'contact' => 'required|string|max:20',
                    'hire_date' => 'required|date',
                    'gender' => 'required|string|in:L,P',
                    'address' => 'nullable|string',

                ]
            );
        }
    }





    // public function index()
    // {
    //     $karyawans = Karyawan::with(['user','servicemanage'])->latest()->get();
    //     return response()->json(
    //         [
    //             'status' => true,
    //             'data' => $karyawans,
    //         ]
    //     );
    // }

    // public function show($id)
    // {
    //     $karyawan = Karyawan::find($id);
    //     if (!$karyawan) {
    //         return response()->json(
    //             [
    //                 'status' => false,
    //                 'message' => 'Karyawan Not Found'
    //             ],
    //             404
    //         );
    //     }
    //     return response()->json(
    //         [
    //             'status' => true,
    //             'data' => $karyawan
    //         ]
    //     );
    // }

    // public function create(Request $request)
    // {
    //     $data = $request->all();
    //     $rules = [
    //         'name' => 'required',
    //         'contact' => 'required',
    //         'hire_date' => 'required',
    //         'gender' => 'required',
    //         'address' => 'required',
    //         'photo' => 'required',
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

    //     $karyawan = Karyawan::create($data);

    //     return response()->json([
    //         'status' => true,
    //         'data' => $karyawan,
    //     ]);
    // }

    // public function update(Request $request, $id)
    // {
    //     $karyawan = Karyawan::find($id);
    //     if (!$karyawan) {
    //         return response()->json(
    //             [
    //                 'status' => false,
    //                 'message' => 'data not found'
    //             ],
    //             404
    //         );
    //     }
    //     $karyawan->update($request->all());
    //     return response()->json([
    //         'status' => true,
    //         'data' => $karyawan,
    //     ]);
    // }

    // public function destroy($id)
    // {
    //     $karyawan = Karyawan::find($id);
    //     if (!$karyawan) {
    //         return response()->json(
    //             [
    //                 'status' => false,
    //                 'message' => 'data not found'
    //             ],
    //             404
    //         );
    //     }
    //     $karyawan->delete();
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'data succcessfully deleted'
    //     ]);
    // }
}
