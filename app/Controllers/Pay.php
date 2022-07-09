<?php

namespace App\Controllers;

class Pay extends BaseController
{
	public function index()
	{
		// Deleting all the data from Carts table
		$this->db
			 ->table('carts')
			 ->emptyTable('carts');

		return redirect()->to(base_url())->with('message', 'Sukses Melakukan Checkout');
	}
}
