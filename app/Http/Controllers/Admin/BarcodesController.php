<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barcode;
use App\Models\Shop;
use App\Models\Product;
use App\Models\InkassaSub;
use App\Models\Astatka;
use App\Http\Requests\StoreBarcodeRequest;
use App\Http\Requests\UpdateBarcodeRequest;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\ShopService;
use Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class BarcodesController extends Controller
{
    public $productService;
    public $shopService;
    public function __construct(ProductService $productService, ShopService $shopService)
    {
        $this->productService = $productService;
        $this->shopService = $shopService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::all();
        return view('admin.barcodes.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function select_shop(Request $request)
    {
        $id = $request->id;
        $shop = Shop::findOrFail($id);
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
        return view('admin.astatka.create', compact('shop', 'inkassas'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBarcodeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function barcode(Request $request)
{
    $hiddenData = $request->input('hiddenData');
    $textData = $request->input('textData');
    $user_id = Shop::findOrFail($hiddenData)->user_id;
    $results = InkassaSub::
        where('shop_id', $hiddenData)
        ->where('barcode', $textData)
        ->select('full_price', 'soni')
        ->get();
    $row1 = 0;
    $row2 = 0;
    foreach ($results as $result) {
        $row1 += $result->full_price;
        $row2 += $result->soni;
    }

    $inkassa_sub = InkassaSub::where('shop_id', $hiddenData)
    ->where('barcode', $textData)
    ->first();
    $inkassa_sub->soni = $row2;
    $inkassa_sub->full_price = $row1;

    if ($inkassa_sub) {
        $barcode = Barcode::where('barcode', $textData)->where('shop_id', $hiddenData)->first();
        if ($barcode) {
                if($inkassa_sub->soni > $barcode->count){
                $barcode->count += 1;
                $barcode->name = $inkassa_sub->name;
                $barcode->Org_Dub = $inkassa_sub->Org_Dub;
                $barcode->model = $inkassa_sub->model;
                $barcode->brendi = $inkassa_sub->brendi;
                $barcode->markasi = $inkassa_sub->markasi;
                $barcode->chiqqan_yili = $inkassa_sub->chiqqan_yili;
                $barcode->kelgan_yili = $inkassa_sub->kelgan_yili;
                $barcode->size = $inkassa_sub->size;
                $barcode->sotish_narxi = $inkassa_sub->sotish_narxi;
                $barcode->weight = $inkassa_sub->weight;
                $barcode->update();
                if($barcode->count <= $inkassa_sub->soni){
                $astatka = Astatka::where('shop_id', $hiddenData)->where('barcode', $textData)->first();
                    if ($astatka) {
                        $astatka->name = $inkassa_sub->name;
                         $astatka->soni = $inkassa_sub->soni - $barcode->count;
                         $astatka->update();

                     } else
                     {
                         $astatka = new Astatka([
                        'name' => $inkassa_sub->name, // Assign the value to the 'name' field
                        'Org_Dub' => $inkassa_sub->Org_Dub,
                        'part_number' => $inkassa_sub->part_number,
                        'image' => $inkassa_sub->image,
                        'model' => $inkassa_sub->model,
                        'brendi' => $inkassa_sub->brendi,
                        'markasi' => $inkassa_sub->markasi,
                        'barcode' => $inkassa_sub->barcode,
                        'image_path' => $inkassa_sub->image_path,
                        'chiqqan_yili' => $inkassa_sub->chiqqan_yili,
                        'kelgan_yili' => $inkassa_sub->kelgan_yili,
                        'size' => $inkassa_sub->size,
                        'full_price' => $inkassa_sub->full_price,
                        'sotish_narxi' => $inkassa_sub->sotish_narxi,
                        'olingan_narxi' => $inkassa_sub->olingan_narxi,
                        'weight' => $inkassa_sub->weight,
                        'yuk_narxi' => $inkassa_sub->yuk_narxi,
                        'soni' => $inkassa_sub->soni - $barcode->count,
                        'ombor_id' => $inkassa_sub->ombor_id,
                        'shop_id' => $inkassa_sub->shop_id,
                    ]);
                    $astatka->save();
                     }
                }
                $barcodes = Barcode::where('shop_id', $hiddenData)->get();
                return response()->json([
                    'success' => true,
                    'message' => 'ok',
                    'barcodes' => $barcodes,
                ]);
            }
            else{
                $barcodes = Barcode::where('shop_id', $hiddenData)->get();
                return response()->json([
                    'success' => true,
                    'message' => 'buncha tavar yoq',
                    'barcodes' => $barcodes,
                ]);
            }

        } else {
            $barcode = new Barcode([
                'barcode' => $textData,
                'count' => 1,
                'shop_id' => $hiddenData,
                'name' => $inkassa_sub->name,
                'Org_Dub' => $inkassa_sub->Org_Dub,
                'model' => $inkassa_sub->model,
                'brendi' => $inkassa_sub->brendi,
                'markasi' => $inkassa_sub->markasi,
                'chiqqan_yili' => $inkassa_sub->chiqqan_yili,
                'kelgan_yili' => $inkassa_sub->kelgan_yili,
                'size' => $inkassa_sub->size,
                'sotish_narxi' => $inkassa_sub->sotish_narxi,
                'weight' => $inkassa_sub->weight,
            ]);
            if($barcode->count <= $inkassa_sub->soni){
            $astatka = Astatka::where('shop_id', $hiddenData)->where('barcode', $textData)->first();
                if ($astatka) {
                     $astatka->soni = $inkassa_sub->soni - $barcode->count;
                     $astatka->update();

                 } else
                 {
                     $astatka = new Astatka([
                    'name' => $inkassa_sub->name, // Assign the value to the 'name' field
                    'Org_Dub' => $inkassa_sub->Org_Dub,
                    'part_number' => $inkassa_sub->part_number,
                    'image' => $inkassa_sub->image,
                    'model' => $inkassa_sub->model,
                    'brendi' => $inkassa_sub->brendi,
                    'markasi' => $inkassa_sub->markasi,
                    'barcode' => $inkassa_sub->barcode,
                    'image_path' => $inkassa_sub->image_path,
                    'chiqqan_yili' => $inkassa_sub->chiqqan_yili,
                    'kelgan_yili' => $inkassa_sub->kelgan_yili,
                    'size' => $inkassa_sub->size,
                    'full_price' => $inkassa_sub->full_price,
                    'sotish_narxi' => $inkassa_sub->sotish_narxi,
                    'olingan_narxi' => $inkassa_sub->olingan_narxi,
                    'weight' => $inkassa_sub->weight,
                    'yuk_narxi' => $inkassa_sub->yuk_narxi,
                    'soni' => $inkassa_sub->soni - $barcode->count,
                    'ombor_id' => $inkassa_sub->ombor_id,
                    'shop_id' => $inkassa_sub->shop_id,
                ]);
                $astatka->save();
                     }
            }
            $barcode->save();
            $barcodes = Barcode::where('shop_id', $hiddenData)->get();
            return response()->json([
                'success' => true,
                'message' => 'Data received successfully',
                'barcodes' => $barcodes,
            ]);
        }

    } else {
        return response()->json([
            'success' => true,
            'message' => 'Data received successfully',
            'hiddenData' => $hiddenData,
            'textData' => 'bunday tavardan qarzi yoq',
        ]);
    }

}




    public function clear_barcode(Request $request)
    {
        $id = $request->id;
        $shop = Shop::findOrFail($id);
        $barcodes = Barcode::where('shop_id', $id)->delete();
        $astatka = Astatka::where('shop_id', $id)->delete();
        return redirect()->route('admin.astatka.index')->with('shop', $shop);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barcode  $barcode
     * @return \Illuminate\Http\Response
     */

    public function barcode_generate(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $barcodeExists = true;
        $barcode = null;

    while ($barcodeExists) {
        $barcode = mt_rand(1000000000, 9999999999);

        // Check if barcode already exists in the database
        $existingBarcode = Product::where('barcode', $barcode)->first();

        if (!$existingBarcode) {
            $barcodeExists = false;
        }
    }

   $barcodeImage = DNS1D::getBarcodePNG($barcode, "C39", 2, 60);

    // Save barcode image to storage folder
    $filename = 'barcode_' . time() . '.png';
    $path = 'public/barcodes/' . $filename;
    $image = imagecreatefromstring(base64_decode($barcodeImage));
    imagepng($image, storage_path('app/' . $path));
    imagedestroy($image);

// Save barcode to database
$product->barcode = $barcode;
$product->image_path = $path;
$product->update();
    
    $products = $this->productService->getAll();
    $sorts = $this->productService->sorts();
    $shops = $this->shopService->getAll();
    return back();

    }


}
