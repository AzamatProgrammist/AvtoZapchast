<?php 

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
	public function getAllProduct();
	public function getProduct($id);
	public function save($requestData);
	public function update($requestData, $id);
	public function deleteProduct($id);
}




 ?>