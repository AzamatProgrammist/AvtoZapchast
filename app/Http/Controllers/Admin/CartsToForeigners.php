<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carts_to_foreigners;
use App\Http\Requests\StoreCarts_to_foreignersRequest;
use App\Http\Requests\UpdateCarts_to_foreignersRequest;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Shop;
use App\Models\MainOrder;
use App\Services\MainOrderService;

class CartsToForeigners extends Controller
{
    public $mainOrderService;

    public function __construct(MainOrderService $mainOrderService)
    {
        $this->mainOrderService = $mainOrderService;
        $this->middleware('permission:create cart', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit cart', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete cart', ['only' => 'delete']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Carts_to_foreigners::all();
        $shops = Shop::all();
        
        return view('admin.cart_foreigners.index', compact('carts', 'shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $status = $this->mainOrderService->status();
        $oneMonths = $status['one'];
        $threeMonths = $status['tree'];
        $sixMonths = $status['six'];
        return view('admin.cart_foreigners.create', compact('products', 'oneMonths', 'threeMonths', 'sixMonths'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarts_to_foreignersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarts_to_foreignersRequest $request)
    {

        $product = Product::find($request->product_id);
        
        $count = Cart::count();
        if ($count > 0) {
            
            return redirect()->route('admin.carts_to_foreigners.create')->with('success', 'mijoz buyurtmasini bajaring yoki bekor qiling');
            
        }
        $cart = new Carts_to_foreigners;
        $cart->name = $product->name;
        $cart->price = $product->sotish_narxi;
        $cart->image_name = $product->image;
        $cart->shop_id = $product->shop_id;
        $cart->model = $product->model;
        $cart->Org_Dub = $product->Org_Dub;
        $cart->quantity = $request->quantity;
        $cart->product_id = $request->product_id;
        

        $cart->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carts_to_foreigners  $carts_to_foreigners
     * @return \Illuminate\Http\Response
     */
    public function show(Carts_to_foreigners $carts_to_foreigners)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carts_to_foreigners  $carts_to_foreigners
     * @return \Illuminate\Http\Response
     */
    public function edit(Carts_to_foreigners $carts_to_foreigners)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarts_to_foreignersRequest  $request
     * @param  \App\Models\Carts_to_foreigners  $carts_to_foreigners
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarts_to_foreignersRequest $request, Carts_to_foreigners $carts_to_foreigners)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carts_to_foreigners  $carts_to_foreigners
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carts_to_foreigners $carts_to_foreigners)
    {
        //
    }
}
