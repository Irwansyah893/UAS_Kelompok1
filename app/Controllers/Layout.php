<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Layout extends BaseController
{
    public function index()
    {
        return view('layout/beranda');
    }
}
