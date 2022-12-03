<?php

namespace App\Controllers;
use App\Models\DeliveryModel;
use App\Models\PickupModel;
use App\Models\ProductModel;
use App\Models\ReviewModel;

class Reviews extends BaseController
{
    public function index(){
        return redirect()->to(base_url('/'));
    }

    public function writereview($product_id){
        if (!$this->checkifbought($product_id)){
            return redirect()->to(base_url('/orders'));
        } elseif ($this->checkifalreadywritten($product_id)){
            return redirect()->to(base_url('/orders'));
        }

        $producttable = new ProductModel();

        $product = $producttable->find($product_id);

        $data = [
            'product' => $product
        ];

        if ($this->request->getMethod()=='post'){
            $rules = [
                'score' => 'required|greater_than[0]|less_than[6]',
                'description' => 'required|min_length[5]|alpha_numeric_punct|max_length[600]'
            ];

            if($this->validate($rules)){
                $reviewmodel = new ReviewModel();
                $review = [
                    'score' => $this->request->getPost('score'),
                    'description' => $this->request->getPost('description'),
                    'product_id' => $product_id,
                    'writer_id' => session()->get('user_id')
                ];
                $reviewmodel->insert($review);
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('writereview', $data);
    }

    private function checkifbought($product_id){
        $deliverytable = new DeliveryModel();
        $pickuptable = new PickupModel();

        $user_id = session()->get('user_id');

        $orders = $deliverytable->where('buyer_id', $user_id)->findAll();
        foreach($orders as $order){
            if($order['product_id'] == $product_id){
                return true;
            }
        }

        $orders2 = $pickuptable->where('buyer_id', $user_id)->findAll();
        foreach($orders2 as $order){
            if($order['product_id'] == $product_id){
                return true;
            }
        }

        return false;
    }


    private function checkifalreadywritten($product_id){
        $reviewtable = new ReviewModel();
        $userreviews = $reviewtable->where('writer_id', session()->get('user_id'))->findAll();

        foreach($userreviews as $review){
            if ($review['product_id'] == $product_id){
                return true;
            }
        }
        return false;
    }

}