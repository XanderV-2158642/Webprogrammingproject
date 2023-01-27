<?php

namespace App\Controllers;
use App\Models\CartModel;
use App\Models\DeliveryModel;
use App\Models\ProductModel;
use App\Models\PickupModel;

class Checkout extends BaseController
{
    public function index(){
        if (!$this->cartavailable()){
            return redirect()->to(base_url('/Cart'));
        }

        helper(['form']);

        $user_id = session()->get('user_id');

        $carttable = new CartModel();
        $producttable = new ProductModel();

        $cartitems = $carttable->where('user_id', $user_id)->findAll();

        $products = [];
        $totalprice = 0;
        foreach ($cartitems as $item){
            $product = $producttable->find($item['product_id']);
            $product['itemrow'] = $item;
            $product['calcprice'] = $product['product_price'] * $item['product_amount'];
            $totalprice += $product['calcprice'];
            array_push($products, $product);
        }

        $data = [
            'products' => $products, 
            'price' => $totalprice,
            'stylesheets' => [
                '/CSS/orders.css'
            ]
        ];

        if (empty($cartitems)){
            $data['emptycart'] = 'true';
            return redirect()->to(base_url('/Cart'));
        }

        if ($this->request->getMethod()=='post'){
            $rules = [
                'ordertype' => 'required|in_list[delivery,pickup]'
            ];
            if($this->validate($rules)){
                $ordertype = $this->request->getPost('ordertype');
                return redirect()->to(base_url('/Checkout'."/".$ordertype));
            }
        }

        return view('/orderfolder/checkout', $data);
    }

    public function delivery(){
        if (!$this->cartavailable()){
            return redirect()->to(base_url('/Cart'));
        }


        helper(['form']);

        $user_id = session()->get('user_id');

        $carttable = new CartModel();
        $producttable = new ProductModel();

        $cartitems = $carttable->where('user_id', $user_id)->findAll();

        $products = [];
        $totalprice = 0;
        foreach ($cartitems as $item){
            $product = $producttable->find($item['product_id']);
            $product['itemrow'] = $item;
            $product['calcprice'] = $product['product_price'] * $item['product_amount'];
            $totalprice += $product['calcprice'];
            array_push($products, $product);
        }

        $data = [
            'products' => $products, 
            'price' => $totalprice,
            'stylesheets' => [
                '/CSS/orders.css',
                '/CSS/products.css'
            ]
        ];

        if ($this->request->getMethod()=='post'){
            $rules= $this->deliveryrules();
            if($this->validate($rules)){
                $address = $_POST;
                $this->ordercartdelivery($address, $products);
                return redirect()->to(base_url('/Orders'));
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('/orderfolder/checkoutdelivery', $data);
    }


    private function deliveryrules(){
        $rules = [
            'country' =>'required|alpha_space|min_length[3]',
            'city' => 'required|alpha_space|min_length[3]',
            'postal'=>'required|min_length[3]|alpha_numeric',
            'street'=>'required|min_length[3]',
            'number'=>'required|alpha_numeric|min_length[1]'
        ];

        return $rules;
    }

    private function ordercartdelivery($address, $products){
        $deliverytable = new DeliveryModel();
        $producttable = new ProductModel();
        $carttable = new CartModel();

        //make string of address
        $address_string = $address['country'].", ".$address['postal']." ".$address['city']."/".$address['street']." ".$address['number'];

        
        foreach ($products as $product){
            //insert order into deliverytable
            $order = [
                'buyer_id' => $product['itemrow']['user_id'],
                'product_id' => $product['product_id'],
                'seller_id' => $product['user_id'],
                'address' => $address_string,
                'delivered' => 0,
                'amount' => $product['itemrow']['product_amount']
            ];
            $deliverytable->insert($order);

            //lower amount in product table
            $productintable = $producttable->find($product['product_id']);
            $newamount = $productintable['product_amount'] - $product['itemrow']['product_amount'];
            $productintable['product_amount'] = $newamount;

            $producttable->save($productintable);

            //remove product out of cart
            $carttable->delete($product['itemrow']['cart_item_id']);
        }
    }

    public function pickup(){
        if (!$this->cartavailable()){
            return redirect()->to(base_url('/Cart'));
        }

        helper(['form']);

        $user_id = session()->get('user_id');

        $carttable = new CartModel();
        $producttable = new ProductModel();

        $cartitems = $carttable->where('user_id', $user_id)->findAll();

        $products = [];
        $totalprice = 0;
        foreach ($cartitems as $item){
            $product = $producttable->find($item['product_id']);
            $product['itemrow'] = $item;
            $product['calcprice'] = $product['product_price'] * $item['product_amount'];
            $totalprice += $product['calcprice'];
            array_push($products, $product);
        }

        $data = [
            'products' => $products, 
            'price' => $totalprice,
            'stylesheets' => [
                '/CSS/orders.css'
            ]
        ];

        if ($this->request->getMethod()=='post'){
            $rules= $this->pickuprules();
            if($this->validate($rules)){
                $time = $_POST;
                $this->ordercartpickup($time, $products);
                return redirect()->to(base_url('/Orders'));
            } else {
                $data['validation'] = $this->validator;
            }
        }


        return view('/orderfolder/checkoutpickup', $data);
    }

    private function pickuprules(){
        $rules = [
            'date' => 'required|valid_date',
            'time' => 'required'
        ];

        return $rules;
    }

    private function ordercartpickup($timestamp, $products){
        $producttable = new ProductModel();
        $carttable = new CartModel();
        $pickuptable = new PickupModel();

        foreach ($products as $product){
            //insert order into pickuptable
            $order = [
                'buyer_id' => $product['itemrow']['user_id'],
                'product_id' => $product['product_id'],
                'seller_id' => $product['user_id'],
                'date' => $timestamp['date'],
                'time' => $timestamp['time'],
                'pickedup' => 0,
                'amount' => $product['itemrow']['product_amount']
            ];
            $pickuptable->insert($order);

            //lower amount in product table
            $productintable = $producttable->find($product['product_id']);
            $newamount = $productintable['product_amount'] - $product['itemrow']['product_amount'];
            $productintable['product_amount'] = $newamount;

            $producttable->save($productintable);

            //remove product out of cart
            $carttable->delete($product['itemrow']['cart_item_id']);
        }
    }

    private function cartavailable(): bool{
        $carttable = new CartModel();
        $producttable = new ProductModel();

        $user_id = session()->get('user_id');

        $items = $carttable->where('user_id', $user_id)->findAll();

        foreach($items as $item){
            $product = $producttable->find($item['product_id']);
            if ($product['product_amount'] < $item['product_amount']){
                if ($product['product_amount'] == 0){
                    $carttable->delete($item['cart_item_id']);
                    return false;
                }
                $item['product_amount'] = $product['product_amount'];
                $carttable->update($item['cart_item_id'], $item);
                return false;
            }
        }
        return true;
    }
}