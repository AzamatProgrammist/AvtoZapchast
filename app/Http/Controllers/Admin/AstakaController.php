<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Astatka;
use App\Models\Barcode;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;

class AstakaController extends Controller
{
    public function index()
    {
        $shops = Shop::all();
        $astatkas = Astatka::all();
        $arr = [];
        foreach ($astatkas as $astatka) {
            if (!in_array($astatka->shop_id, $arr)) {
                $arr[] = $astatka->shop_id;
            }
        }

        $results = [];
        foreach ($arr as $item) {
            $bar = 0;
            $var = 0;
            $row = null;
            foreach ($astatkas as $astatka) {
                if ($item == $astatka->shop_id) {
                    $bar += $astatka->soni;
                    $var += $astatka->full_price;
                    $row = $astatka;
                }
            }
            $row->soni = $bar;
            $row->full_price = $var;
            $results[] = $row;
        }

        $astatkas = $results;

        return view('admin.astatka.index', compact('astatkas', 'shops'));
    }

    public function show(Request $request, $id)
    {
        $confirm = Astatka::where('shop_id', $id)
            ->groupBy('shop_id')
            ->selectRaw('shop_id, SUM(full_price) as total_price')
            ->first();
        $shop = Shop::findOrFail($id);
        $astatkas = Astatka::where('shop_id', $id)->get();
        return view('admin.astatka.show', compact('astatkas', 'confirm', 'shop'));
    }

    public function astatka_delete($id)
    {
        $barcodes = Barcode::where('shop_id', $id)->delete();
        $astatka = Astatka::where('shop_id', $id)->delete();
        return redirect()->route('admin.astatka.index')->with('success', 'Astatka deleted successfully');
    }
}
