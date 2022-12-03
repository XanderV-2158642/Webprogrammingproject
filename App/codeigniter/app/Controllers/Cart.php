<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProductModel;

class Cart extends BaseController
{
    public function index()
    {
        helper(['form']);
        $user_id = session()->get('user_id');

        $carttable = new CartModel();
        $cartitems = $carttable->where('user_id', $user_id)->findAll();

        

        $producttable = new ProductModel();
        $products = [];
        $totalprice = 0;
        foreach ($cartitems as $item){
            $product = $producttable->find($item['product_id']);
            $product['itemrow'] = $item;
            $totalprice += $product['product_price'] * $item['product_amount'];
            array_push($products, $product);
        }

        $data = [
            'products' => $products, 
            'price' => $totalprice
        ];

        if (empty($cartitems)){
            $data['emptycart'] = 'true';
        }

        return view('/orderfolder/cart', $data);
    }

    public function addtocart($product_id){
        $cart = new CartModel();
        

        helper (['form']);

        if ($this->request->getMethod() == 'post'){
            $rules = [
                'product_amount' =>[
                    'rules' => 'required|greater_than[0]',
                    'label' => 'amount'
                ]
            ];
            if ($this->validate($rules)){
                $input = $_POST;
                $producttable = new ProductModel();
                $product = $producttable->find($product_id);
                if($input['product_amount'] > $product['product_amount']){
                    session()->setFlashdata('amount_input', 'There are only '.$product['product_amount'].' items left!');
                    return redirect()->to(base_url('/Product/productpage/'.$product_id));
                } else {
                    $cartrow = [
                        'user_id' => session()->get('user_id'),
                        'product_id' => $product_id,
                        'product_amount' => $input['product_amount'],
                    ];
                    $cart->insert($cartrow);
                    session()->setFlashdata('succesfully_added', 'Succesfully added '.$input['product_amount'].' items to your cart!');
                    return redirect()->back();
                }  
            } else {
                session()->setFlashdata('amount_input', 'Amount is required and must be greater than 0');
                return redirect()->to(base_url('/Product/productpage/'.$product_id));
            }
        }
    }

    public function editline($item_id){
        $user_id = session()->get('user_id');
        $carttable = new CartModel();
        $producttable = new ProductModel();

        $cartrow = $carttable->find($item_id);
        $product = $producttable->find($cartrow['product_id']);

        if ($user_id == $cartrow['user_id']){
            if ($this->request->getMethod()=='post'){
                $newamount = $_POST['product_amount'];
                if ($newamount <= 0){
                    $this->removeproduct($item_id);
                } else if ($newamount > $product['product_amount']){
                    session()->setFlashdata('amount_input'.$item_id, 'There are only '.$product['product_amount'].' items left!');
                } else {
                    $updatedata = [
                        'cart_item_id' => $item_id,
                        'product_amount' => $newamount
                    ];
                    $carttable->save($updatedata);
                }
            }
        }
        return redirect()->to(base_url('/Cart'));
    }

    public function removeproduct($cart_item_id){
        $session = session();
        $carttable = new CartModel();

        $cartrow = $carttable->find($cart_item_id);
        if($cartrow['user_id'] == $session->get('user_id')){
            $carttable->delete($cart_item_id);
        }
        return redirect()->to(base_url('/cart'));
    }
}
