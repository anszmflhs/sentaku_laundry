<?php

namespace App\Common;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CommonFunction
{
    public static function uploadImage(Request $request)
    {
        $image = $request->file('photo');
        $fileName = time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('uploads/users/') . $fileName;
        Image::make($image->getRealPath())->resize(100, 100)->save($path);
        return $fileName;
    }

    public static function deleteImage($path)
    {
        if (File::exists($path)) {
            File::delete($path);
        }

    }
}
