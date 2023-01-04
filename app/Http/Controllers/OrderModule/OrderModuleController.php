<?php

namespace App\Http\Controllers\OrderModule;

use App\Http\Controllers\Controller;
use App\Models\CartModel;
use App\Models\deliveryModel;
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
    public function getAllOrder()
    {
        return  OrderModuleModel::orderBy("id", "DESC")->with("section")->get();
    }

    public function getOrderView()
    {
        $orderList = $this->getAllOrder();
        $config = [

            "product_name" => [
                "id" => "product_name",
                "label" => "Product Name",
                "type" => "text",
            ],
            "product_price" => [
                "id" => "product_price",
                "label" => "Product Price",
                "type" => "text",
            ],
            "product_merchantprice" => [
                "id" => "product_name",
                "label" => "Product Mer. Price",
                "type" => "text",
            ],
            "product_mrp" => [
                "id" => "product_mrp",
                "label" => "Product MRP",
                "type" => "text",
            ], "product_description" => [
                "id" => "product_description",
                "label" => "Product Description",
                "type" => "text",
            ], "product_stockcount" => [
                "id" => "product_stockcount",
                "label" => "Product Stock Units",
                "type" => "text",
            ], "product_isverified" => [
                "id" => "product_isverified",
                "label" => "Verified Product",
                "type" => "text",
            ],

            "image" => [
                "id" => "document",
                "label" => "Image",
                "type" => "text",
            ],


        ];

        return view("panel.utilities.Tabel.ordersection", array("data" => $orderList, "config" => $config));
    }
    public function getOrderStatus()
    {
        $delivery = new deliveryModel();
        $statusList = $delivery->getStatus();
        $config = [

           
            "status" => [
                "id" => "status_id",
                "label" => "Status",
                "type" => "option",
                "name" => "statys_id",
                "optionSet" => $statusList,
                "optionLabel" => "label",
                "optionValue" => "id",
                "value" => 0
            ],
            "product_price" => [
                "id" => "product_price",
                "name" => "product_price",
                "label" => "Product Price",
                "type" => "text",
            ],
            "product_merchantprice" => [
                "id" => "product_merchantprice",
                "name" => "product_merchantprice",
                "label" => "Product Mer. Price",
                "type" => "text",
            ],
            "product_mrp" => [
                "id" => "product_mrp",
                "name" => "product_mrp",
                "label" => "Product MRP",
                "type" => "text",
            ], "product_description" => [
                "id" => "product_description",
                "name" => "product_description",
                "label" => "Product Description",
                "type" => "text",
            ], "product_stockcount" => [
                "id" => "product_stockcount",
                "name" => "product_stockcount",
                "label" => "Product Stock Units",
                "type" => "text",
            ], "product_isverified" => [
                "id" => "product_isverified",
                "name" => "product_isverified",
                "label" => "Verified Product",

                "type" => "option",
                "optionSet" => array(array("label" => 'True', "value" => 1), array("label" => "False", "value" => 0)),
                "optionLabel" => "label",
                "optionValue" => "value",
                "value" => 0
            ],

            "image" => [
                "label" => "Image",
                "type" => "file",
                "name" => "document"
            ],

        ];
        return view("panel.utilities.Form.forms", array("formConfig" => $config, "action" => "/product-add-submit", "method" => "POST", "title" => "Add Product"));
    }
}
