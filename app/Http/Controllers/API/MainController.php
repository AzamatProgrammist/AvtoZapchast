<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InkassaSub;
use App\Models\Order;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function inkassa_search(Request $request)
    {
        $search = $request->search;
        $user_id = Auth::user()->id;
        $id = Shop::where('user_id', $user_id)->first()->id;

        $results = InkassaSub::
            where('shop_id', $id)
            ->where('name', 'like', '%'.$search.'%')
            ->select('name', 'Org_Dub', 'model', 'brendi', 'soni', 'sotish_narxi', 'full_price')
            ->get();
        $inkassas = $results->groupBy('shop_id')
            ->map(function ($item) {
                return [
                    'barcode' => $item->first()->barcode,
                    'name' => $item->first()->name,
                    'Org_Dub' => $item->first()->Org_Dub,
                    'model' => $item->first()->model,
                    'brendi' => $item->first()->brendi,
                    'soni' => $item->sum('soni'),
                    'sotish_narxi' => $item->first()->sotish_narxi,
                    'full_price' => $item->sum('full_price')
                ];
            });
        return response()->json(['inkassas' => $inkassas->values()], 200);

    }

    public function statistics(Request $request)
    {
        $user_id = Auth::user()->id;
        $id = Shop::where('user_id', $user_id)->first()->id;
        
        $result = Order::
            where('shop_id', $id)
            ->select('name', 'Org_Dub', 'model', 'brendi', 'soni', 'sotish_narxi', 'full_price')
            ->get();
        $orders = $result->groupBy('shop_id')
            ->map(function ($item) {
                return [
                    'all_price' => $item->sum('full_price')
                ];
            });
        $results = InkassaSub::
            where('shop_id', $id)
            ->select('name', 'Org_Dub', 'model', 'brendi', 'soni', 'sotish_narxi', 'full_price')
            ->get();
        $inkassas = $results->groupBy('shop_id')
            ->map(function ($item) {
                return [
                    'price' => $item->sum('full_price')
                ];
            });
        return response()->json(['inkassas' => $inkassas->values(), 'orders' => $orders->values()], 200);
    }

    public function groupByInkassa(Request $request)
    {
        $user_id = Auth::user()->id;
        $id = Shop::where('user_id', $user_id)->first()->id;
        
        $results = InkassaSub::
            where('shop_id', $id)
            ->select('barcode', 'name', 'Org_Dub', 'model', 'brendi', 'soni', 'sotish_narxi', 'full_price')
            ->get();
        $inkassas = $results->groupBy('barcode')
            ->map(function ($item) {
                return [
                    'barcode' => $item->first()->barcode,
                    'name' => $item->first()->name,
                    'Org_Dub' => $item->first()->Org_Dub,
                    'model' => $item->first()->model,
                    'brendi' => $item->first()->brendi,
                    'soni' => $item->sum('soni'),
                    'sotish_narxi' => $item->first()->sotish_narxi,
                    'full_price' => $item->sum('full_price')
                ];
            });
        return response()->json(['orders' => $inkassas->values()], 200);
    }
}

