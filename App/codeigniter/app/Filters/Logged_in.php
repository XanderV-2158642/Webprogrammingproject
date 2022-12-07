<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Logged_in implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if ((session()->get('logged_in'))){
            return redirect()->to(base_url('/Profile'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}