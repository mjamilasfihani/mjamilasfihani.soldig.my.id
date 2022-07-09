<?php

namespace App\Controllers;

use App\Models\ProductsModel;

class Products extends BaseController
{
	/**
	 * Adding new product
	 */
	public function new()
	{
		// Initialize the Value
		$name  = $this->request->getPost('product_name');
		$price = $this->request->getPost('product_price');
		$stock = $this->request->getPost('product_stock');

		// Generate the Product Code
		// We also use code as the new name for Product Image
		$code  = $this->_setProductCode($name);

		// Initiallze the Image
		$image = $this->request->getFile('product_image');

		return $code;
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
		$total = $model->getFieldCount();

		// Set to UPPER case (for standarization)
		return strtoupper($code) . ($total + 001);
	}
}
