<?php 

namespace App\Repositories;

use App\Repositories\Interfaces\ShopRepositoryInterface;
use App\Models\Shop;

class ShopRepository implements ShopRepositoryInterface
{
	public function getAll()
	{
	    return $shops = Shop::all();
	}

	public function getShop($id)
	{
	    return Shop::findOrFail($id);
	}

	public function getUser_id($id)
	{
		return Shop::findOrFail($id)->user_id;
	}

	public function getMainShops()
	{
		return Shop::where('usertype', 1)->get();
	}

}



 ?>