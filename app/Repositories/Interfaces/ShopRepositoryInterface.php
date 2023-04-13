<?php 

namespace App\Repositories\Interfaces;

interface ShopRepositoryInterface
{
	public function getAll();
	public function getShop($id);
	public function getUser_id($id);
	public function getMainShops();
}




 ?>