<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categoryModel;
use App\Http\Controllers\documentController;
class categoryController extends Controller
{
    public function getCategory(){
        $data = categoryModel::orderBy('category_id', 'DESC')->where("category_isactive",true)->with('documents')->get();
        return $data;
    }
    public function getCategoryById($id){
        $data = categoryModel::orderBy('category_id', 'DESC')->where('category_id',"=",$id)->where("category_isactive",true)->with('documents')->get();
        return $data;
    }
    public function addCategory(Request $req){
        $data = new categoryModel;
        $data->category_name=$req->name;
        $data->created_at=date("Y/m/d H:i:s");
        $data->updated_at=date("Y/m/d H:i:s");
        $data->save();
        $docs = new documentController;
        $res = $data->id;
        $docRes = $docs->addDocument($req,$res);
        return array("msg"=>"category added");
    }
    public function updateCategory(Request $req){
        $data = array();
        if(isset($req->name)){
            $data['category_name'] = $req->name;
        }
        if(isset($req->document)){
            $docs = new documentController;
            $res = $req->id;
            $docRes = $docs->addDocument($req,$res);
        }
        
        $data['updated_at'] = date("Y/m/d H:i:s");
        categoryModel::where("category_id",$req->id)->update($data);
        return array("msg"=>"category updated");
    }

    public function viewCategory(){
        $data = $this->getCategory();
            $config = [
    
                "name"=>[
                    "id"=>"category_name",
                    "label"=>"Category name",
                    "type"=>"text",
                ],
                "image"=>[
                    "id"=>"document",
                    "label"=>"Image",
                    "type"=>"text",
                ],
                
                
            ];
                  
        return view("panel.utilities.Tabel.tables",array("data"=>$data,"config"=>$config));
    }
    public function addCategoryForm(){
        $config = [

            [
                "id"=>"name",
                "label"=>"Category name",
                "type"=>"text",
                "name"=>"name",
                "placeholder"=>""
            ],
            [
                "id"=>"label",
                "type"=>"hidden",
                "name"=>"label",
                "value"=>"category"
            ],
            [
                "label"=>"Image",
                "type"=>"file",
                "name"=>"document"
            ]
        ];
        return view("panel.utilities.Form.forms",array("formConfig"=>$config,"action"=>"/category-add-submit","method"=>"POST","title"=>"Add Category"));
    }
    public function addCategoryFormData(Request $req){
        $data = new categoryModel;
        $data->category_name=$req->name;
        $data->created_at=date("Y/m/d H:i:s");
        $data->updated_at=date("Y/m/d H:i:s");
        $data->save();
        $docs = new documentController;
        $res = $data->id;
        $docRes = $docs->addDocument($req,$res);
        return redirect()->back()->with("Category Added");
    }
    public function editCategoryForm(Request $req,$id){
        $category = $this->getCategoryById($id);
        $config = [

            [
                "id"=>"category_name",
                "label"=>"Category name",
                "type"=>"text",
                "name"=>"category_name",
                "placeholder"=>""
            ],
            [
                "id"=>"category_id",
                "type"=>"hidden",
                "name"=>"category_id",
            ],
            [
                "id"=>"label",
                "type"=>"hidden",
                "name"=>"label",
                "value"=>"category"
            ],
            [
                
                "label"=>"Image",
                "type"=>"file",
                "name"=>"document"
                
            ],
            [
                "label"=>"Images",
                "type"=>"documents",
                "documentList"=>[],
                "name"=>""
            ]
        ];
        $tempArray = [];
        foreach($category as $item){
            foreach($config as $con){
                if(!empty($con['value'])){

                }
                elseif($con['type'] == "documents"){
                    $con['documentList'] = $item['documents'];
                }else{
                    $con['value'] = $item[$con['name']];
                }
                array_push($tempArray,$con);
            }
        }
        return view("panel.utilities.Form.forms",array("formConfig"=>$tempArray,"action"=>"/category-edit-submit","method"=>"POST","title"=>"Edit Category"));
    }
    public function editCategoryFormData(Request $req){
        $data = [
            "category_name"=>$req->category_name,
            "updated_at"=>date("Y/m/d H:i:s")
        ];
        categoryModel::where("category_id","=",$req->category_id)->update($data);
        if(!empty($req->file('document'))){
            $docs = new documentController;
            $res = $req->category_id;
            $docRes = $docs->addDocument($req,$res);
        }

        return redirect()->back()->with("Category updated");
    }
}
