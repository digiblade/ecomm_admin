<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\categoryModel;
class documentModel extends Model
{
    use HasFactory;
    public function category(){
        return $this->belongsTo(categoryModel::class,"document_parentid","category_id");
    }
}
