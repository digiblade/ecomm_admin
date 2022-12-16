<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productModel;
use App\Models\sectionModel;
use App\Models\sectionToProduct;
use App\Models\documentModel;
use App\Http\Controllers\categoryController;

class productController extends Controller
{
    public function getProduct()
    {
        $data = productModel::orderBy('product_pk', "DESC")->where("product_isactive", "=", "1")->with('category')->with('documents')->get();
        return $data;
    }
    public function getProductById($id)
    {
        $data = productModel::orderBy('product_pk', "DESC")->where("product_isactive", "=", "1")->where("product_pk", "=", $id)->with('category')->with('documents')->get();
        return $data;
    }
    public function getProductByCatId($cid)
    {
        $data = productModel::orderBy('product_pk', "DESC")->where("product_isactive", "=", "1")->where("category_id", "=", $cid)->with('category')->with('documents')->get();
        return $data;
    }
    public function addProduct(Request $req)
    {
        $data = new productModel;
        $data->product_id = md5(microtime());
        $data->category_id = $req->category_id;
        $data->product_price = isset($req->product_price) ? $req->product_price : "0";
        $data->product_merchantprice = isset($req->product_merchantprice) ? $req->product_merchantprice : "0";
        $data->product_mrp = isset($req->product_mrp) ? $req->product_mrp : "0";
        $data->product_name = $req->product_name ? $req->product_name : "";
        $data->product_description = $req->product_description ? $req->product_description : "";
        $data->product_stockcount = $req->product_stockcount ? $req->product_stockcount : "1";
        $data->product_stockcount = $req->product_stockcount ? $req->product_stockcount : "1";
        $data->created_by = $req->uid ? $req->uid : "admin";
        $data->created_at = date("Y/m/d H:i:s");
        $data->updated_at = date("Y/m/d H:i:s");
        if ($data->save()) {
            $docs = new documentController;
            $res = $data->id;
            $docRes = $docs->addDocument($req, $res);
        }
        return array("msg" => "product added");
    }
    public function updateProduct(Request $req)
    {
        $id = $req->id;
        $data = json_decode(json_encode($req->data), true);
        $data["updated_at"] = date("Y/m/d H:i:s");
        if (productModel::where("product_pk", $id)->update($data) == 1) {
            return array(
                "msg" => "product updated successfully"
            );
        }

        return array("msg" => "product updation failed");
    }

    public function viewProduct()
    {
        $data = $this->getProduct();
        // return $data;
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

        return view("panel.utilities.Tabel.product", array("data" => $data, "config" => $config));
    }
    public function addProductForm()
    {

        $category = new categoryController;
        $categoryList = $category->getCategory();
        $config = [

            "product_name" => [
                "id" => "product_name",
                "name" => "product_name",
                "label" => "Product Name",
                "type" => "text",
            ],
            "label" => [
                "id" => "label",
                "type" => "hidden",
                "name" => "label",
                "value" => "product"
            ],
            "category_name" => [
                "id" => "category_id",
                "label" => "Category",
                "type" => "option",
                "name" => "category_id",
                "optionSet" => $categoryList,
                "optionLabel" => "category_name",
                "optionValue" => "category_id",
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
    public function addProductFormData(Request $req)
    {
        $data = new productModel;
        $data->product_id = md5(microtime());
        $data->category_id = $req->category_id;
        $data->product_price = isset($req->product_price) ? $req->product_price : "0";
        $data->product_merchantprice = isset($req->product_merchantprice) ? $req->product_merchantprice : "0";
        $data->product_mrp = isset($req->product_mrp) ? $req->product_mrp : "0";
        $data->product_name = $req->product_name ? $req->product_name : "";
        $data->product_description = $req->product_description ? $req->product_description : "";
        $data->product_stockcount = $req->product_stockcount ? $req->product_stockcount : "1";
        $data->product_stockcount = $req->product_stockcount ? $req->product_stockcount : "1";
        $data->created_by = $req->uid ? $req->uid : "admin";
        $data->created_at = date("Y/m/d H:i:s");
        $data->updated_at = date("Y/m/d H:i:s");
        if ($data->save()) {
            $docs = new documentController;
            $res = $data->id;
            $docRes = $docs->addDocument($req, $res);
        }
        return redirect()->back()->with("Product Added");
    }
    public function addProductFormDataByApi(Request $req)
    {
        $data = new productModel;
        $data->product_id = md5(microtime());
        $data->category_id = $req->category_id;
        $data->product_price = isset($req->product_price) ? $req->product_price : "0";
        $data->product_merchantprice = isset($req->product_merchantprice) ? $req->product_merchantprice : "0";
        $data->product_mrp = isset($req->product_mrp) ? $req->product_mrp : "0";
        $data->product_name = $req->product_name ? $req->product_name : "";
        $data->product_description = $req->product_description ? $req->product_description : "";
        $data->product_stockcount = $req->product_stockcount ? $req->product_stockcount : "1";
        $data->product_stockcount = $req->product_stockcount ? $req->product_stockcount : "1";
        $data->created_by = $req->uid ? $req->uid : "admin";
        $data->created_at = date("Y/m/d H:i:s");
        $data->updated_at = date("Y/m/d H:i:s");
        if ($data->save()) {
            $docs = new documentController;
            $res = $data->id;
            $docRes = $docs->addDocument($req, $res);
        }
        return ["response" => true];
    }
    public function editProductForm(Request $req, $id)
    {
        $product = $this->getProductById($id);
        $category = new categoryController;
        $categoryList = $category->getCategory();
        $config = [

            "product_name" => [
                "id" => "product_name",
                "name" => "product_name",
                "label" => "Product Name",
                "type" => "text",
            ],
            "product_id" => [
                "id" => "product_id",
                "name" => "product_id",
                "type" => "hidden",
            ],
            "label" => [
                "id" => "label",
                "type" => "hidden",
                "name" => "label",
                "value" => "product"
            ],
            "category_name" => [
                "id" => "category_id",
                "label" => "Category",
                "type" => "option",
                "name" => "category_id",
                "optionSet" => $categoryList,
                "optionLabel" => "category_name",
                "optionValue" => "category_id",
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


            [
                "label" => "Images",
                "type" => "documents",
                "documentList" => [],
                "name" => ""
            ]

        ];

        $tempArray = [];
        foreach ($product as $item) {
            foreach ($config as $con) {
                if (!empty($con['value'])) {
                } elseif ($con['type'] == "documents") {
                    $con['documentList'] = $item['documents'];
                } else {
                    $con['value'] = $item[$con['name']];
                }
                array_push($tempArray, $con);
            }
        }
        return view("panel.utilities.Form.forms", array("formConfig" => $tempArray, "action" => "/product-edit-submit", "method" => "POST", "title" => "Edit Product"));
    }
    public function editProductFormData(Request $req)
    {
        $data = [
            "category_id" => $req->category_id,
            "product_price" => isset($req->product_price) ? $req->product_price : "0",
            "product_merchantprice" => isset($req->product_merchantprice) ? $req->product_merchantprice : "0",
            "product_mrp" => isset($req->product_mrp) ? $req->product_mrp : "0",
            "product_name" => $req->product_name ? $req->product_name : "",
            "product_description" => $req->product_description ? $req->product_description : "",
            "product_stockcount" => $req->product_stockcount ? $req->product_stockcount : "1",
            "product_stockcount" => $req->product_stockcount ? $req->product_stockcount : "1",
            "created_by" => $req->uid ? $req->uid : "admin",
            "updated_at" => date("Y/m/d H:i:s")
        ];
        $c = productModel::where("product_id", "=", $req->product_id)->update($data);
        if (!empty($req->file('document'))) {
            $docs = new documentController;
            $res = $req->product_id;
            $docs->addDocument($req, $res);
        }
        return redirect()->back()->with("Product updated");
    }
    public function sectionProduct()
    {
        $sections = sectionModel::where("section_isactive", "=", 1)->get();
        $data = [];
        foreach ($sections as $section) {
            $product = sectionToProduct::where("section_model_id", "=", (int)$section['id'])->with('product')->get();
            $res = [];
            $res['section_id'] = (int)$section['id'];
            $res['section_label'] = $section['section_label'];
            $res['products'] = $product;
            if (count($product) > 0) {
                array_push($data, $res);
            }
        }
        return $data;
    }
    public function sectionProductById(Request $req, $id)
    {
        $sections = sectionModel::where("id", $id)->where("section_isactive", "=", 1)->get();
        $data = [];
        foreach ($sections as $section) {
            $product = sectionToProduct::where("section_model_id", "=", (int)$section['id'])->with('product')->get();
            $res = [];
            $res['section_id'] = (int)$section['id'];
            $res['section_label'] = $section['section_label'];
            $res['products'] = $product;
            if (count($product) > 0) {
                array_push($data, $res);
            }
        }
        return $data;
    }
    public function createSection(Request $req)
    {
        $data = $req->section;
        $section = array();
        foreach ($data as $sectionData) {
            $sectionCheck =  sectionToProduct::where("section_model_id", "=", $sectionData['section_model_id'])->where("product_model_id", "=", $sectionData['product_model_id'])->get();
            if (count($sectionCheck) == 0) {
                $sectionData['created_at'] = date("Y/m/d H:i:s");
                $sectionData['updated_at'] = date("Y/m/d H:i:s");
                array_push($section, $sectionData);
            }
        }
        $res = sectionToProduct::insert($section);
        return [
            "response" => true,
            "msg" => "Section created"

        ];
    }
    public function searchProduct(Request $req)
    {
        $keyword = $req->keyword;
        return productModel::where(function ($query) use ($keyword) {
            $query->where("product_name", "like", '%' . $keyword . '%')->orWhere("product_description", "like", '%' . $keyword . '%');
        })->where('product_isactive', "=", true)->with("category")->with("documents")->get();
    }
}
