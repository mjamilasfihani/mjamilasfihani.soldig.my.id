<?php

namespace App\Controllers;

class Cart extends BaseController
{
	public function index()
	{
		// Since it's from different tables, we need to grab all of it
		$builder = $this->db->table('carts');
		$builder->select('*');
		$builder->join('products', 'products.product_id = carts.cart_product_id');
		$query = $builder->get();

		return view('cart', ['datas' => $query->getResult('array')]);
	}

	public function create()
	{
		// Get the product_id
		$product_id = $this->request->getPost('product_id');

		// Check it for first time
		if (count($this->carts->where('cart_product_id', $product_id)->findAll()) > 0)
		{
			// Initialize the QTY
			$qty = 1 + ($this->carts->where('cart_product_id', $product_id)->first())['cart_qty'];

			// Update instead of Insert
			$this->carts->whereIn('cart_product_id', [$product_id])
				 ->set(['cart_qty' => $qty])
				 ->update();
		}
		else
		{
			// Insert directly
			$this->carts->insert([
				'cart_product_id' => $product_id,
				'cart_qty'		  => 1,
			]);
		}

		// Initialize the product
		$this->products->update($product_id, [
			'product_stock' => ($this->products->find($product_id))['product_stock'] - 1
		]);

		return redirect()->back()->with('message', 'Sukses Menambahkan Produk');
	}

	public function remove()
	{
		// Get the product_id
		$product_id = $this->request->getPost('product_id');

		// Initialize the QTY
		$qty = ($this->carts->where('cart_product_id', $product_id)->first())['cart_qty'] - 1;

		// Update the latest total
		$this->carts->whereIn('cart_product_id', [$product_id])
			 ->set(['cart_qty' => $qty])
			 ->update();

		// Initialize the product
		$this->products->update($product_id, [
			'product_stock' => ($this->products->find($product_id))['product_stock'] + 1
		]);

		return redirect()->back()->with('message', 'Sukses Mengurangi Produk');
	}

	public function cancel()
	{
		// Get the product_id
		$product_id = $this->request->getPost('product_id');

		// Initialize the QTY
		$qty = ($this->carts->where('cart_product_id', $product_id)->first())['cart_qty'];

		// Initialize the product
		$this->products->update($product_id, [
			'product_stock' => ($this->products->find($product_id))['product_stock'] + $qty
		]);

		// Delete the data from cart
		$this->carts->where('cart_product_id', $product_id)->delete();

		return redirect()->back()->with('message', 'Sukses Membatalkan Produk');
	}
}
