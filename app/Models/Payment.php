<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function servicemanage()
    {
        return $this->belongsTo(ServiceManage::class,'service_manages_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function pricelist()
    {
        return $this->belongsTo(PriceList::class,'price_lists_id');
    }

}
