<?php

namespace App\Controllers;
use App\Models\ProductModel;
use App\Models\ProductpicModel;

class Shop extends BaseController
{
    public function index()
    {
        return $this->shoppage(0);
    }

    public function shoppage($pagenr){
        $producttable = new ProductModel();
        $picturetable = new ProductpicModel();

        $products = $producttable->findAll(20, $pagenr*20);
        $proddata = [];
        $data = [
            'products' =>[]
        ];

        foreach($products as $product){
            $pic = $picturetable->where('product_id', $product['product_id'])->first();
            $proddata = $product;
            if ($product['product_type']==='wood'){
                $proddata['package'] = 'package';
                $proddata['unit'] = 'Kg';
            } else if ($product['product_type']==='electricity'){
                $proddata['package'] = 'KWH';
            } else if ($product['product_type']==='oil'){
                $proddata['package'] = 'bottle';
                $proddata['unit'] = 'Liters';
            } else if($product['product_type']==='gas'){
                $proddata['package'] = 'canister';
                $proddata['unit'] = 'Liters';
            }
            if (isset($pic)){
                $proddata['picture_name'] = $pic['picture_name'];
            }
            array_push($data['products'], $proddata);
        }

        return view('shopfolder/shop', $data);
    }

    public function Wood()
    {
        $countries = ['Belgium', 'Netherlands', 'Germany'];
        $data = [
            'countries' => $countries
        ];

        return view('shopfolder/wood', $data);
    }

    function Oil(){
        $countries = ['Belgium', 'Netherlands', 'Germany'];
        $data = [
            'countries' => $countries
        ];
        return view('shopfolder/oil', $data);
    }

    function Gas(){
        $countries = ['Belgium', 'Netherlands', 'Germany'];
        $data = [
            'countries' => $countries
        ];
        return view('shopfolder/gas', $data);
    }

    function Electricity(){
        $countries = ['Belgium', 'Netherlands', 'Germany'];
        $data = [
            'countries' => $countries
        ];
        return view('shopfolder/electricity', $data);
    }

    function product(){
        $data = [
            'title' => 'Wood',
            'sort' => 'Pellets',
            'heritage' => 'Belgium',
            'description' => 'Really good pellet man',
            'price' => 16,
            'id' => 000001,
            'reviews' => [
                ['writer' => 'Bert', 'rating' => 4, 'overview' => 'good product'],
                ['writer' => 'Shawny', 'rating' => 5, 'overview' => 'Best i ever had'],
                ['writer' => 'John', 'rating' => 3, 'overview' => 'i\'ve had better']
            ]
        ];
        return view('shopfolder/product', $data);
    }
}
