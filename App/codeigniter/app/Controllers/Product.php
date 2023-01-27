<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\NotifyRequestModel;
use App\Models\NotificationModel;
use App\Models\ProductModel;
use App\Models\ProductpicModel;
use App\Models\ProductVideoModel;
use App\Models\ReviewModel;
use App\Models\UserModel;
use CodeIgniter\Validation\Rules;
use Config\Validation;

class Product extends BaseController {
    public function index()
    {
        redirect()->to('/Shop');
    }

    public function productpage($id){
        $usertable = new UserModel();

        $producttable = new ProductModel();
        $product = $producttable->find($id);

        $picturetable = new ProductpicModel();
        $pictures = $picturetable->where('product_id', $id)->findAll();

        $reviewtable = new ReviewModel();
        $revs = $reviewtable->where('product_id', $id)->findAll();

        $reviews = [];
        foreach($revs as $review){
            $user = $usertable->find($review['writer_id']);
            $review['user'] = $user;
            array_push($reviews, $review);
        }

        $vids = new ProductVideoModel();
        $video = $vids->where('product_id', $id)->first();


        $data['product'] = $product;
        $data['pictures'] = $pictures;

        if(!empty($video)){
            $data['video'] = $video;
        }

        $data['reviews'] = $reviews;
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
        $data = [
            'stylesheets'=>[
                '/CSS/products.css'
            ]
        ];

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
                if(!$this->haspicture($files)){
                    $data['nopicture'] = true;
                    return view('/productcreatefolder/createwd', $data);
                }

                $this->insertdata($newdata, $files);
                return redirect()->to(base_url('/Profile'));
            }
        }
        return view('/productcreatefolder/createwd', $data);
    }

    public function edit($productid){
        helper(['form']);
        $products = new ProductModel();
        $product = $products->find($productid);

        $session = session();

        $data = [
            'stylesheets'=>[
                '/CSS/products.css'
            ]
        ];

        if ($session->get('user_id') === $product['user_id']){
            $data['product'] = $product;
        
            $data['product_id'] = $productid;
            $productpictures = new ProductpicModel();
            $pictures = $productpictures->where('product_id', $productid)->findAll();
            $data['pictures'] = $pictures;

            $vids = new ProductVideoModel();
            $video = $vids->where('product_id', $productid)->first();
            if(!empty($video)){
                $data['video'] = $video;
            }

            if ($this->request->getMethod() === 'post'){
                $rules = $this->editrules();
                $rules = $this->setrulesOnType($product['product_type'], $rules);

                if (!$this->validate($rules)){
                    $data['validation'] = $this->validator;
                } else {
                    $productedit = $_POST;
                    
                    $files = $this->request->getFileMultiple('product_picture');
                    $this->updateprod($productedit, $files, $productid);

                    return redirect()->to(base_url('/Profile'));
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
        $data = [
            'stylesheets'=>[
                '/CSS/products.css'
            ]
        ];

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
                if(!$this->haspicture($files)){
                    $data['nopicture'] = true;
                    return view('/productcreatefolder/createoil', $data);
                }

                $this->insertdata($newdata, $files);
               
                return redirect()->to('/Profile');
            }
        }

        return view('/productcreatefolder/createoil', $data);
    }


    public function creategas(){

        helper(['form']);
        $session = session();
        $data = [
            'stylesheets'=>[
                '/CSS/products.css'
            ]
        ];

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
                if(!$this->haspicture($files)){
                    $data['nopicture'] = true;
                    return view('/productcreatefolder/creategas', $data);
                }

                $this->insertdata($newdata, $files);
               
                return redirect()->to('/Profile');
            }
        }


        return view('/productcreatefolder/creategas', $data);
    }

    public function createelec(){

        helper(['form']);
        $session = session();
        $data = [
            'stylesheets'=>[
                '/CSS/products.css'
            ]
        ];

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
                if(!$this->haspicture($files)){
                    $data['nopicture'] = true;
                    return view('/productcreatefolder/createelec', $data);
                }

                $this->insertdata($newdata, $files);
               
                return redirect()->to('/Profile');
            }
        }
        return view('/productcreatefolder/createelec', $data);
    }


    private function insertfiles($files, $productid){
        $vids = new ProductVideoModel();
        $pics = new ProductpicModel();
        foreach ($files as $file){
            if ($file->isValid() && ! $file->hasMoved()){
                if ($file->guessExtension()=='mp4'){
                    if (!$this->hasvid($productid)){
                        $file->move('./Videos/Product');
                        $viddata = [
                            'video_name' => $file->getName(),
                            'product_id' => $productid
                        ];
                        $vids->insert($viddata);
                    }
                } elseif ($file->getExtension() == 'jpg') {
                    $file->move('./Images/Product');   
                    $picdata = [
                        'picture_name' => $file->getName(),
                        'product_id' => $productid
                    ];
                    $pics->insert($picdata);
                }
            }
        }
    }

    private function insertdata($newdata, $files){
        $products = new ProductModel();
        $productid = $products->insert($newdata);

        $pics = new ProductpicModel();
        $vids = new ProductVideoModel();
        foreach ($files as $file){
            if ($file->isValid() && !$file->hasMoved()){
                if ($file->guessExtension()=='mp4'){
                    if (!$this->hasvid($productid)){
                        $file->move('./Videos/Product');
                        $viddata = [
                            'video_name' => $file->getName(),
                            'product_id' => $productid
                        ];
                        $vids->insert($viddata);
                    }
                } elseif ($file->getExtension() == 'jpg') {
                    $file->move('./Images/Product');
                    $picdata = [
                        'picture_name' => $file->getName(),
                        'product_id' => $productid
                    ];
                    $pics->insert($picdata);
                }
            }
        }
    }

    private function hasvid($product_id){
        $vids = new ProductVideoModel();
        $productvid = $vids->where('product_id', $product_id)->findAll();
        return !empty($productvid);
    }

    private function haspicture($files){
        foreach($files as $file){
            if ($file->guessExtension()=='jpg'){
                return true;
            }
        }
        return false;
    }

    private function updateprod($updatedata, $files, $productid ){
        $producttable = new ProductModel();
        $updatedata['product_id'] = $productid;

        $producttable->save($updatedata);

        if (!empty($files)){
            $this->insertfiles($files, $productid);
        }

        if ($updatedata['product_amount']>0){
            $this->transferNotifications($productid);
        }
    }

    private function transferNotifications($product_id){
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
                'rules' => 'uploaded[product_picture]|max_size[product_picture, 10000]|ext_in[product_picture,jpg,mp4]',
                'label' => 'Picture or Video'
            ]
        ];
        return $rules;
    }

    private function editrules(){
        $rules = $this->createrules();
        unset($rules['product_picture']);
        $rules['product_picture'] = [
            'rules' => 'max_size[product_picture, 10000]|ext_in[product_picture,jpg,mp4]',
            'label' => 'Picture or Video'
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

    public function removeproduct($product_id){
        $producttable = new ProductModel();

        $product = $producttable->find($product_id);

        $session_user = session()->get('user_id');

        if ($session_user == $product['user_id']){
            // $picturetable = new ProductpicModel();
            // $pictures = $picturetable->where('product_id', $product['product_id'])->findAll();
            // foreach ($pictures as $pic){
            //     $this->removepic($pic['picture_id']);
            // }

            // $videotable = new ProductVideoModel();
            // $vids = $videotable->where('product_id', $product_id)->findAll();
            // foreach ($vids as $vid) {
            //     $this->removevid($vid['video_id']);
            // }
            $data = [
                'product_amount' => 0
            ];
            $producttable->update($product_id, $data);
            return redirect()->back();
        }
    }

    public function removevid($video_id){

        $videotable = new ProductVideoModel();
        $producttable = new ProductModel();

        $vid = $videotable->find($video_id);
        $product = $producttable->find($vid['product_id']);

        $user_id = session()->get('user_id');

        if ($user_id === $product['user_id']){
            $vidpath = './Videos/Product/'.$vid['video_name'];

            helper(['filesystem']);

            unlink($vidpath);

            $videotable->delete($video_id);
        }

        return redirect()->back();
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