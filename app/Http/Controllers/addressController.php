<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\addressModel;
use App\Models\footerModel;
class addressController extends Controller
{
    public function addUserAddress(Request $req){
        $data = new addressModel;
       
        $data->address_id = md5(microtime());
        $data->address_username = $req->username?$req->username:"";
        $data->address_detail = $req->address?$req->address:"";
        $data->address_pincode = $req->pincode?$req->pincode:"";
        $data->address_uid = $req->uid?$req->uid:"";
        $data->address_contact = $req->contact?$req->contact:"";
        $data->created_at = date("Y/m/d H:i:s");
        $data->updated_at = date("Y/m/d H:i:s");
        if($data->save()){
            return [
                "response"=>true
            ];
        }else{
            return [
                "response"=>false
            ];
        }
    }
    public function getUserAddress(Request $req){
        $data =  addressModel::where("address_uid","=",$req->uid)->orderBy("address_pk","desc")->get();
        if(count($data)>0){
            return $data;
        }else{
            return [
                "error"=>"No address found",
                "response"=>false
            ];
        }
    }
    public function getFooter(){
        $data = footerModel::orderBy("id","desc")->get()->first();
        return $data;
    }
}
