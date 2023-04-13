<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Services\ProductService;
use App\Services\ShopService;

class ProductsController extends Controller
{
    public $productService;
    public $shopService;
    public function __construct(ProductService $productService, ShopService $shopService)
    {
        $this->productService = $productService;
        $this->shopService = $shopService;
        $this->middleware('permission:create product', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit product', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete product', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productService->getAll();
        $sorts = $this->productService->sorts();
        $shops = $this->shopService->getAll();
        return view('admin.products.index', compact('products', 'shops', 'sorts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shops = $this->shopService->getMainShops();
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
        $this->productService->store($request);
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $orders = Order::where('product_id', $product->id)->get();
        $product_count = $this->productService->product_count($orders);
        $shops = $this->shopService->getAll();
        return view('admin.products.show', compact('product', 'orders', 'shops', 'product_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
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
        $this->productService->update($request, $id);
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productService->destroy($id);
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');

    }
}

