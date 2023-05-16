<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function servicemanage()
    {
        return $this->belongsTo(ServiceManage::class,'service_manage_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
