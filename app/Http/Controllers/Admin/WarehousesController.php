<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Shop;
use Str;

class WarehousesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = Warehouse::paginate(100);
        $shops = Shop::all();
        return view('admin.warehouses.index', compact('warehouses', 'shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shops = Shop::all();
        return view('admin.warehouses.create', compact('shops'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'shop_id' => 'required',
        ]);
        $requestDsta=$request->all();
        $requestDsta['slug']=Str::slug($requestDsta['name']);
        Warehouse::create($requestDsta);
        return redirect()->route('admin.warehouses.index')->with('success', 'Shop created successfully');
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
    public function edit($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $shops = Shop::all();
        return view('admin.warehouses.edit', compact('warehouse', 'shops'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $requestData = $request->all();
        $requestData = [
            'name' => $request->name,
            'shop_id' => $request->shop_id,
        ];
        $requestData['slug']=Str::slug($request->name);

        $warehouse->update($requestData);
        return redirect()->route('admin.warehouses.index')->with('success', 'Warehouse updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
        return redirect()->route('admin.warehouses.index')->with('success', 'Warehouse deleted successfully');
    }
}
