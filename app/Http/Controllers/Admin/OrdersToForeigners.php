<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders_to_foreigner;
use App\Http\Requests\StoreOrders_to_foreignersRequest;
use App\Http\Requests\UpdateOrders_to_foreignersRequest;
use App\Models\Carts_to_foreigners;
use App\Models\Shop;
use App\Models\MainOrderForeigner;
use App\Models\Product;

class OrdersToForeigners extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:order Dubai', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders_to_foreigners = MainOrderForeigner::paginate(100);
        
        return view('admin.orders_to_foreigners.index', compact('orders_to_foreigners'));
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
     * @param  \App\Http\Requests\StoreOrders_to_foreignersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrders_to_foreignersRequest $request)
    {
        $array = $request['id'];
        $full_price = $request->full_price;
        $status = $request->status;
        $shop = Shop::findOrFail($request['shop_id']);
        $user_id = $shop->user_id;
        $admin = $shop->user->name;
        
        $array2 = $request['product_id'];
        $year = MainOrderForeigner::whereYear('created_at', date('Y'))->count();
        $numeric = $year + 1;
        $count = count($array);

        $MainOrderForeigner = new MainOrderForeigner([
            'shop_name' => $shop->name_uz,
            'admin' => $admin,
            'products_num' => $count,
            'full_price' => $full_price,
            'status' => $status,
            'shop_id' => $request['shop_id'],
            'numeric' => $numeric,
            'date' => date('Y'),
        ]);

        $MainOrderForeigner->save();
        for ($i=0; $i < $count ; $i++) { 

            $cart = Carts_to_foreigners::findOrFail($request['id'][$i]);
            $product = Product::findOrFail($request['product_id'][$i]);
            $order = new Orders_to_foreigner([
                'name' => $product->name,
                'Org_Dub' => $product->Org_Dub,
                'part_number' => $product->part_number,
                'image' => $product->image,
                'model' => $product->model,
                'brendi' => $product->brendi,
                'markasi' => $product->markasi,
                'chiqqan_yili' => $product->chiqqan_yili,
                'kelgan_yili' => $product->kelgan_yili,
                'size' => $product->size,
                'full_price' => $cart['quantity'] * $cart['price'],
                'sotish_narxi' => $product->sotish_narxi,
                'olingan_narxi' => $product->olingan_narxi,
                'weight' => $product->weight,
                'yuk_narxi' => $product->yuk_narxi,
                'soni' => $cart['quantity'],
                'ombor_id' => $product->ombor_id,
                'shop_id' => $request->shop_id,
                'user_id' => $user_id,
                'main_id' => $MainOrderForeigner->id,
                'product_id' => $product->id,
            ]);

            $order->save();
            /* $product['soni'] = $product->soni - $cart->quantity;
            $product->update(); */
            $cart->delete();

        }
        return redirect()->route('admin.orders_to_foreigners.index')->with('success', 'Buyurtma berildi!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orders_to_foreigners  $orders_to_foreigners
     * @return \Illuminate\Http\Response
     */
    public function show(Orders_to_foreigners $orders_to_foreigners)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orders_to_foreigners  $orders_to_foreigners
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders_to_foreigners $orders_to_foreigners)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrders_to_foreignersRequest  $request
     * @param  \App\Models\Orders_to_foreigners  $orders_to_foreigners
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrders_to_foreignersRequest $request, Orders_to_foreigners $orders_to_foreigners)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orders_to_foreigners  $orders_to_foreigners
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orders_to_foreigners $orders_to_foreigners)
    {
        //
    }
}
