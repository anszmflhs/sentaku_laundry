<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class UserPermissionController extends Controller
{
    public function syncPermission(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User id tidak ditemukan'
            ], 404);
        }

        $input = $request->all();

        $rules = [
            'permission.*' => 'required|exists:permissions,name'
        ];

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $user->syncPermissions($input['permission']);
        return response()->json([
            'status' => true,
            'data' => $user,
            'message' => 'User berhasil di synchronize'
        ]);
    }
}
