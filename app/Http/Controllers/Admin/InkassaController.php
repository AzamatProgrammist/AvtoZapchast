<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInkassaRequest;
use App\Http\Requests\UpdateInkassaRequest;
use App\Models\Inkassa;
use App\Services\InkassaService;
use App\Services\ShopService;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class InkassaController extends Controller
{
    public $inkassaService;
    public $shopService;
    public $productRepository;

    public function __construct(InkassaService $inkassaService, ShopService $shopService, ProductRepositoryInterface $productRepository)
    {
        $this->inkassaService = $inkassaService;
        $this->shopService = $shopService;
        $this->productRepository = $productRepository;
        $this->middleware('permission:crud inkassa', ['only' => 'update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inkassas = $this->inkassaService->getAlls();
        $shop_name = $this->inkassaService->getShop_name();
        return view('admin.inkassa.index', compact('inkassas', 'shop_name'));

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
     * @param  \App\Http\Requests\StoreInkassaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInkassaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inkassa  $inkassa
     * @return \Illuminate\Http\Response
     */
    public function show(Inkassa $inkassa)
    {
        $shopShow = $this->shopService->getShop($inkassa->shop_id);
        $shop_name = $this->inkassaService->getShop_name();
        return view('admin.inkassa.show', compact('inkassa', 'shopShow', 'shop_name'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inkassa  $inkassa
     * @return \Illuminate\Http\Response
     */
    public function edit(Inkassa $inkassa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInkassaRequest  $request
     * @param  \App\Models\Inkassa  $inkassa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInkassaRequest $request, Inkassa $inkassa)
    {
        if ($request->soni < $request->quantity) {
            return redirect()->route('admin.inkassa.index')->with('success', 'sizda '."$request->quantity".' tadan kam mahsulot qolgan');
        }
        $product = $this->productRepository->getProduct($request->product_id);
        $inkassaSub = $this->inkassaService->getInkasse($request->id);
        $inkassa = $this->inkassaService->getInkassaUpdate($product, $inkassaSub, $request, $inkassa);

        if ($inkassa['products_num'] > 0) {
            return back()->with('success', 'bajarildi');
        }else{
            return redirect()->route('admin.inkassa.index')->with('success', 'Buyurtmangiz tolandi');
        }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inkassa  $inkassa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inkassa $inkassa)
    {
        //
    }
}
