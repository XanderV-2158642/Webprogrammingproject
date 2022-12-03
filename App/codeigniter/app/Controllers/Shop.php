<?php

namespace App\Controllers;
use App\Models\ProductModel;
use App\Models\ProductpicModel;

class Shop extends BaseController
{
    public function index()
    {
        return $this->shoppage(1);
    }

    public function shoppage($pagenr){
        $producttable = new ProductModel();
        $picturetable = new ProductpicModel();

        $db = db_connect();
        $query = $db->query("SELECT count(*) as count FROM Products");
        $totalproducts =  $query->getResultArray()[0]['count'];

        $ppp = 10; //products per page
        $lastpage = ceil($totalproducts/$ppp);
        if ($lastpage == 0){ //no products -> change lastpage to dodge malfunctioning display
            $lastpage = 1;
        }

        $products = $producttable->findAll($ppp, ($pagenr-1)*$ppp);
        $proddata = [];
        $data = [
            'products' => [],
            'pagenr' => $pagenr,
            'lastpage' => $lastpage
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

        if ($pagenr>$lastpage || $pagenr < 1){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('shopfolder/shop', $data);
    }

    public function Wood($pagenr=1)
    {
        helper(['form']);
        $db = db_connect();

        $querystring = "
                        FROM Products
                        WHERE product_type = 'wood'";
        
        if ($this->request->getMethod() == 'get'){
            $sorts = $this->request->getGet('product_sort');
            $heritage = $this->request->getGet('heritage');
            $minprice =  $this->request->getGet('min_price');
            $maxprice = $this->request->getGet('max_price');

            $querystring = $this->queryfilter($sorts, $heritage, $minprice, $maxprice, $querystring);
            if (!isset($sorts)){
                $sorts = [];
            }
        }

        $ppp = 10; //products per page
        //count amount of products------------------
        $query = $db->query("SELECT count(*) as count ".$querystring);
        $totalproducts =  $query->getResultArray()[0]['count'];

        $lastpage = ceil($totalproducts/$ppp);
        if ($lastpage == 0){ //no products -> change lastpage to dodge malfunctioning display
            $lastpage = 1;
        }
        //--------------------------------------

        
        $querystring ="SELECT * ". $querystring." LIMIT ".strval(($pagenr-1)*$ppp).", ".strval($ppp);


        // get different heritages out db------------------------------------- 
        $countries = $this->getcountries('wood');
        //------------------------------------
        $uri = $_SERVER['REQUEST_URI'];
        $filteruri = $this->getfilteruri($uri);

        $data = [
            'countries' => $countries,
            'products'  => [],
            'pagenr' => $pagenr,
            'lastpage' => $lastpage,
            'form' => [
                'heritage' => $heritage,
                'minprice' => $minprice,
                'maxprice' => $maxprice,
                'sorts' => $sorts
            ],
            'filteruri' => $filteruri
        ];

        $query = $db->query($querystring);
        $products = $query->getResultArray();
        foreach($products as $product){
            $proddata = $this->proddata($product, 'package', 'kg');
            array_push($data['products'], $proddata);
        }

        if ($pagenr>$lastpage || $pagenr < 1){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('shopfolder/wood', $data);
    }

    



    public function Oil($pagenr = 1){
        
        helper(['form']);
        $db = db_connect();

        $querystring = "
                        FROM Products
                        WHERE product_type = 'oil'";
        
        if ($this->request->getMethod() == 'get'){
            $sorts = $this->request->getGet('product_sort');
            $heritage = $this->request->getGet('heritage');
            $minprice =  $this->request->getGet('min_price');
            $maxprice = $this->request->getGet('max_price');

            $querystring = $this->queryfilter($sorts, $heritage, $minprice, $maxprice, $querystring);
            if (!isset($sorts)){
                $sorts = [];
            }
        }

        $ppp = 10; //products per page
        //count amount of products------------------
        $query = $db->query("SELECT count(*) as count ".$querystring);
        $totalproducts =  $query->getResultArray()[0]['count'];

        $lastpage = ceil($totalproducts/$ppp);
        if ($lastpage == 0){ //no products -> change lastpage to dodge malfunctioning display
            $lastpage = 1;
        }
        //--------------------------------------

        
        $querystring ="SELECT * ". $querystring." LIMIT ".strval(($pagenr-1)*$ppp).", ".strval($ppp);


        // get different heritages out db------------------------------------- 
        $countries = $this->getcountries('oil');
        //------------------------------------
        $uri = $_SERVER['REQUEST_URI'];
        $filteruri = $this->getfilteruri($uri);

        $data = [
            'countries' => $countries,
            'products'  => [],
            'pagenr' => $pagenr,
            'lastpage' => $lastpage,
            'form' => [
                'heritage' => $heritage,
                'minprice' => $minprice,
                'maxprice' => $maxprice,
                'sorts' => $sorts
            ],
            'filteruri' => $filteruri
        ];

        $query = $db->query($querystring);
        $products = $query->getResultArray();
        foreach($products as $product){
            $proddata = $this->proddata($product, 'bottle', 'liters');
            array_push($data['products'], $proddata);
        }

        if ($pagenr>$lastpage || $pagenr < 1){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('shopfolder/oil', $data);
    }

    public function Gas($pagenr = 1){
        helper(['form']);
        $db = db_connect();

        $querystring = "
                        FROM Products
                        WHERE product_type = 'gas'";
        
        if ($this->request->getMethod() == 'get'){
            $sorts = $this->request->getGet('product_sort');
            $heritage = $this->request->getGet('heritage');
            $minprice =  $this->request->getGet('min_price');
            $maxprice = $this->request->getGet('max_price');

            $querystring = $this->queryfilter($sorts, $heritage, $minprice, $maxprice, $querystring);
            if (!isset($sorts)){
                $sorts = [];
            }
        }

        $ppp = 10; //products per page
        //count amount of products------------------
        $query = $db->query("SELECT count(*) as count ".$querystring);
        $totalproducts =  $query->getResultArray()[0]['count'];

        $lastpage = ceil($totalproducts/$ppp);
        if ($lastpage == 0){ //no products -> change lastpage to dodge malfunctioning display
            $lastpage = 1;
        }
        //--------------------------------------

        
        $querystring ="SELECT * ". $querystring." LIMIT ".strval(($pagenr-1)*$ppp).", ".strval($ppp);


        // get different heritages out db------------------------------------- 
        $countries = $this->getcountries('gas');
        //------------------------------------
        $uri = $_SERVER['REQUEST_URI'];
        $filteruri = $this->getfilteruri($uri);

        $data = [
            'countries' => $countries,
            'products'  => [],
            'pagenr' => $pagenr,
            'lastpage' => $lastpage,
            'form' => [
                'heritage' => $heritage,
                'minprice' => $minprice,
                'maxprice' => $maxprice,
                'sorts' => $sorts
            ],
            'filteruri' => $filteruri
        ];

        $query = $db->query($querystring);
        $products = $query->getResultArray();
        foreach($products as $product){
            $proddata = $this->proddata($product, 'canister', 'liters');
            array_push($data['products'], $proddata);
        }

        if ($pagenr>$lastpage || $pagenr < 1){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('shopfolder/gas', $data);
    }

    public function Electricity($pagenr=1){
        helper(['form']);
        $db = db_connect();

        $querystring = "
                        FROM Products
                        WHERE product_type = 'electricity'";
        
        if ($this->request->getMethod() == 'get'){
            $sorts = $this->request->getGet('product_sort');
            $heritage = $this->request->getGet('heritage');
            $minprice =  $this->request->getGet('min_price');
            $maxprice = $this->request->getGet('max_price');

            $querystring = $this->queryfilter($sorts, $heritage, $minprice, $maxprice, $querystring);
            if (!isset($sorts)){
                $sorts = [];
            }
        }

        $ppp = 10; //products per page
        //count amount of products------------------
        $query = $db->query("SELECT count(*) as count ".$querystring);
        $totalproducts =  $query->getResultArray()[0]['count'];

        $lastpage = ceil($totalproducts/$ppp);
        if ($lastpage == 0){ //no products -> change lastpage to dodge malfunctioning display
            $lastpage = 1;
        }
        //--------------------------------------

        
        $querystring ="SELECT * ". $querystring." LIMIT ".strval(($pagenr-1)*$ppp).", ".strval($ppp);


        // get different heritages out db------------------------------------- 
        $countries = $this->getcountries('electricity');
        //------------------------------------
        $uri = $_SERVER['REQUEST_URI'];
        $filteruri = $this->getfilteruri($uri);

        $data = [
            'countries' => $countries,
            'products'  => [],
            'pagenr' => $pagenr,
            'lastpage' => $lastpage,
            'form' => [
                'heritage' => $heritage,
                'minprice' => $minprice,
                'maxprice' => $maxprice,
                'sorts' => $sorts
            ],
            'filteruri' => $filteruri
        ];

        $query = $db->query($querystring);
        $products = $query->getResultArray();
        foreach($products as $product){
            $proddata = $this->proddata($product, 'KWH', '');
            array_push($data['products'], $proddata);
        }

        if ($pagenr>$lastpage || $pagenr < 1){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('shopfolder/electricity', $data);
    }

    
    private function queryfilter($sorts, $heritage, $minprice, $maxprice, $querystring){
        $db = db_connect();
        if (isset($sorts)){
            $sortcond = "(product_sort = ".$db->escape($sorts[0])."";
            for ($i= 1 ; $i < count($sorts); $i++){
                $sortcond = $sortcond." OR "."product_sort = ".$db->escape($sorts[$i])."";
            }
            $sortcond = $sortcond.")";
            $querystring = $querystring." AND ".$sortcond;
        } 

        $hercond = "";
        if ($heritage != 'All' && $heritage != "" ){
            $hercond = "product_heritage = ".$db->escape($heritage)."";
            $querystring = $querystring." AND ".$hercond;
        }

        $minpricecond = "";
        if ($minprice != ""){
            $minpricecond = "product_price >= ".$db->escape($minprice);
            $querystring = $querystring." AND ".$minpricecond;
        }

        $maxpricecond = "";
        if ($maxprice != ""){
            $maxpricecond = "product_price <= ".$db->escape($maxprice);
            $querystring = $querystring." AND ".$maxpricecond;
        }
        return $querystring;
    }

    private function proddata($product, $package, $unit){
        $proddata = $product;
        $proddata['package'] = $package;
        $proddata['unit'] = $unit;
        $picturetable = new ProductpicModel();
        $pic = $picturetable->where('product_id', $product['product_id'])->first();
        if (isset($pic)){
            $proddata['picture_name'] = $pic['picture_name'];
        }
        return $proddata;
    }

    private function getcountries($producttype){
        $db = db_connect();
        $query = $db->query("SELECT DISTINCT product_heritage as country FROM Products WHERE product_type = '".$producttype."'");
        $countryresult = $query->getResultArray();
        $query->freeResult();

        $countries = [];
        foreach ($countryresult as $country){
            array_push($countries, $country['country']);
        }
        return $countries;
    }

    private function getfilteruri($fulluri){
        $uriparts = explode("?", $fulluri);
        $filteruri = "";
        for ($i = 1; $i < count($uriparts); $i++){
            $filteruri = $filteruri."?".$uriparts[$i];
        }
        return $filteruri;
    }
}
