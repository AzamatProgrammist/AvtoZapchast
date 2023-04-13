<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\User;
use Str;
use DB;
use App\Models\Warehouse;
use App\Models\MainOrder;
use App\Models\Inkassa;
use Illuminate\Support\Facades\Auth;
use App\Services\InkassaService;


class ShopsController extends Controller
{
    public $inkassaService;
    public function __construct(InkassaService $inkassaService)
    {
        $this->inkassaService = $inkassaService;
        $this->middleware('permission:create shop', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit shop', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete shop', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usertype = User::findOrFail(Auth::id())->usertype;
        if($usertype == 1 || $usertype == 2)
        {
            $shops = Shop::paginate(100);
        }elseif ($usertype == 0) {
            $shops = Shop::where('user_id', Auth::id())->get();
        }
        return view('admin.shops.index', ['shops'=>$shops]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.shops.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShopRequest $request)
    {
        $request->validated();
        $id = (int) $request->user_id;
        $admin = User::findOrFail($id);
        $requestDsta=$request->all();
        $requestDsta['slug']=Str::slug($requestDsta['name_uz']);
        $requestDsta['admin'] = $admin->name;
        $requestDsta['user_id'] = $id;
        $requestDsta['usertype'] = $admin->usertype;

        $shop = Shop::create($requestDsta);

        $requestOmbor['name']=$request->omborName;
        $requestOmbor['shop_id']=$shop->id;
        $requestOmbor['slug']=Str::slug($request->omborName);
        $requestOmbor['admin_id'] = $id;
        Warehouse::create($requestOmbor);

        return redirect()->route('admin.shops.index')->with('success', 'Shop created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shop = Shop::findOrFail($id);
        return view('admin.shops.show', compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shop = Shop::findOrFail($id);
        $users = User::all();
        return view('admin.shops.edit', compact('shop', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShopRequest $request, $id)
    {
        $request->validated();
        $shop = Shop::findOrFail($id);
        $requestData = $request->all();
        $requestData['name_uz'] = $request->name_uz;
        $requestData['meta_title'] = $request->meta_title;
        $requestData['meta_description'] = $request->meta_description;
        $requestData['meta_keyword'] = $request->meta_keyword;
        $requestData['user_id'] = $request->user_id;

        $requestData['admin'] = User::findOrFail($request->user_id)->name;
        
        $requestData['slug']=Str::slug($request->name_uz);
        
        $shop->update($requestData);
        return redirect()->route('admin.shops.index')->with('success', 'Post updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Shop::find($id);
        $warehouses = Warehouse::where('shop_id', $id)->get()->count();
        
        if ($warehouses ==! 0) {
        return redirect()->route('admin.shops.index')->with('success', 'Avval omborlarini delete qiling');
            
        }
        $shop->delete();
        return redirect()->route('admin.shops.index')->with('success', 'Shop deleted successfully');
    }

    public function status($id)
    {
        $shop_name = Shop::findOrFail($id)->name_uz;
        $orders = MainOrder::where('shop_id', $id)->get();
        $inkassas = Inkassa::where('shop_id', $id)->get();
        if ($inkassas->count() <= 0) {
            return redirect()->route('admin.shops.index')->with('success', "$shop_name ning qarzi yoq");
        }
        return view('admin.shops.status', compact('orders', 'inkassas'));

    }

    public function inkassa($id)
    {
        $inkassas = Inkassa::all();
        $shop_name = $this->inkassaService->getShop_name();

        $shopShow = Shop::findOrFail($id);
        return view('admin.inkassa.show', compact('shopShow', 'shop_name'));
    }
}
