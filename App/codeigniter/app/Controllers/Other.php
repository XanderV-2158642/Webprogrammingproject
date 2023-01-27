<?php

namespace App\Controllers;

class Other extends BaseController
{
    public function index()
    {
        return redirect()->to(base_url());
    }

    public function accessibility(){
        return view('accessibility');
    }

    public function contact(){
        return view('contact');
    }

}