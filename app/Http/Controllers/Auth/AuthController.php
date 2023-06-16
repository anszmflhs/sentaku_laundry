<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }
    public function viewLogin()
    {
        return view('auth.login');
    }
    public function logout()
    {
        session()->flush();
        auth()->logout();
        return redirect()->route('login.view');
    }

    public function loginUser(Request $request)
    {

        $input = $request->all();

        $rules = [
            'email' => 'required|email',
            //ditetapkan input dengan email format

            'password' => 'required|min:8',
            //ditetapkan minimal pass yaitu 8
        ];

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $credentials = $request->only(['email', 'password']);
        // return dd($credentials);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // return redirect('/dashboard')->with('success', 'Login Sucesess');
            $token = $user->createToken('authToken')->plainTextToken;

            $response = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'customer' => $user->customer

            ];
            return response()->json([
                'status' => true,
                'access_token' => $token,
                'data' => $response,
            ]);
        }
        // return redirect('/login')->with('failed', 'Login Failed');
        return response()->json([
            'status' => false,
            'message' => 'login gagal: email atau password tidak valid'
        ], 401);

    }
    public function logoutUser(Request $req)
    {
        auth()->user()->currentAccessToken()->delete();
        return response()->json(
            [
                'status' => true,
                'message' => 'Logout succeed',
            ]
        );
    }
}
