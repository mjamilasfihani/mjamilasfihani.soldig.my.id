<?php

namespace App\Controllers;

use App\Models\CartsModel;

class Pay extends BaseController
{
	public function index()
	{
		// Deleting all the data from Carts table
		$db = db_connect();
		$builder = $db->table('carts');
		$builder->emptyTable('carts');

		return redirect()->to(base_url())->with('message', 'Sukses Melakukan Checkout');
	}
}
