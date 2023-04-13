<?php 

namespace App\Services;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Carts_to_foreigners;

/**
 * 
 */
class CartService

{
	
	public function store($request)
	{
        $product = Product::find($request->product_id);
		 if ($product->soni<$request->quantity) {
            
            return redirect()->route('admin.carts.create')->with('success', 'Bazada buncha tavar yo\'q');
        }
        $count = Carts_to_foreigners::count();
        if ($count > 0) {
            
            return redirect()->route('admin.carts.create')->with('success', 'Oldin chetga buyurtmani bajaring yoki bekor qiling');
            
        }
        $cart = new Cart;
        $cart->name = $product->name;
        $cart->price = $product->sotish_narxi;
        $cart->image_name = $product->image;
        $cart->shop_id = $product->shop_id;
        $cart->model = $product->model;
        $cart->Org_Dub = $product->Org_Dub;
        $cart->quantity = $request->quantity;
        $cart->product_id = $request->product_id;
        $cart->save();
	}

	public function update($request, $cart)
	{
		$quantity = $request['quantity']['0'];
        
        $product = Product::findOrFail($cart->product_id);
        if ($product->soni < $quantity) {
            
            return redirect()->route('admin.carts.index')->with('danger', 'Bazada buncha tavar yo\'q');
            
        }
        $cart['quantity'] = $quantity;
        
        $cart->update();
	}
}








 ?>