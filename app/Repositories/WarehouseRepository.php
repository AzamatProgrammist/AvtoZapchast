<?php 

namespace App\Repositories;

use App\Models\Warehouse;
use App\Repositories\Interfaces\WarehouseRepositoryInterface;

class WarehouseRepository implements WarehouseRepositoryInterface
{
	public function getWarehousesWithAuth($idi)
	{
        return $warehouses = Warehouse::where('admin_id', $idi)->get();
	}
}

 ?>