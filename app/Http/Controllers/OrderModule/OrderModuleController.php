<?php

namespace App\Http\Controllers\OrderModule;

use App\Http\Controllers\Controller;
use App\Models\CartModel;
use App\Models\OrderModule\OrderModuleModel;
use App\Models\OrderModule\ProductSectionModel;
use Illuminate\Http\Request;

class OrderModuleController extends Controller
{
    public function createOrder(Request $req)
    {
        $orderData = array();
        $orderData['order_id'] = md5(microtime());
        $orderData['user_id'] = $req->userid;
        $orderData['order_total'] = $req->total;
        $orderData['order_address'] = $req->address;
        $orderData['order_status'] = "Initiate";
        $orderData['created_at'] = date("Y/m/d H:i:s");
        $orderData['updated_at'] = date("Y/m/d H:i:s");
        OrderModuleModel::insert($orderData);
        $productData = array();
        foreach ($req->products as $product) {
            $product['product_section_id'] = md5(microtime());
            $product['order_id'] = $orderData['order_id'];
            $product['created_at'] = date("Y/m/d H:i:s");
            $product['updated_at'] = date("Y/m/d H:i:s");
            array_push($productData, $product);
        }
        $this->createProductList($productData);
        CartModel::where(
            "cart_userid",
            "=",
            $req->userid
        )->Update(["cart_isactive" => "0"]);
        return [
            "response" => true,
            "msg" => "Order Placed"

        ];
    }
    public function createProductList($productList)
    {
        $products = $productList;
        ProductSectionModel::insert($products);
    }
    public function getOrder(Request $req)
    {
        return  OrderModuleModel::where("user_id", "=", $req->userid)->orderBy("id", "DESC")->with("section")->get();
    }
    public function getAllOrder(Request $req)
    {
        return  OrderModuleModel::orderBy("id", "DESC")->with("section")->get();
    }
}
