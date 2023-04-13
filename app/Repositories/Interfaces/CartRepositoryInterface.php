<?php 

namespace App\Repositories\Interfaces;

interface CartRepositoryInterface{
	
	public function getAll();
	public function delete($cart);

}



 ?>