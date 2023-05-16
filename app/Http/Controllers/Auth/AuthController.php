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
        $this->middleware('guest')->except('logout');
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

    public function registerUser(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
            'password' => 'required|string|min:8',
            // 'confirm_password' => 'required|same:password',
            'role' => 'required|exists:roles,name'
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

        return response()->json(
            [
                'status' => true,
                'message' => 'Register succeed',
                'data' => $response
            ]
        );
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
            ]);
        }

        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            return redirect()->intended('/dashboard')->with('success', 'Success login');
            // response()->json([
            //     'status' => true,
            //     'data' => $user,
            //     'token' => $token,
            //     'message' => 'login berhasil'
            // ]);
        }
        return redirect('login')->with('error', 'Invalid username or password');
        // response()->json([
        //     'status' => false,
        //     'message' => 'login gagal: email atau password tidak valid'
        // ], 401);
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
