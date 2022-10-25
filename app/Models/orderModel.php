<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\shippingStatusModel;
use App\Models\productSetModel;
use App\Models\addressModel;

class orderModel extends Model
{
    use HasFactory;
    public function status(){
        return $this->hasOne(shippingStatusModel::class,"shipping_orderid","order_id");
    }
    public function product(){
        return $this->hasOne(productSetModel::class,"product_set_id","product_setid");
    }
    public function address(){
        return $this->hasOne(addressModel::class,"address_id","order_deliveryid");
    }
   
}
