<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\CartsModel;

class Home extends BaseController
{
    public function index()
    {
        // Initialize for display product in carts
        $total = 0;
        $items = (new CartsModel)->findColumn('cart_qty');

        if ($items)
        {
            for ($i = 0; $i < count($items); $i++)
            {
                // Counting the total for each items
                $total = $items[$i] + $total;
            }
        }

        return view('welcome_message', [
            'products' => (new ProductsModel)->findAll(),
            'total'    => $total,
        ]);
    }
}
