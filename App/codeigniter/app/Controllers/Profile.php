<?php

namespace App\Controllers;

use App\Models\DeliveryModel;
use App\Models\PickupModel;
use App\Models\ProductModel;
use App\Models\ProfilepicModel;
use App\Models\UserModel;
use Config\Validation;

class Profile extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');        
        if($logged_in){
            $id = $session->get('user_id');
        } else{
            return $this->login();
        }         
        return $this->profilepage($id);
    }

    public function profilepage($id){
        $session = session();
        $users = new UserModel();
        $profile = $users->find($id);
        $profilepics = new ProfilepicModel();
        $pics = $profilepics->where('user_id', $id)->findAll();

        $producttable = new ProductModel();
        $products = $producttable->where('user_id', $id)->findAll();
        $prods = [];
        foreach ($products as $product){
            $product['amount_sold'] = $this->getSoldAmount($product['product_id']);
            array_push($prods, $product);
        }

        if ($profile == null){
            $data = [
                'profilenotfound' => true
            ];
        } else {
            $data = [
                'name' => $profile['user_name'],
                'description' => $profile['user_description'],
                'page' => $profile['user_id'],
                'loggedinuser' => $session->get('user_id'),
                'Email' => $profile['user_email'],
                'Phone' => $profile['user_phone'],
                'pictures' => $pics,
                'products' => $prods
            ];
        }

        return view('profilefolder/profilepage', $data);
    }

    public function logout(){
        session()->destroy();
        return redirect()->to(base_url());
    }

    public function login()
    {
        helper(['form']);
        $data = [
            'stylesheets' =>['/css/profile.css']
        ];

        if ($this->request->getMethod() === 'post'){
            $logindata = $_POST;
            $usermodel = new UserModel();
            $user = $usermodel->where('user_email', $logindata['user_email'])->first();
            if($user != null){
                if(password_verify($logindata['user_password'], $user['user_password'])){
                    $session = session();
                    $sessiondata = [
                        'logged_in' => true,
                        'user_id'  =>  $user['user_id'],
                        'user_email' => $user['user_email'],
                        'user_name' => $user['user_name']
                    ];
                    $session->set($sessiondata);
                    return redirect()->to(base_url('profile'));
                } else {
                    $data['passworderror'] = true;
                }
            } else{
                $data['userfound'] = false;
            }
        }

        return view('profilefolder/loginpage', $data);
    }

    public function createprofile(){
        helper(['form']);
        $data = [
            'stylesheets' =>['/css/profile.css']
        ];

        if($this->request->getMethod() === 'post'){ 
            $rules = [
                'user_name' => [
                    'rules' => 'required',
                    'label' => 'Name'],
                'user_email' => [
                    'rules' => 'required|valid_email|is_unique[Users.user_email]',
                    'label' => 'Email address',
                    'errors' => ['is_unique' => 'This email address is already in use']],
                'user_password' => [
                    'rules' => 'required|min_length[8]',
                    'label' => 'Password'],
                'user_phone' => [
                    'rules' => 'required|min_length[9]|max_length[11]',
                    'label' => 'Phone number'],
                'confirmpassword' => [
                    'rules' => 'matches[user_password]',
                    'label' => 'Confirm Password'],
                'user_picture' => [
                    'rules' => 'max_size[user_picture, 1024]|is_image[user_picture]',
                    'label' => 'Picture',
                    'errors' => [ 'max_size' => 'Max size is 1 MB']
                ]
            ];

            if( $this->validate($rules) ) {

                $data['succes'] = true;
                $model = new UserModel();
                $newuser = $_POST;
                $newuser['user_password'] = password_hash($this->request->getPost('user_password'), PASSWORD_DEFAULT);
                // $model->save([
                //     'user_name' => $this->request->getPost('user_name'),
                //     'user_email' => $this->request->getPost('user_email'),
                //     'user_phone' => $this->request->getPost('user_phone'),
                //     'user_password' => password_hash($this->request->getPost('user_password'), PASSWORD_DEFAULT),
                //     'user_description' => $this->request->getPost('user_description')
                //     ]
                // );
                $model->insert($newuser);
                $user_id = $model->where('user_email', $newuser['user_email'])->first()['user_id'];

                $files = $this->request->getFileMultiple('user_picture');
                foreach ($files as $file){
                    if ($file->isValid() && ! $file->hasMoved()){
                        $file->move('./Images/Profile');
                        $pics = new ProfilepicModel();
                        $picdata = [
                            'picture_name' => $file->getName(),
                            'user_id' => $user_id
                        ];
                        $pics->insert($picdata);
                    }
                }

                return view('profilefolder/loginpage', $data);
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('profilefolder/createprofilepage', $data);
    }

    public function edit(){
        helper(['form']);
        $data = [
            'stylesheets' => ['/CSS/profile.css']
        ];
        
        if($this->request->getMethod() === 'post'){
            $rules = [
                'user_name' => [
                    'rules' => 'required',
                    'label' => 'Name'],
                'user_phone' => [
                    'rules' => 'required|min_length[9]|max_length[11]',
                    'label' => 'Phone number'],
                'picture' => [
                    'rules' => 'max_size[picture, 1024]|is_image[picture]',
                    'label' => 'Picture'
                ]
            ];

            if($this->request->getPost('user_password') !=''){
                $rules['user_password'] = [
                    'rules' => 'required|min_length[8]',
                    'label' => 'Password'];
                $rules['confirmpassword'] = [
                    'rules' => 'matches[user_password]',
                    'label' => 'Confirm Password'];
            }

            if ($this->request->getPost('user_email') !=''){
                $rules['user_email'] = [
                    'rules' => 'valid_email|is_unique[Users.user_email]',
                    'label' => 'Email address',
                    'errors' => ['is_unique' => 'This email address is already in use']
                ];
            }
            
            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            } else {
                $newdata = [
                    'user_id' => session()->get('user_id'),
                    'user_name' => $this->request->getPost('user_name'),
                    'user_phone' => $this->request->getPost('user_phone'),
                    'user_description' => $this->request->getPost('user_description'),
                ];
                if($this->request->getPost('user_password') !=''){
                    $newdata['user_password'] = password_hash($this->request->getPost('user_password'), PASSWORD_DEFAULT);
                }
                if($this->request->getPost('user_email') !=''){
                    $newdata['user_email'] = $this->request->getPost('user_email');
                }
                $users = new UserModel();
                $users->save($newdata);

                $files = $this->request->getFileMultiple('picture');
                if (!empty($files)){
                    foreach ($files as $file){
                        if ($file->isValid() && ! $file->hasMoved()){
                            $file->move('./Images/Profile');
                            $pics = new ProfilepicModel();
                            $picdata = [
                                'picture_name' => $file->getName(),
                                'user_id' => $newdata['user_id']
                            ];
                            $pics->insert($picdata);
                        }
                    }
                }

                session()->setFlashdata('success', 'Succesfully Updated profile');
                return redirect()->to('/Profile');
            }
        }
        $user_id = session()->get('user_id');
        $users = new UserModel();
        $user = $users->find($user_id);

        $profilepics = new ProfilepicModel();
        $pics = $profilepics->where('user_id', $user['user_id'])->findAll();

        $data['user'] = $user;
        $data['pictures'] = $pics;

        return view('/profilefolder/editprofile', $data);
    }


    public function removepic($number){

        $session = session();
        $userid = $session->get('user_id');

        $profilepics = new ProfilepicModel();
        $allpics = $profilepics->where('user_id', $userid)->findAll();

        $pictoremove = $allpics[$number];

        $picpath = './Images/Profile/'.$pictoremove['picture_name'];

        helper('filesystem');

        unlink($picpath);

        $profilepics->delete($pictoremove['picture_id']);
        
        return redirect()->to('/Profile/edit');
    }

    private function getSoldAmount($product_id){
        $deliverytable = new DeliveryModel();
        $pickuptable = new PickupModel();

        $amount_sold = 0;

        $deliveries = $deliverytable->where('product_id', $product_id)->findAll();
        foreach($deliveries as $delivery){
            $amount_sold += $delivery['amount'];
        }

        $pickups = $pickuptable->where('product_id', $product_id)->findAll();
        foreach($pickups as $pickup){
            $amount_sold += $pickup['amount'];
        }

        return $amount_sold;
    }
}
