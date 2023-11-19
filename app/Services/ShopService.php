<?php 


namespace App\Services;

use App\Repositories\Interfaces\ShopRepositoryInterface;

class ShopService
{
	public $shopRepository;
	public function __construct(ShopRepositoryInterface $shopRepository)
	{
		$this->shopRepository = $shopRepository;
	}

	public function getAll()
	{
		return $this->shopRepository->getAll();
	}
	public function getShop($id)
	{
		return $this->shopRepository->getShop($id);
	}

	public function getMainShops()
	{
		return $this->shopRepository->getMainShops();
	}
}


 ?>