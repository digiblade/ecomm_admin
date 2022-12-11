<?php

namespace App\Http\Controllers;

use App\Models\clientModel;
use App\Models\OrderModule\OrderModuleModel;
use App\Models\productModel;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function getDashboardData()
    {
        $data = array();
        $data['Active order'] = count(OrderModuleModel::where("order_status", "!=", "closed")->get());
        $data['Total user'] = count(clientModel::where("client_isactive", "=", 1)->get());
        $data['Total Products'] = count(productModel::where("product_isactive", "=", 1)->get());
        return  $data;
    }
}
