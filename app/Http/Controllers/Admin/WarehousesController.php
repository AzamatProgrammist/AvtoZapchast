<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Shop;
use App\Models\User;
use Str;
use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use Illuminate\Support\Facades\Auth;

class WarehousesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create ombor', ['only' => ['create', 'store']]);
        $this->middleware('permission:create ombor', ['only' => ['edit', 'update']]);
        $this->middleware('permission:create ombor', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usertype = User::findOrFail(Auth::id())->usertype;
        if($usertype == 1 || $usertype == 2)
        {
            $warehouses = Warehouse::paginate(2);
            $shops = Shop::all();
        }elseif ($usertype == 0) {
            $warehouses = Warehouse::where('admin_id', Auth::id())->get();
            $shops = Shop::where('user_id', Auth::id())->get();            
        }
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
    public function store(StoreWarehouseRequest $request)
    {
        $request->validated();
        $requestDsta=$request->all();
        $admin_id = Shop::findOrFail($request->shop_id)->user_id;
        $requestDsta['slug']=Str::slug($requestDsta['name']);
        $requestDsta['admin_id'] = $admin_id;
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
        $warehouse = Warehouse::findOrFail($id);
        return view('admin.warehouses.show', compact('warehouse'));
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
    public function update(UpdateWarehouseRequest $request, $id)
    {
        $request->validated();
        $warehouse = Warehouse::findOrFail($id);
        $requestData = $request->all();
        $requestData = [
            'name' => $request->name,
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
