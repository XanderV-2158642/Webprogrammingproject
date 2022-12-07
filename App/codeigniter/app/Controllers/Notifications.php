<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\NotifyRequestModel;
use App\Models\NotificationModel;
use App\Models\ProductModel;

class Notifications extends BaseController
{

    public function index(){

        $user_id = session()->get('user_id');
        $notificationtable = new NotificationModel();
        $notifications = $notificationtable->where('user_id', $user_id)->findAll();

        $producttable = new ProductModel();
        $info = [];
        foreach($notifications as $notification){
            $product = $producttable->find($notification['product_id']);
            $d = [
                'notification' => $notification,
                'product' => $product
            ];
            array_push($info, $d);
        }

        $data = [
            'notifications' => $info
        ];

        $this->setRead($notifications);

        return view('notifications',$data);
    }

    public function addnotification($product_id){
        $user_id = session()->get('user_id');

        $notifyrequesttable = new NotifyRequestModel();

        $userrequests = $notifyrequesttable->where('user_id', $user_id)->findAll();
        foreach ($userrequests as $request){
            if ($request['product_id'] == $product_id){
                session()->setFlashdata('notifysucces', 'Notification already requested!<br>No worries');
                return redirect()->to(base_url('/Product/productpage/' . $product_id));
            }
        }

        $data = [
            'product_id' => $product_id,
            'user_id' => $user_id
        ];

        $notifyrequesttable->insert($data);

        session()->setFlashdata('notifysucces', 'Notification succesfully requested!');

        return redirect()->to(base_url('/Product/productpage/' . $product_id));
    }

    private function setRead($notifications){
        $notificationtable = new NotificationModel();
        foreach($notifications as $notification){
            $notification['beenread'] = 1;
            $notificationtable->save($notification);
        }
    }

    public function removenotification($notification_id){
        $ntable = new NotificationModel();
        $n = $ntable->find($notification_id);

        $user_id = session()->get('user_id');

        if ($n['user_id'] == $user_id){
            $ntable->delete($notification_id);
        }

        return redirect()->to(base_url('/Notifications'));
    }

}