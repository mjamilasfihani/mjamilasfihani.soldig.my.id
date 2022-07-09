<?php

namespace App\Controllers;

use App\Models\ProductsModel;

class Products extends BaseController
{
	/**
	 * Adding new product
	 */
	public function create()
	{
		// Initialize the rules
		$validationRules = [
			'product_image' => [
				'label' => 'Gambar Produk',
				'rules' => 'uploaded[product_image]'
					. '|is_image[product_image]'
					. '|mime_in[product_image,image/jpg,image/jpeg,image/png]'
			]
		];

		if (! $this->validate($validationRules))
		{
			// Redirect back with errors notification
			return redirect()->back()->with('errors', $this->validator->getErrors());
		}

		// Initialize the Value
		$name  = $this->request->getPost('product_name');
		$price = $this->request->getPost('product_price');
		$stock = $this->request->getPost('product_stock');

		// Generate the Product Code
		// We also use code as the new name for Product Image
		$code  = $this->_setProductCode($name);

		// Initialize the Image
		$image = $this->request->getFile('product_image');
		$ext   = $image->guessExtension();

		// New Image Name
		$newImage = $code . '.' . $ext;

		// Saving the Image than store any datas into Database
		$image->move(WRITEPATH . 'uploads', $newImage);
		(new ProductsModel)->insert([
			'product_name'  => $name,
			'product_price' => $price,
			'product_stock' => $stock,
			'product_code'  => $code = $newImage,
		]);

		return redirect()->back()->with('message', 'Produk berhasil ditambahkan');
	}

	/**
	 * Generate the Product code
	 */
	private function _setProductCode(string $name)
	{
		// Check the image's name first
		// it has space or not
		if (str_contains($name, ' '))
		{
			// Take only the first character of 2 Words
			// of Product's name
			$temp_code = explode(' ', $name);
			$code      = $temp_code[0][0] . $temp_code[1][0];
		}
		else
		{
			// Take only 2 char of Product Name
			$code = substr($name, 2);
		}

		// Initialalize the Model
		$model = new ProductsModel();
		$total = (count($model->findAll()) + 1);

		// Set to UPPER case (for standarization)
		return strtoupper($code) . str_pad($total, 3, "0", STR_PAD_LEFT);
	}
}
