<?php 

namespace App\Repositories;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
class ProductRepository implements ProductRepositoryInterface
{
	public function getAllProduct()
	{
		return Product::paginate(50);
	}

	public function getProduct($id)
	{
		return Product::findOrFail($id);
	}

	public function save($requestData)
	{
		return Product::create($requestData);
	}

	public function update($requestData, $id)
	{
		$product = Product::findOrFail($id);
		return $product->update($requestData);
	}

	public function deleteProduct($id)
	{
		$product = Product::findOrFail($id);
		return $product->delete();
	}
}



 ?>