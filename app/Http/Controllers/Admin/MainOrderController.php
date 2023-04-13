<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainOrder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\MainOrderService;
use App\Services\ShopService;

class MainOrderController extends Controller
{
    public $mainOrderService;
    public $shopService;

    public function __construct(MainOrderService $mainOrderService, ShopService $shopService)
    {
        $this->mainOrderService = $mainOrderService;
        $this->shopService = $shopService;
        $this->middleware('permission:order shop', ['only' => 'update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $main_orders = $this->mainOrderService->paginate();
        return view('admin.main_orders.index', compact('main_orders'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $main_order = $this->mainOrderService->getMainOrder($id);
        $shop = $this->shopService->getShop($main_order->shop_id);
        $admin = User::findOrFail(Auth::id());
        return view('admin.main_orders.show', compact('main_order', 'admin', 'shop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $this->mainOrderService->update($request, $id);
        return redirect()->route('admin.main_orders.index')->with('success', 'Yangilandi!');       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
