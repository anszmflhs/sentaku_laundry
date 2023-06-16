<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
public function viewRegister()
    {
        return view('auth.register');
    }

public function registerUser(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
            'nohp' => 'required|string',
            'alamat' => 'required|string',
            'password' => 'required|string|min:8',
            // 'confirm_password' => 'required|same:password',
            // 'role' => 'required|exists:roles,name'
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $validator->errors(),
                    'data' => []
                ]
            );
        }

        $passwordHash = Hash::make($req->input('password'));


        $user = User::create([
            'name' => $req->input('name'),
            'email' => $req->input('email'),
            'password' => $passwordHash
        ]);

        $customer = Customer::create([
            'nohp' => $req->input('nohp'),
            'alamat' => $req->input('alamat'),
            'user_id' => $user->id
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        $user->assignRole('customer');

        $response = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->getRoleNames()->first(),
            'token' => $token
        ];

        return redirect('/login')->with('success', 'Register Sucesess');
    }
    public function register(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
            'nohp' => 'required|string',
            'alamat' => 'required|string',
            'password' => 'required|string|min:8',
            // 'confirm_password' => 'required|same:password',
            // 'role' => 'required|exists:roles,name'
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $validator->errors(),
                    'data' => []
                ]
            );
        }

        $passwordHash = Hash::make($req->input('password'));


        $user = User::create([
            'name' => $req->input('name'),
            'email' => $req->input('email'),
            'password' => $passwordHash
        ]);

        $customer = Customer::create([
            'nohp' => $req->input('nohp'),
            'alamat' => $req->input('alamat'),
            'user_id' => $user->id
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        $user->assignRole('customer');

        $response = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'customer' => $customer

        ];
        return response()->json([
            'status' => true,
            'access_token' => $token,
            'data' => $response,
        ]);
    }
}
