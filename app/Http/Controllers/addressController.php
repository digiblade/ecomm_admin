<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\addressModel;
use App\Models\footerModel;

use function PHPUnit\Framework\isEmpty;

class addressController extends Controller
{
    public function addUserAddress(Request $req)
    {
        $data = new addressModel;

        $data->address_id = md5(microtime());
        $data->address_username = $req->username ? $req->username : "";
        $data->address_detail = $req->address ? $req->address : "";
        $data->address_pincode = $req->pincode ? $req->pincode : "";
        $data->address_uid = $req->uid ? $req->uid : "";
        $data->address_contact = $req->contact ? $req->contact : "";
        $data->created_at = date("Y/m/d H:i:s");
        $data->updated_at = date("Y/m/d H:i:s");
        if ($data->save()) {
            return [
                "response" => true
            ];
        } else {
            return [
                "response" => false
            ];
        }
    }
    public function updateUserAddress(Request $req)
    {
        $data = array();
        if (isset($req->username)) {
            $data['address_username'] = $req->username;
        }
        if (isset($req->address)) {
            $data['address_detail'] = $req->address;
        }
        if (isset($req->pincode)) {
            $data['address_pincode'] = $req->pincode;
        }
        if (isset($req->uid)) {
            $data['address_uid'] = $req->uid;
        }
        if (isset($req->contact)) {
            $data['address_contact'] = $req->contact;
        }

        $data['updated_at'] = date("Y/m/d H:i:s");
        if (addressModel::where("address_id", "=", $req->addressid)->update($data)) {
            return [
                "response" => true
            ];
        } else {
            return [
                "response" => false
            ];
        }
    }
    public function softDeleteUserAddress(Request $req)
    {

        $data['address_type'] = 0;
        $data['updated_at'] = date("Y/m/d H:i:s");
        if (addressModel::where("address_id", "=", $req->addressid)->update($data)) {
            return [
                "response" => true
            ];
        } else {
            return [
                "response" => false
            ];
        }
    }
    public function getUserAddress(Request $req)
    {
        $data =  addressModel::where("address_uid", "=", $req->uid)->where("address_type", "=", "1")->orderBy("address_pk", "desc")->get();
        if (count($data) > 0) {
            return $data;
        } else {
            return [
                "error" => "No address found",
                "response" => false
            ];
        }
    }
    public function getFooter()
    {
        $data = footerModel::orderBy("id", "desc")->get()->first();
        return $data;
    }
}
