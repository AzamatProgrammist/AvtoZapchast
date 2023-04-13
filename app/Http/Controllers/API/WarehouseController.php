<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\WarehouceResource;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $warehouses = Warehouse::where('admin_id', $id)->get();
        foreach ($warehouses as $warehouse) {
            $full_price = 0;
            $products_num = 0;
            foreach($warehouse->inkassas as $inkassa)
            {
                $full_price = $full_price + $inkassa->full_price;
                $admin = $inkassa->admin;
                $products_num = $products_num + $inkassa->products_num;
            }
            $warehouse['full_price'] = $full_price;
            $warehouse['admin'] = $admin;
            $warehouse['products_num'] = $products_num;
        }
        return WarehouceResource::collection($warehouses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWarehouseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWarehouseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWarehouseRequest  $request
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWarehouseRequest $request, Warehouse $warehouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        //
    }
}
