<?php

namespace App\Controllers;
use App\Models\DeliveryModel;
use App\Models\NotificationModel;
use App\Models\NotifyRequestModel;
use App\Models\PickupModel;
use App\Models\ProductModel;
use App\Models\ReviewModel;

class Orders extends BaseController
{
    public function index(){
        

        $placed_orders = $this->get_placed_orders();
        $placed = [];
        $placed_deliverd = [];
        foreach($placed_orders as $order){
            if (isset($order['delivered'])){
                $confirmation = 'delivered';
            }else{
                $confirmation = 'pickedup';
            }
            if ($order[$confirmation] == 0){
                array_push($placed, $order);
            } else {
                if ($this->orderhasreview($order['product_id'])){
                    $order['reviewwritten'] = 1;
                }
                array_push($placed_deliverd, $order);
            }
        }
        $placed_orders_data = $this->get_order_data($placed);
        $placed_orders_d_data = $this->get_order_data($placed_deliverd);
        


        $seller_orders = $this->get_seller_orders();
        $unhandled = [];
        $delivered = [];
        foreach($seller_orders as $order){
            if (isset($order['delivered'])){
                $confirmation = 'delivered';
            }else{
                $confirmation = 'pickedup';
            }


            if ($order[$confirmation] == 0){
                array_push($unhandled, $order);
            } else {
                array_push($delivered, $order);
            }
        }
        $unhandled_data = $this->get_order_data($unhandled);
        $delivered_data = $this->get_order_data($delivered);



        $data = [
            'placed_orders' => $placed_orders_data,
            'placed_orders_delivered' => $placed_orders_d_data,
            'unhandled_orders' =>$unhandled_data,
            'delivered_orders' =>$delivered_data
        ];

        return view('/orderfolder/orders', $data);
    }

    private function get_placed_orders(){
        $user_id = session()->get('user_id');
        $deliverytable = new DeliveryModel();
        $pickuptable = new PickupModel();

        $d_orders = $deliverytable->where('buyer_id', $user_id)->findAll();
        $p_orders = $pickuptable->where('buyer_id', $user_id)->findAll();

        $orders = [];
        foreach($d_orders as $ord){
            array_push($orders, $ord);
        }
        foreach($p_orders as $ord){
            array_push($orders, $ord);
        }

        return $orders;
    }

    private function get_order_data($orders){
        $producttable = new ProductModel();

        $orders_data = [];
        foreach($orders as $order){
            $product = $producttable->find($order['product_id']);

            if(isset($order['date'])){
                $orgDate = $order['date'];  
                $date = str_replace('-"', '/', $orgDate);  
                $newDate = date("d/m/Y", strtotime($date));  
                $order['date'] = $newDate;
            }

            if(isset($order['address'])){
                $orgAddress = $order['address'];
                $bits = explode('/', $orgAddress);
                $order['address'] = [
                    'p1' => $bits[0],
                    'p2' => $bits[1]
                ];
            }

            $order_data = [
                'order' => $order,
                'product' => $product];
            array_push($orders_data, $order_data);
        }

        return $orders_data;
    }

    private function get_seller_orders(){
        $user_id = session()->get('user_id');
        $deliverytable = new DeliveryModel();
        $pickuptable = new PickupModel();

        $d_orders = $deliverytable->where('seller_id', $user_id)->findAll();
        $p_orders = $pickuptable->where('seller_id', $user_id)->findAll();

        $orders = [];
        foreach($d_orders as $ord){
            array_push($orders, $ord);
        }
        foreach($p_orders as $ord){
            array_push($orders, $ord);
        }

        return $orders;
    }

    public function cancelorder($type, $order_id){
        $user_id = session()->get('user_id');

        if ($type == 'delivery'){
            $ordertable = new DeliveryModel();
            $confirmation = 'delivered';
        } elseif ($type == 'pickup'){
            $ordertable = new PickupModel();
            $confirmation = 'pickedup';
        } else {
            return redirect()->to(base_url('/Orders'));
        }
        
        $order = $ordertable->find($order_id);
        if($user_id == $order['buyer_id'] && !empty($order) && !$order[$confirmation]){
            $producttable = new ProductModel();
            $product = $producttable->find($order['product_id']);
            $product['product_amount'] = $order['amount'] + $product['product_amount'];
            $producttable->update($product['product_id'], $product);

            $this->transfernotification($order['product_id']);

            $ordertable->delete($order_id);
        }

        return redirect()->to(base_url('/Orders'));
    }

    private function transfernotification($product_id){
        $nreqtable = new NotifyRequestModel();
        $rtable = new NotificationModel();

        $reqs = $nreqtable->where('product_id', $product_id)->findAll();
        foreach ($reqs as $r){
            $r['beenread'] = 0;
            $nreqtable->delete($r['notification_id']);
            unset($r['notification_id']);
            $rtable->insert($r);
        }
    }

    public function completeOrder($type, $order_id){
        $user_id = session()->get('user_id');

        if ($type == 'delivery'){
            $ordertable = new DeliveryModel();
            $confirmation = 'delivered';
        } elseif ($type == 'pickup'){
            $ordertable = new PickupModel();
            $confirmation = 'pickedup';
        } else {
            return redirect()->to(base_url('/Orders'));
        }

        $order = $ordertable->find($order_id);
        if($user_id == $order['seller_id'] && !empty($order) && !$order[$confirmation]){
            $order[$confirmation] = 1;
            $ordertable->update($order_id, $order);
        }

        return redirect()->to(base_url('/Orders'));
    }

    private function orderhasreview($product_id){
        $reviewtable = new ReviewModel();
        $userreviews = $reviewtable->where('writer_id', session()->get('user_id'))->findAll();

        foreach ($userreviews as $review) {
            if ($review['product_id'] == $product_id){
                return true;
            }
        }
        return false;
    }
}