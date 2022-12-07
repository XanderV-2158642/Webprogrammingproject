<?php

namespace App\Controllers;
use App\Models\NotificationModel;

class Home extends BaseController
{
    public function index()
    {
        $notificationamount = $this->getNotifications();

        $data = [
            'na' => $notificationamount
        ];

        return view('homepage', $data);
    }

    private function getNotifications(){
        $user_id = session()->get('user_id');
        $querystring = "SELECT count(*) as count
                        FROM Notifications
                        WHERE user_id=". $user_id ." AND "."beenread = 0";
        $db = db_connect();
        $query = $db->query($querystring);
        $amount = $query->getResultArray()[0]['count'];
        return $amount;
    }
}
