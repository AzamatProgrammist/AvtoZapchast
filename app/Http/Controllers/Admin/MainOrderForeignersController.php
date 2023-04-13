<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainOrderForeigner;
use App\Http\Requests\StoreMainOrderForeignerRequest;
use App\Http\Requests\UpdateMainOrderForeignerRequest;
use App\Models\User;
use App\Models\Shop;
use App\Models\Orders_to_foreigner;
use Illuminate\Support\Facades\Auth;

class MainOrderForeignersController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:order Dubai', ['only' => ['update', 'edit']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMainOrderForeignerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMainOrderForeignerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainOrderForeigner  $mainOrderForeigner
     * @return \Illuminate\Http\Response
     */
    public function show(MainOrderForeigner $mainOrderForeigner)
    {
        $main_order = $mainOrderForeigner;
        $shop = Shop::findOrFail($main_order->shop_id);
        $admin = User::findOrFail(Auth::id());
        return view('admin.Orders_to_foreigners.show', compact('main_order', 'admin', 'shop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MainOrderForeigner  $mainOrderForeigner
     * @return \Illuminate\Http\Response
     */
    public function edit(MainOrderForeigner $mainOrderForeigner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMainOrderForeignerRequest  $request
     * @param  \App\Models\MainOrderForeigner  $mainOrderForeigner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMainOrderForeignerRequest $request, MainOrderForeigner $mainOrderForeigner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MainOrderForeigner  $mainOrderForeigner
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainOrderForeigner $mainOrderForeigner)
    {
        //
    }
}
