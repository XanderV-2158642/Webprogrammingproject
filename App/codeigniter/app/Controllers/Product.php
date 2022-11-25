<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductpicModel;
use CodeIgniter\Validation\Rules;
use Config\Validation;

class Product extends BaseController {
    public function index()
    {
        redirect()->to('/shop');
    }

    public function productpage($id){
        $producttable = new ProductModel();
        $product = $producttable->find($id);

        $picturetable = new ProductpicModel();
        $pictures = $picturetable->where('product_id', $id)->findAll();

        $data['product'] = $product;
        $data['pictures'] = $pictures;
        $data['reviews'] = [];
        $data['packaging'] = [
            'wood' => 'per package',
            'gas' => 'per canister',
            'oil' => 'per bottle',
            'electricity' => 'per KWH'
        ];
        $data['sizeunit'] = [
            'wood' => 'Kg',
            'gas' => 'Liters',
            'oil' => 'Liters',
        ];
        return view('/shopfolder/product', $data);
    }

    public function createProduct(){
        return view('/productcreatefolder/createproduct');
    }

    public function createwood(){
        helper(['form']);
        $session = session();
        $data = [];

        if ($this->request->getMethod() === 'post'){
            $rules = $this->createrules();
            $rules['product_sort'] =[
                'rules' => 'required|in_list[other,firewood,briquette,pellet]',
                'label' => 'Sort'
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            } else {
                $newdata = $_POST;
                $newdata['user_id'] = $session->get('user_id');
                $newdata['product_type'] = 'wood';
                $files = $this->request->getFileMultiple('product_picture');

                $this->insertdata($newdata, $files);
                return redirect()->to('/profile');
            }
        }
        return view('/productcreatefolder/createwd', $data);
    }

    public function edit($productid){
        helper(['form']);
        $products = new ProductModel();
        $product = $products->find($productid);

        $session = session();

        $data = [];

        if ($session->get('user_id') === $product['user_id']){
            $data['product'] = $product;
        
            $data['product_id'] = $productid;
            $productpictures = new ProductpicModel();
            $pictures = $productpictures->where('product_id', $productid)->findAll();
            $data['pictures'] = $pictures;

            if ($this->request->getMethod() === 'post'){
                $rules = $this->editrules();
                $rules = $this->setrulesOnType($product['product_type'], $rules);

                if (!$this->validate($rules)){
                    $data['validation'] = $this->validator;
                } else {
                    $productedit = $_POST;
                    
                    $files = $this->request->getFileMultiple('product_picture');
                    $this->updateprod($productedit, $files, $productid);

                    header('Refresh:0');
                }
            }

            return view('/producteditfolder/edit'.$product['product_type'], $data);
        } else {
            $data['errormessage'] = 'You cant edit a page that is not yours!';
            return view('/errors/errorpage', $data);
        }
    }



    public function createoil()
    {
        helper(['form']);
        $session = session();
        $data = [];

        if ($this->request->getMethod() === 'post'){
            $rules = $this->createrules();
            $rules['product_sort'] =[
                'rules' => 'required|in_list[other,petroleum,synthetic]',
                'label' => 'Sort'
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            } else {
                $newdata = $_POST;
                $newdata['user_id'] = $session->get('user_id');
                $newdata['product_type'] = 'oil';
                $files = $this->request->getFileMultiple('product_picture');

                $this->insertdata($newdata, $files);
               
                return redirect()->to('/profile');
            }
        }

        return view('/productcreatefolder/createoil', $data);
    }


    public function creategas(){

        helper(['form']);
        $session = session();
        $data = [];

        if ($this->request->getMethod() === 'post'){
            $rules = $this->createrules();
            $rules['product_sort'] =[
                'rules' => 'required|in_list[other,methane,propane,butane,bio]',
                'label' => 'Sort'
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            } else {
                $newdata = $_POST;
                $newdata['user_id'] = $session->get('user_id');
                $newdata['product_type'] = 'gas';
                
                $files = $this->request->getFileMultiple('product_picture');

                $this->insertdata($newdata, $files);
               
                return redirect()->to('/profile');
            }
        }


        return view('/productcreatefolder/creategas', $data);
    }

    public function createelec(){

        helper(['form']);
        $session = session();
        $data = [];

        if ($this->request->getMethod() === 'post'){
            $rules = $this->createrules();
            unset($rules['product_size']);

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            } else {
                $newdata = $_POST;
                $newdata['user_id'] = $session->get('user_id');
                $newdata['product_size'] = 1;
                $newdata['product_type'] = 'electricity';
                $files = $this->request->getFileMultiple('product_picture');

                $this->insertdata($newdata, $files);
               
                return redirect()->to('/profile');
            }
        }
        return view('/productcreatefolder/createelec', $data);
    }


    private function insertfiles($files, $productid){
        foreach ($files as $file){
            if ($file->isValid() && ! $file->hasMoved()){
                $file->move('./Images/Product');
                $pics = new ProductpicModel();
                $picdata = [
                    'picture_name' => $file->getName(),
                    'product_id' => $productid
                ];
                $pics->insert($picdata);
            }
        }
    }

    private function insertdata($newdata, $files){
        $products = new ProductModel();
        $productid = $products->insert($newdata);

        foreach ($files as $file){
            if ($file->isValid() && ! $file->hasMoved()){
                $file->move('./Images/Product');
                $pics = new ProductpicModel();
                $picdata = [
                    'picture_name' => $file->getName(),
                    'product_id' => $productid
                ];
                $pics->insert($picdata);
            }
        }
    }

    private function updateprod($updatedata, $files, $productid ){
        $producttable = new ProductModel();
        $updatedata['product_id'] = $productid;

        $producttable->save($updatedata);

        if (!empty($files)){
            $this->insertfiles($files, $productid);
        }
        header('Refresh:0');

    }

    private function createrules(){
        $rules = [
            'product_title' => [
                'rules' => 'required|max_length[100]',
                'label' => 'Title'
            ],
            'product_price' => [
                'rules' => 'required|greater_than[0]',
                'label' => 'Price'
            ],
            'product_heritage' => [
                'rules' => 'required|max_length[100]',
                'label' => 'Heritage'
            ],
            'product_size' => [
                'rules' => 'required|greater_than[0]',
                'label' => 'Package Size'
            ],
            'product_amount' => [
                'rules' => 'required|greater_than[0]',
                'label' => 'Amount'
            ],
            'product_description' => [
                'rules' => 'required',
                'label' => 'Description'
            ],
            'product_picture' => [
                'rules' => 'uploaded[product_picture]|max_size[product_picture, 1024]|is_image[product_picture]',
                'label' => 'Picture'
            ]
        ];
        return $rules;
    }

    private function editrules(){
        $rules = $this->createrules();
        unset($rules['product_picture']);
        $rules['product_picture'] = [
            'rules' => 'max_size[product_picture, 1024]|is_image[product_picture]',
            'label' => 'Picture'
        ];

        return $rules;
    }


    public function removepic($picture_id){
        $picturetable = new ProductpicModel();
        $producttable = new ProductModel();


        $picture = $picturetable ->find($picture_id);
        $product = $producttable->find($picture['product_id']);



        $user_id = session()->get('user_id');

        if($user_id === $product['user_id']){
            $picpath = './Images/Product/'.$picture['picture_name'];

            helper('filesystem');

            unlink($picpath);

            $picturetable->delete($picture['picture_id']);

            return redirect()->back();
        }
    }

    private function setrulesOnType($product_type, $rules){
        if ($product_type==='wood'){
            $rules['product_sort'] = [
                'rules' => 'required|in_list[other,firewood,briquette,pellet]',
                'label' => 'Sort'
            ];
        } else if ($product_type==='oil'){
            $rules['product_sort'] =[
                'rules' => 'required|in_list[other,petroleum,synthetic]',
                'label' => 'Sort'
            ];

        } else if ($product_type==='gas'){
            $rules['product_sort'] =[
                'rules' => 'required|in_list[other,methane,propane,butane,bio]',
                'label' => 'Sort'
            ];
        } else if ($product_type==='electricity'){
            unset($rules['product_size']);
        }
        return $rules;
    }
}