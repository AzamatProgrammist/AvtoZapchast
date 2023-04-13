<?php 

namespace App\Repositories\Interfaces;

interface MainOrderRepositoryInterface
{
	public function getMainOrder($id);
	public function paginated();
}


 ?>