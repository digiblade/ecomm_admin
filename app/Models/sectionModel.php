<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\productModel;

class sectionModel extends Model
{
    use HasFactory;
    public function product(){
        return $this->hasMany(productModel::class,"section_model_id","section_model_id");
    }
}
