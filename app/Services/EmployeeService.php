<?php 

namespace App\Services;

use App\Models\Employee;
use App\Models\Warehouse;

/**
 * 
 */
class EmployeeService

{
	
	public function store($request)
	{
		$requestData = $request->all();
		$warehouse = Warehouse::findOrFail($request->shopid);
		$requestData['shopid'] = $warehouse->admin_id;
		$requestData['warehouse_id'] = $request->shopid;
		$requestData['warehouse_name'] = $warehouse->name;
		$employee = Employee::create($requestData);
	}

	public function update($request, $id)
	{
		$employee = Employee::findOrFail($id);
		$warehouse = Warehouse::findOrFail($request->shopid);
		$requestData = $request->all();
		$requestData['shopid'] = $employee->shopid;
		$requestData['warehouse_id'] = $warehouse->id;
		$requestData['warehouse_name'] = $warehouse->name;
		$employee->update($requestData);
	}

}



 ?>