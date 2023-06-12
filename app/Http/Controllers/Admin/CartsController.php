<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Services\CartService;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\ShopRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class CartsController extends Controller
{
    public $cartService;
    public $cartRepository;
    public $shopRepository;
    public $productRepository;
    public function __construct(CartService $cartService, CartRepositoryInterface $cartRepository, ShopRepositoryInterface $shopRepository, ProductRepositoryInterface $productRepository)
    {
        $this->cartService = $cartService;
        $this->cartRepository = $cartRepository;
        $this->shopRepository = $shopRepository;
        $this->productRepository = $productRepository;
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
        $carts = $this->cartRepository->getAll();
        $shops = $this->shopRepository->getAll();
        return view('admin.carts.index', compact('carts', 'shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = $this->productRepository->getAllProduct();
        return view('admin.carts.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->cartService->store($request);
        return redirect()->route('admin.carts.create')->with('success', 'Buyurtma yangilandi');

    }

    public function insert(Request $request)
    {
        return redirect()->route('admin.carts.create')->with('success', 'Buyurtma yangilandi');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
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
    public function update(Request $request, Cart $cart)
    {
        $this->cartService->update($request, $cart);
        return redirect()->route('admin.carts.index')->with('success', 'Buyurtma yangilandi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $this->cartRepository->delete($cart);
        return redirect()->route('admin.carts.index')->with('success', "Buyurtma bekor qilindi");
    }
}
