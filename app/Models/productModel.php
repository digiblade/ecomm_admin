<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\categoryModel;
use App\Models\sectionModel;
class productModel extends Model
{
    use HasFactory;

    public function category(){
        return $this->hasMany(categoryModel::class,"category_id","category_id")->with("documents");
    }
    public function documents(){
        return $this->hasMany(documentModel::class,"document_parentid","product_id")->where("document_label","=","product")->where("document_isactive","=",1);
    }
    // public function section(){
    //     return $this->belongsToMany(sectionModel::class, "product_model_section_model","product_model_id","product_id");
    // }
}
