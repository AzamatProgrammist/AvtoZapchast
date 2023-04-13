<?php 

namespace App\Repositories;
use App\Models\Inkassa;
use App\Models\InkassaSub;
use App\Repositories\Interfaces\InkassaRepositoryInterface;

class InkassaRepository implements InkassaRepositoryInterface
{
	public function getInkassasAll()
	{
		return Inkassa::all();
	}
	public function getInkassa($id)
	{
		return InkassaSub::findOrFail($id);
	}
}



 ?>