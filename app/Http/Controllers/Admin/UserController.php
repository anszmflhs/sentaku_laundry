<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $user = User::latest()->get();
        return response()->json([
            'status' => true,
            'data' => 'data berhasil ditampilkan'
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $rules = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ];

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }
        $input['password'] = Hash::make($input['password']);
        $users = User::create($input);
        return response()->json([
            'status' => true,
            'data' => $users,
            'message' => 'MWHAHAHAHAHA',
        ]);

    }
}
