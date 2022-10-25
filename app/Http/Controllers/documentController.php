<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\documentModel;
class documentController extends Controller
{
    public function getDocument(){
        $data = documentModel::get();
        return $data;
    }
    public function getDocumentByLabel(Request $req,$label){
        $data = documentModel::where("document_isactive","=",1)->where("document_label","=",$label)->get();
        return $data;
    }
    public function addDocument(Request $req,$id=0){
        $name = $req->file('document')->getClientOriginalName();
        $path = $req->file('document')->store(''); 
        $req->file('document')->move("documents/$req->label",$path);
        $data = array();
        $data['document_id'] = md5(microtime()); 
        $data['document_path'] = $path;
        $data['document_label'] = $req->label;
        $data['document_parentid'] =$id;
        $data['document_type'] = $req->type?$req->type:"image";
        $data['created_at'] = date("Y/m/d H:i:s");
        $data['updated_at'] = date("Y/m/d H:i:s");

        if(documentModel::insert($data)==1){
            return array("msg"=>"document added");
        }else{
            return array("error"=>"document upload fail");
        }
    }
    public function deleteDocument(Request $req){
         documentModel::where("document_id","=",$req->id)->update(["document_isactive"=>false]);
         return redirect()->back();
    }
}
