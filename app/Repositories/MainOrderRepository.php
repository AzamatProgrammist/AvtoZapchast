<?php 

namespace App\Repositories;

use App\Models\MainOrder;
use App\Repositories\Interfaces\MainOrderRepositoryInterface;

class MainOrderRepository implements MainOrderRepositoryInterface
{
	
	public function paginated()
	{
		return MainOrder::paginate(100);
	}
	public function getMainOrder($id)
	{
		return MainOrder::findOrFail($id);
	}







}

 ?>