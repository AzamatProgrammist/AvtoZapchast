<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Type;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $products = Product::paginate(100);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::id();
        $shops = Shop::where('user_id', $id)->get();

        return view('admin.products.create', compact('shops'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $full_price = $request->olingan_narxi*$request->soni + $request->yuk_narxi*$request->weight;
        
        if ($request->file('image')) {
            
            $file = $request->file('image');
            $image_name = time().'.'.$file->getClientOriginalName();
            $file->move('site/products/images/', $image_name);
        }
        $user_id = Shop::findOrFail($request->shop_id)->user_id;

        $requestData = [
            'name' => $request->name,
            'Org_Dub' => $request->Org_Dub,
            'part_number' => $request->part_number,
            'image' => $image_name,
            'model' => $request->model,
            'brendi' => $request->brendi,
            'markasi' => $request->markasi,
            'ombor_id' => $request->ombor_id,
            'shop_id' => $request->shop_id,
            'user_id' => $user_id,
        ];

        $product = Product::create($requestData);
        $requestType = [
            'chiqqan_yili' => $request->chiqqan_yili,
            'kelgan_yili' => $request->kelgan_yili,
            'size' => $request->size,
            'full_price' => $full_price,
            'sotish_narxi' => $request->sotish_narxi,
            'olingan_narxi' => $request->olingan_narxi,
            'weight' => $request->weight,
            'yuk_narxi' => $request->yuk_narxi,
            'soni' => $request->soni,
            'product_id' => $product->id,
            'ombor_id' => $request->ombor_id,
            'shop_id' => $request->shop_id,
            'user_id' => $user_id,
        ];

        $type = Type::create($requestType);
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
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
        $product = Product::findOrFail($id);

        $full_price = $request->olingan_narxi*$request->soni + $request->yuk_narxi*$request->weight;
        $old_image = $product->image;
        if ($request->file('image')) {
            
            $file = $request->file('image');
            $image_name = time().'.'.$file->getClientOriginalName();
            $file->move('site/products/images/', $image_name);
            unlink('site/products/images/'.$old_image);
        }
        $user_id = Shop::findOrFail($request->shop_id)->user_id;

        $requestData = [
            'name' => $request->name,
            'Org_Dub' => $request->Org_Dub,
            'part_number' => $request->part_number,
            'image' => $image_name,
            'model' => $request->model,
            'brendi' => $request->brendi,
            'markasi' => $request->markasi,
            'ombor_id' => $request->ombor_id,
            'shop_id' => $request->shop_id,
            'user_id' => $user_id,
        ];

        $product = Product::create($requestData);
        $requestType = [
            'chiqqan_yili' => $request->chiqqan_yili,
            'kelgan_yili' => $request->kelgan_yili,
            'size' => $request->size,
            'full_price' => $full_price,
            'sotish_narxi' => $request->sotish_narxi,
            'olingan_narxi' => $request->olingan_narxi,
            'weight' => $request->weight,
            'yuk_narxi' => $request->yuk_narxi,
            'soni' => $request->soni,
            'product_id' => $product->id,
            'ombor_id' => $request->ombor_id,
            'shop_id' => $request->shop_id,
            'user_id' => $user_id,
        ];

        $type = Type::create($requestType);
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::delete($id);
    }
}
