<?php 

namespace App\Repositories;

use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Models\Cart;
/**
 * 
 */
class CartRepository implements CartRepositoryInterface
{
	
	public function getAll()
	{
		$carts = Cart::all();
        return $carts;
	}
	public function delete($cart)
	{
		return $cart->delete();
	}
}





 ?>