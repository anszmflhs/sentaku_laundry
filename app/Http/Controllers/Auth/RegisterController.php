<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
        $input = [
            'name' => $req->input('name'),
            'email' => $req->input('email'),
            'password' => $passwordHash
        ];

        $user = User::create($input);

        $token = $user->createToken('authToken')->plainTextToken;

        $user->assignRole($req->input('role'));

        $response = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->getRoleNames()->first(),
            'token' => $token
        ];

        return redirect()->intended('/login')->with('success', 'Register Sucesess');;
    }
    public function register(Request $request)
    {
        $data = $request->only(['name', 'email', 'password']);
        $validator = validator($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);
        $credentials = $request->only(['name', 'email', 'password']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return redirect()->intended('/login')->with('success', 'Register Sucesess');
        }
        return redirect('register')->with('error', 'Invalid name, username, or password');
        $data['password'] = Hash::make($data['password']);

        // $user = User::create($data);
        // $token = $user->createToken('TokenBackend')->plainTextToken;
        // return response()->json([
        //     'status' => true,
        //     'access_token' => $token,
        //     'data' => $user,
        // ]);
    }
}
