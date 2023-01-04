<?php

namespace App\Http\Controllers;

use App\Models\deliveryModel;
use App\Models\OrderModule\OrderModuleModel;
use App\Models\statusModel;
use Illuminate\Http\Request;

class deliveryController extends Controller
{
    public function getStatus()
    {
        return statusModel::where("isactive", "=", true)->get();
    }
    public function getStatusById($id)
    {
        return statusModel::where("id", "=", $id)->where("isactive", "=", true)->get();
    }
    public function addStatus(Request $req)
    {
        $data = $req->data;
        $statusList = array();
        foreach ($data as $status) {
            $status['created_at'] = date("Y/m/d H:i:s");
            $status['updated_at'] = date("Y/m/d H:i:s");
            $status['isactive'] = true;
            array_push($statusList, $status);
        }
        statusModel::insert($statusList);
        return ["response" => "Status added"];
    }



    public function createOrderStatus(Request $req)
    {
        $orders =  OrderModuleModel::where("order_id", "=", $req->orderId)->get();

        if (count($orders) > 0) {
            $isStatusHistoryCreated = $this->createOrderHistoy($req);
            if ($isStatusHistoryCreated) {
                $status = $this->getStatusById($req->statusId);
                if (count($status) > 0) {
                    OrderModuleModel::where("order_id", "=", $req->orderId)->update(["order_status" => $status[0]['label']]);
                }
            }
        }
        return ["response" => true];
    }
    public function getOrderStatus(Request $req)
    {
        return deliveryModel::where("order_id", "=", $req->orderId)->get();
    }
    public function createOrderHistoy(Request $req)
    {
        $orderStatus = deliveryModel::where("order_id", "=", $req->orderId)->where("status_id", "=", $req->statusId)->get();
        if (count($orderStatus) == 0) {
            $status = $this->getStatusById($req->statusId);
            $statusLabel = "";
            if (count($status) > 0) {
                $statusLabel = $status[0]['label'];
            }
            $orderStatusData = array(
                "order_id" => $req->orderId,
                "status_id" => $req->statusId,
                "status_label" => $statusLabel,
                "status_remark" => isset($req->remark) ? $req->remark : "",
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s"),
                'status_isactive' => true,

            );
            deliveryModel::insert($orderStatusData);
            return true;
        } else {
            return false;
        }
    }
}
