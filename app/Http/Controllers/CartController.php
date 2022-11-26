<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CartModel;

class CartController extends Controller
{
    public function getCart(Request $req)
    {
        $data = CartModel::where("cart_userid", "=", $req->email)->where("cart_isactive", "=", "1")->with('product')->get();
        return $data;
    }
    public function addProduct(Request $req)
    {
        $products = CartModel::where("cart_userid", "=", $req->email)->where("cart_productid", "=", $req->id)->get();
        if (count($products) > 0) {
            $product = $products[0];
            $data = array();
            if ($req->remove == true) {
                if ($product['cart_productcount'] <= 1) {
                    $data['cart_isactive'] = 0;
                } else {
                    $data['cart_productcount'] = $product['cart_productcount'] - 1;
                }
            } else {
                if ($product['cart_productcount'] >= 0) {
                    $data['cart_isactive'] = 1;
                }
                $data['cart_productcount'] = $product['cart_productcount'] + isset($req->count) ? $req->count : 1;
            }

            CartModel::where("cart_userid", "=", $req->email)->where("cart_productid", "=", $req->id)->update($data);
        } else {
            $product = array(
                "cart_userid" => $req->email,
                "cart_productid" => $req->id,
                "cart_productcount" => 1,
                "cart_isactive" => "1",
                "created_at" => date("Y/m/d H:i:s"),
                "updated_at" => date("Y/m/d H:i:s"),
            );
            CartModel::insert($product);
        }
        return [
            "response" => true,
            "msg" => "Cart Updated"
        ];
    }
}
