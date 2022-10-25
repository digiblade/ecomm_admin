<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class playGroundController extends Controller
{
    public function addForm(){
        $config = [

            [
                "id"=>"name",
                "label"=>"Category name",
                "type"=>"text",
                "name"=>"category_name",
                "placeholder"=>""
            ],
            [
                "label"=>"Image",
                "type"=>"file",
                "placeholder"=>"example@example.com"
            ]
        ];
        return view("panel.utilities.Form.forms",array("formConfig"=>$config,"action"=>"/category/add","method"=>"POST"));
    }
}
