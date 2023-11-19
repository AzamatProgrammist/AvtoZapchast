<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Cart;
use App\Models\MainOrder;
use App\Models\Inkassa;
use App\Models\InkassaSub;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:order shop', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::paginate(100);
        return view('admin.orders.index', compact('orders'));
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
        $array = $request['id'];
        $full_price = $request->full_price;
        $status = $request->status;
        $shop = Shop::findOrFail($request['shop_id']);
        $user_id = $shop->user_id;
        $admin = $shop->user->name;
        
        $array2 = $request['product_id'];
        $year = MainOrder::whereYear('created_at', date('Y'))->count();
        $numeric = $year + 1;
        $count = count($array);

        $mainOrder = [
            'shop_name' => $shop->name_uz,
            'admin' => $admin,
            'products_num' => $count,
            'full_price' => $full_price,
            'status' => $status,
            'shop_id' => $request['shop_id'],
            'numeric' => $numeric,
            'date' => date('Y'),
        ];
        $MainOrder = new MainOrder($mainOrder);
        $MainOrder->save();
        $mainOrder = [
            'shop_name' => $shop->name_uz,
            'admin' => $admin,
            'products_num' => $count,
            'full_price' => $full_price,
            'status' => $status,
            'shop_id' => $request['shop_id'],
            'numeric' => $numeric,
            'warehouse_id' => $request->warehouse_id,
            'date' => date('Y'),
            'mainOrder_id' => $MainOrder->id,
            'user_id' => $user_id
        ];
        $inkassa = new Inkassa($mainOrder);
        $inkassa->save();
        for ($i=0; $i < $count ; $i++) { 

            $cart = Cart::findOrFail($request['id'][$i]);
            $product = Product::findOrFail($request['product_id'][$i]);
            $order = [
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
                'main_id' => $MainOrder->id,
                'product_id' => $product->id,
            ];
            $Order = new Order($order);
            $inkassaSub = new InkassaSub($order);
            $inkassaSub['main_id'] = $inkassa->id;
            $Order->save();
            $inkassaSub->save();
            /* $product['soni'] = $product->soni - $cart->quantity;
            $product->update(); */
            $cart->delete();

        }
        return redirect()->route('admin.main_orders.index')->with('success', 'Buyurtma berildi!');       
       
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Buyurtma o\'chirildi!');       

    }


}

