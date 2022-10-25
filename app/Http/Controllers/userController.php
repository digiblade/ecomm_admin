<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userModel;

class userController extends Controller
{
    public function getUser()
    {
        $data = userModel::get();
        return $data;
    }
    public function checkLogin(Request $req){
        $user = $req->email;
        $password = md5($req->password);
        $check = userModel::where("user_email","=",$user)->where("user_password","=",$password)->get();
        if($check->count()>0){
            session(['uid'=>$check[0]->user_uid,'  '=>$check[0]->user_name]);
           return redirect("/category");
        }
        return redirect()->back()->with("error","invalid credentials");
    }
    public function logout(Request $req){
       session()->flush();
        return redirect("/");
    }
    public function addUser(Request $req)
    {
        try {
            $data = [
                "user_name" => $req->user_name ? $req->user_name : "",
                "user_uid"=>md5(microtime()),
                "user_email" => $req->user_email,
                "user_password" => md5($req->user_password),
                "user_contact" => $req->user_contact ? $req->user_contact : "",
                "user_isactive"=>false,
                "created_at"=>date("Y/m/d H:i:s"),
                "updated_at"=>date("Y/m/d H:i:s"),
            ];
            if(userModel::insert($data)==1){
                return array(
                    "msg" => "user created successfully"
                );
            }
        } catch (Exception $error) {
            return array(
                "error" => $error->errorInfo
            );
        }
    }
    public function editUser(Request $req)
    {
        try {
            $id = $req->id;
            $data = json_decode(json_encode($req->data),true);
            $data['updated_at'] =date("Y/m/d H:i:s");
            if(isset($data['user_password'])){
                $data['user_password'] = md5($data['user_password']);
            }
            if(userModel::where("user_uid",$id)->update($data)==1){
                return array(
                    "msg" => "user updated successfully"
                );
            }
        } catch (Exception $error) {
            return array(
                "error" => $error->errorInfo
            );
        }
    }
}
