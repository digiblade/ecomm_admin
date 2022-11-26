<?php

namespace App\Models\OrderModule;

use App\Models\productModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSectionModel extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->hasOne(productModel::class, "product_id", "product_id")->with("documents");
    }
}
