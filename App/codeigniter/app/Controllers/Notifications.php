<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProductModel;

class Notifications extends BaseController
{

    public function index(){

    }

    public function addnotification($product_id){
        $user_id = session()->get('user_id');
    }


}