<?php

namespace App\Http\Controllers\Admin;

use App\Common\CommonDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return response()->json(
            [
                'status' => true,
                'data' => $roles,
            ]
        );
    }

    public function show($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Role Not Found'
                ],
                404
            );
        }
        return response()->json(
            [
                'status' => true,
                'data' => $role
            ]
        );
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $rules = [
            'name' => 'required',
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $validator->errors()
                ],
                400
            );
        }

        $role = Role::create($data);

        return response()->json([
            'status' => true,
            'data' => $role,
        ]);
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'data not found'
                ],
                404
            );
        }
        $role->update($request->all());
        return response()->json([
            'status' => true,
            'data' => $role,
        ]);
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'data not found'
                ],
                404
            );
        }
        $role->delete();
        return response()->json([
            'status' => true,
            'message' => 'data succcessfully deleted'
        ]);
    }
}
