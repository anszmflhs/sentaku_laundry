<?php

namespace App\Http\Controllers\Admin;

use App\Common\CommonDatatable;
use App\Http\Controllers\Controller;
use App\Models\PriceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PriceListController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = PriceList::latest()->get();
            return CommonDatatable::create($data);
        }
        return view('admin.pricelist.index');
    }
    public function indexs()
    {
        $price_lists = PriceList::all();
        return response()->json(
            [
                'status' => true,
                'data' => $price_lists,
            ]
        );
    }
    public function create()
    {
        $price_lists = PriceList::all();
        return view('admin.pricelist.create', compact('price_lists'));
    }
    public function creates(Request $request)
    {
        $data = $request->all();
        $pricelist = PriceList::create($data);

        return response()->json([
            'status' => true,
            'data' => $pricelist,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'quantity' => 'required',
            'harga' => 'required',
            'another' => 'required',
            'hargaanother' => 'required'
        ]);

        PriceList::create($request->all());

        return redirect()->route('pricelist.index');
    }
    public function edit($id)
    {
        $pricelist = PriceList::find($id);
        return view('admin.pricelist.edit', compact('pricelist'));
    }
    public function update(Request $request, $id)
    {
        $inputPri = $request->only([
            'quantity',
            'harga',
            'another',
            'hargaanother'
        ]);
        // return dd($inputPri);
        $pri = $this->validateFind($id);
        $this->validateReq($request, true);

        $pri->update($inputPri);
        return redirect()->route('pricelist.index');
    }
    public function destroy($id)
    {
        $pricelist = $this->validateFind($id);
        $pricelist->delete();
        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
    private function validateFind($id)
    {
        $pricelist = PriceList::find($id);
        if (!$pricelist) {
            return response()->json([
                'error' => 'Pricelist not found'
            ]);
        }
        return $pricelist;
    }
    private function validateReq(Request $req, bool $isUpdate)
    {
        if ($isUpdate) {
            $req->validate(
                [
                    'quantity' => 'required|string|max:255',
                    'harga' => 'required|string|max:255',
                    'another' => 'required|string|max:255',
                    'hargaanother' => 'required|string|max:255'

                ]
            );
        } else {
            $req->validate(
                [
                    'quantity' => 'required|string|max:255',
                    'harga' => 'required|string|max:255',
                    'another' => 'required|string|max:255',
                    'hargaanother' => 'required|string|max:255'
                ]
            );
        }
    }
}

//     public function show($id)
//     {
//         $price_list = PriceList::find($id);
//         if (!$price_list) {
//             return response()->json(
//                 [
//                     'status' => false,
//                     'message' => 'Price List Not Found'
//                 ],
//                 404
//             );
//         }
//         return response()->json(
//             [
//                 'status' => true,
//                 'data' => $price_list
//             ]
//         );
//     }

//     public function create(Request $request)
//     {
//         $data = $request->all();
//         $rules = [
//             'name' => 'required',
//             'harga' => 'required',
//         ];

//         $validator = Validator::make($data, $rules);
//         if ($validator->fails()) {
//             return response()->json(
//                 [
//                     'status' => false,
//                     'message' => $validator->errors()
//                 ],
//                 400
//             );
//         }

//         $price_list = PriceList::create($data);

//         return response()->json([
//             'status' => true,
//             'data' => $price_list,
//         ]);
//     }

//     public function update(Request $request, $id)
//     {
//         $price_list = PriceList::find($id);
//         if (!$price_list) {
//             return response()->json(
//                 [
//                     'status' => false,
//                     'message' => 'data not found'
//                 ],
//                 404
//             );
//         }
//         $price_list->update($request->all());
//         return response()->json([
//             'status' => true,
//             'data' => $price_list,
//         ]);
//     }

//     public function destroy($id)
//     {
//         $price_list = PriceList::find($id);
//         if (!$price_list) {
//             return response()->json(
//                 [
//                     'status' => false,
//                     'message' => 'data not found'
//                 ],
//                 404
//             );
//         }
//         $price_list->delete();
//         return response()->json([
//             'status' => true,
//             'message' => 'data succcessfully deleted'
//         ]);
//     }
// }
