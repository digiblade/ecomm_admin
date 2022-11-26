<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->hasOne(productModel::class, "product_id", "cart_productid")->with('category')->with('documents');
    }
    public function documents()
    {
        return $this->hasMany(documentModel::class, "document_parentid", "product_id")->where("document_label", "=", "product")->where("document_isactive", "=", 1);
    }
}
