<?php

namespace App\Http\Controllers\Admin;

use App\Common\CommonDatatable;
use App\Http\Controllers\Controller;
use App\Models\JobDetail;
use App\Models\ServiceManage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceManageController extends Controller
{
    public function index()
    {
        $service_manages = ServiceManage::all();
        return response()->json(
            [
                'status' => true,
                'data' => $service_manages,
            ]
        );
    }
    public function indexs()
    {
        $service_manages = ServiceManage::all();
        return response()->json(
            [
                'status' => true,
                'data' => $service_manages,
            ]
        );
    }

    public function show($id)
    {
        $service_manage = ServiceManage::find($id);
        if (!$service_manage) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Service Manage Not Found'
                ],
                404
            );
        }
        return response()->json(
            [
                'status' => true,
                'data' => $service_manage
            ]
        );
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $rules = [
            'title' => 'required',
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

        $service_manage = ServiceManage::create($data);

        return response()->json([
            'status' => true,
            'data' => $service_manage,
        ]);
    }
    public function creates(Request $request)
    {
        $data = $request->all();
        $servicemanage = ServiceManage::create($data);

        return response()->json([
            'status' => true,
            'data' => $servicemanage,
        ]);
    }

    public function update(Request $request, $id)
    {
        $service_manage = ServiceManage::find($id);
        if (!$service_manage) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'data not found'
                ],
                404
            );
        }
        $service_manage->update($request->all());
        return response()->json([
            'status' => true,
            'data' => $service_manage,
        ]);
    }

    public function destroy($id)
    {
        $service_manage = ServiceManage::find($id);
        if (!$service_manage) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'data not found'
                ],
                404
            );
        }
        $service_manage->delete();
        return response()->json([
            'status' => true,
            'message' => 'data succcessfully deleted'
        ]);
    }
}
