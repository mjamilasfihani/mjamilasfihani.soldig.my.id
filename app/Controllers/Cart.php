<?php

namespace App\Controllers;

use App\Models\CartsModel;
use App\Models\ProductsModel;

class Cart extends BaseController
{
	public function index()
	{
		// Initialize for database joining
		$db = db_connect();

		// Since it's from different tables, we need to grab all of it
		$builder = $db->table('carts');
		$builder->select('*');
		$builder->join('products', 'products.product_id = carts.cart_product_id');
		$query = $builder->get();

		return view('cart', ['datas' => $query->getResult('array')]);
	}

	public function create()
	{
		// Get the product_id
		$product_id = $this->request->getPost('product_id');

		// Initialize the model
		$cart = new CartsModel();

		// Check it for first time
		if (count($cart->where('cart_product_id', $product_id)->findAll()) > 0)
		{
			// Initialize the QTY
			$qty = 1 + ($cart->where('cart_product_id', $product_id)->first())['cart_qty'];

			// Update instead of Insert
			$cart->whereIn('cart_product_id', [$product_id])
				 ->set(['cart_qty' => $qty])
				 ->update();
		}
		else
		{
			// Insert directly
			$cart->insert([
				'cart_product_id' => $product_id,
				'cart_qty'		  => 1,
			]);
		}

		// Initialize the product
		$product = new ProductsModel();
		$product->update($product_id, [
			'product_stock' => ($product->find($product_id))['product_stock'] - 1
		]);

		return redirect()->back()->with('message', 'Sukses Menambahkan Produk');
	}

	public function remove()
	{
		// Get the product_id
		$product_id = $this->request->getPost('product_id');

		// Initialize the model
		$cart = new CartsModel();

		// Initialize the QTY
		$qty = ($cart->where('cart_product_id', $product_id)->first())['cart_qty'] - 1;

		// Update the latest total
		$cart->whereIn('cart_product_id', [$product_id])
			 ->set(['cart_qty' => $qty])
			 ->update();

		// Initialize the product
		$product = new ProductsModel();
		$product->update($product_id, [
			'product_stock' => ($product->find($product_id))['product_stock'] + 1
		]);

		return redirect()->back()->with('message', 'Sukses Mengurangi Produk');
	}

	public function cancel()
	{
		// Get the product_id
		$product_id = $this->request->getPost('product_id');

		// Initialize the model
		$cart = new CartsModel();

		// Initialize the QTY
		$qty = ($cart->where('cart_product_id', $product_id)->first())['cart_qty'];

		// Initialize the product
		$product = new ProductsModel();
		$product->update($product_id, [
			'product_stock' => ($product->find($product_id))['product_stock'] + $qty
		]);

		// Delete the data from cart
		$cart->where('cart_product_id', $product_id)->delete();

		return redirect()->back()->with('message', 'Sukses Membatalkan Produk');
	}
}
