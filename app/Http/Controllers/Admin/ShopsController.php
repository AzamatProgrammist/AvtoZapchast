<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\User;
use Str;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::paginate(100);
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
    public function store(Request $request)
    {
        $request->validate([
            'name_uz' => 'required',
            'user_id' => 'required',
        ]);
        $admin = User::find($request->user_id)->name;
        
        $requestDsta=$request->all();
        $requestDsta['slug']=Str::slug($requestDsta['name_uz']);
        $requestDsta['admin'] = $admin;
        Shop::create($requestDsta);
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
    public function update(Request $request, $id)
    {
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
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect()->route('admin.shops.index')->with('success', 'Category deleted successfully');
    }
}
