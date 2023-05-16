<?php

namespace App\Common;

use Yajra\DataTables\Facades\DataTables;

class CommonDatatable
{
    public static function create($data)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn(
                'action',
                function ($row) {
                    $btn = '<a href="javascript:void(0)" id="' . $row->id . '"  class="btn btn-warning btn-sm edit-button">Edit</a>';

                    $btn .= ' <a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-sm delete-button">Delete</a>';

                    return $btn;
                }

            )
            ->rawColumns(['action'])
            ->make(true);
    }
}
