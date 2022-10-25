<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clientModel;

class clientController extends Controller
{
    public function addUser(Request $req){
        $data = new clientModel;
        $client = clientModel::where("client_email","=",$req->email)->get();
        if(count($client)>0){
             return [
                "response"=>false,
                "error"=>"Please use diffrent email"
            ];
        }
        $data->client_id = md5(microtime());
        $data->client_fullname = $req->fullname?$req->fullname:"";
        $data->client_email = $req->email;
        $data->client_contact = $req->contact?$req->contact:"";
        $data->client_password = md5($req->password?$req->password:"");
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
    public function getUser(Request $req){
        $data =  clientModel::where("client_email","=",$req->email)->where("client_password","=",md5($req->password))->where("client_isactive","=",true)->get();
        if(count($data)>0){
            return ["uid"=>$data[0]['client_id'],"name"=>$data[0]["client_fullname"],"email"=>$data[0]["client_email"]];
        }else{
            return [
                "error"=>"invalid credentials",
                "response"=>false
            ];
        }
    }
}
