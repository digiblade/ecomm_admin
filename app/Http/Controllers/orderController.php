<?php

namespace App\Http\Controllers;

use App\Models\productSetModel;
use App\Models\orderModel;
use App\Models\shipphingStatusModel;
use Illuminate\Http\Request;

class orderController extends Controller
{
    public function createProductSet($product, $orderid)
    {
        $productSet = new productSetModel;
        $productSet->product_id = $product['product_id'];
        $productSet->product_name = $product['product_name'];
        $productSet->product_selling_price = $product['product_price'];
        $productSet->product_qty = $product['count'];
        $productSet->created_at = date("Y/m/d H:i:s");
        $productSet->updated_at = date("Y/m/d H:i:s");
        $productSet->save();
        return $productSet->id;
    }
    public function createOrder($products, $address, $uid)
    {
        $order = new orderModel;
        $orderid = md5(microtime());
        $order->order_id = $orderid;
        $order->order_deliveryid = $address;

        $order->order_uid = $uid;
        $order->created_at = date("Y/m/d H:i:s");
        $order->updated_at = date("Y/m/d H:i:s");
        for ($productIndex = 0; $productIndex < count($products); $productIndex++) {
            $this->createProductSet($products, $orderid);
        }
        if ($order->save()) {
            $this->createStatus($orderid);
            return $orderid;
        }
    }
    public function createStatus($orderid, $status = "1")
    {
        // $status = new shipphingStatusModel();
        // $status->shipping_id = md5(microtime());
        // $status->shipping_orderid = $orderid;
    }

    public function placeOrder(Request $req)
    {
        $products = $req->products ? $req->products : [];
        $address = $req->address;
        $uid = $req->uid;
        $total = $req->total;

        $this->createOrder($products, $address, $uid);

        return [
            "response" => true,
            "msg" => "Order Created"
        ];
    }
    public function getOrder(Request $req)
    {
        $data = orderModel::where("order_uid", "=", $req->uid)->with("product")->with("address")->with("status")->orderBy("order_pk", "desc")->get();
        return $data;
    }
}
