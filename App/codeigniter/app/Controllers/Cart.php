<?php

namespace App\Controllers;

class Cart extends BaseController
{
    public function index()
    {
        $data = [
            'products' =>[['title' => 'pellets', 'id' => 2005]],
            'price' => 190
        ];


        return view('cart', $data);
    }
}
