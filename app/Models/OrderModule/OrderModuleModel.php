<?php

namespace App\Models\OrderModule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModuleModel extends Model
{
    use HasFactory;
    public function section()
    {
        return $this->hasMany(ProductSectionModel::class, "order_id", "order_id")->with("product")->has("product");
    }
}
