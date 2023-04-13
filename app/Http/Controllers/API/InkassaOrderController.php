<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Inkassa;
use App\Http\Requests\StoreInkassaRequest;
use App\Http\Requests\UpdateInkassaRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\InkassaOrderResource;

class InkassaOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $orders = Inkassa::where('user_id', $id)->get();
        return InkassaOrderResource::collection($orders);
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
        //
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
