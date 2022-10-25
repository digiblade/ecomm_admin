<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\productModel;

class sectionToProduct extends Model
{
    use HasFactory;
    protected $table="product_model_section_model";
    public function product(){
        return $this->hasOne(productModel::class,"product_id","product_model_id")->with("documents")->with("category");
    }
}
