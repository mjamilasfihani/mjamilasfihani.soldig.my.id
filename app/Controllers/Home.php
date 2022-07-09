<?php

namespace App\Controllers;

use App\Models\ProductsModel;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message', ['products' => (new ProductsModel)->findAll()]);
    }
}
