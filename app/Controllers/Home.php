<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Initialize for display product in carts
        $total = 0;
        $items = $this->carts->findColumn('cart_qty');

        if ($items)
        {
            for ($i = 0; $i < count($items); $i++)
            {
                // Counting the total for each items
                $total = $items[$i] + $total;
            }
        }

        // Initialize the page
        $page = $this->request->getGet('page');

        if (! $page)
        {
            return redirect()->to(base_url('?page=1'));
        }

        // Initialize the limit
        $limitLast  = $page * 10;
        $limitFirst = $limitLast - 10;

        return view('welcome_message', [
            'products' => $this->products->limit($limitLast, $limitFirst)->get()->getResult('array'),
            'total'    => $total,
            'page'     => $page,
            'pages'    => ceil(count($this->products->findAll()) / 10),
        ]);
    }
}
