<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inkassa;
use App\Models\Product;
use App\Models\MainOrder;
use App\Models\Shop;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $productsCount = DB::table('products')->sum('products.soni');
        $inkassasCount = DB::table('inkassas')->sum('inkassas.products_num');
        $bazaCount = $productsCount - $inkassasCount;
        $shopCount = Shop::count();
        $totalIcome = MainOrder::where('status', '1')->sum('full_price');
        $totalCount = Product::sum('full_price');

        $date = Carbon::now()->subDays(30);
        $date2 = Carbon::now()->subDays(90);
        $date3 = Carbon::now()->subDays(120);
        
        $date4Week = Carbon::now()->subDays(7);
        $date5Year = Carbon::now()->subDays(365);

        $countOneMonth = MainOrder::where('status', '1')->where('updated_at', '>=', $date)->sum('products_num');
        $countTreeMonth = MainOrder::where('status', '1')->where('updated_at', '>=', $date2)->sum('products_num');
        $countSixMonths = MainOrder::where('status', '1')->where('updated_at', '>=', $date3)->sum('products_num');

        $oneMonth = MainOrder::where('status', '1')->where('updated_at', '>=', $date)->sum('full_price');
        $threeMonths = MainOrder::where('status', '1')->where('updated_at', '>=', $date2)->sum('full_price');
        $sixMonths = MainOrder::where('status', '1')->where('updated_at', '>=', $date3)->sum('full_price');
        $oneWeek = MainOrder::where('status', '1')->where('updated_at', '>=', $date4Week)->get();
        $oneMonthPureProfit = MainOrder::where('status', '1')->where('updated_at', '>=', $date)->get();
        $oneYearPureProfit = MainOrder::where('status', '1')->where('updated_at', '>=', $date5Year)->get();
        
        $weekOrderFullPrice = 0;
        $weekfullprice = 0;
        $monthOrderFullPrice = 0;
        $monthFullPrice = 0;
        $yearOrderFullPrice = 0;
        $yearFullPrice = 0;

        foreach ($oneWeek as $week) 
            {
                foreach($week->orders as $order)
                {
                    $weekOrderFullPrice = $weekOrderFullPrice + ($order->olingan_narxi*$order->soni) + ($order->weight*$order->yuk_narxi*$order->soni);
                }
                $weekfullprice = $weekfullprice + $week->full_price;
            }
        $weekPureProfit = $weekfullprice - $weekOrderFullPrice;

        foreach ($oneMonthPureProfit as $month) 
            {
                foreach($month->orders as $order)
                {
                    $monthOrderFullPrice = $monthOrderFullPrice + ($order->olingan_narxi*$order->soni) + ($order->weight*$order->yuk_narxi*$order->soni);
                }
                $monthFullPrice = $monthFullPrice + $month->full_price;
            }
        $monthPureProfit = $monthFullPrice - $monthOrderFullPrice;

        foreach ($oneYearPureProfit as $year) 
            {
                foreach($year->orders as $order)
                {
                    $yearOrderFullPrice = $yearOrderFullPrice + ($order->olingan_narxi*$order->soni) + ($order->weight*$order->yuk_narxi*$order->soni);
                }
                $yearFullPrice = $yearFullPrice + $year->full_price;
            }
        $yearPureProfit = $yearFullPrice - $yearOrderFullPrice;


        return view('admin.dashboard', [
            'productsCount' => $productsCount,
            'inkassasCount' => $inkassasCount,
            'bazaCount' => $bazaCount,
            'totalIcome' => $totalIcome,
            'totalCount' => $totalCount,
            'countOneMonth' => $countOneMonth,
            'countTreeMonth' => $countTreeMonth,
            'countSixMonths' => $countSixMonths,
            'oneMonth' => $oneMonth,
            'threeMonths' => $threeMonths,
            'sixMonths' => $sixMonths,
            'shopCount' => $shopCount,
            'weekPureProfit' => $weekPureProfit,
            'monthPureProfit' => $monthPureProfit,
            'yearPureProfit' => $yearPureProfit,
        ]);

    }
}


