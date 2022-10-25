<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\documentModel;
class categoryModel extends Model
{
    use HasFactory;
    public function documents(){
        return $this->hasMany(documentModel::class,"document_parentid","category_id")->where("document_label","=","category")->where("document_isactive","=",1);
    }
    
}
