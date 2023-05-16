<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceManage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function karyawans()
    {
        return $this->hasMany(Karyawan::class);
    }
}
