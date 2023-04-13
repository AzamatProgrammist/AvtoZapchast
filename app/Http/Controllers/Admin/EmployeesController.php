<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Services\EmployeeService;
use App\Repositories\Interfaces\WarehouseRepositoryInterface;

class EmployeesController extends Controller
{
    public $employeeService;
    public $warehouseRepository;
    public function __construct(EmployeeService $employeeService, WarehouseRepositoryInterface $warehouseRepository)
    {
        $this->employeeService = $employeeService;
        $this->warehouseRepository = $warehouseRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $employees = Employee::where('shopid', $id)->get();
        return view('admin.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idi = Auth::id();
        $warehouses = $this->warehouseRepository->getWarehousesWithAuth($idi);
        return view('admin.employees.create', compact('warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $request->validated();
        $this->employeeService->store($request);
        return redirect()->route('admin.employees.index')->with('success', 'employee created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $idi = Auth::id();
        $warehouses = $this->warehouseRepository->getWarehousesWithAuth($idi);
        return view('admin.employees.edit', compact('employee', 'warehouses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        $request->validated();
        $this->employeeService->update($request, $id);
        return redirect()->route('admin.employees.index')->with('success', 'Employee updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('admin.employees.index')->with('success', 'Employee deleted Successfully');
    }
}
