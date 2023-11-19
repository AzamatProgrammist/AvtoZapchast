<?php 

namespace App\Services;

use App\Models\MainOrder;
use App\Repositories\Interfaces\InkassaRepositoryInterface;
use App\Repositories\Interfaces\ShopRepositoryInterface;

class InkassaService
{
    public $inkassaRepository;
    public $shopRepository;
    public $productRepository;

    public function __construct(InkassaRepositoryInterface $inkassaRepository, ShopRepositoryInterface $shopRepository)
    {
        $this->inkassaRepository = $inkassaRepository;
        $this->shopRepository = $shopRepository;
    }

    public function getAlls()
    {
        return $this->inkassaRepository->getInkassasAll();
    }

    public function getInkasse($id)
    {
        return $this->inkassaRepository->getInkassa($id);
    }

	public function getShop_name()
	{
        $inkassas = $this->inkassaRepository->getInkassasAll();
		$shops = $this->shopRepository->getAll();
        $shop_id = [];
        foreach($shops as $shop)
        {
            foreach ($shop->inkassas as $inkassa) {
                if(!in_array($inkassa->shop_id, $shop_id))
                {
                    $shop_id[] = $inkassa->shop_id;
                }
            }
        }
        $shop_id = (object)$shop_id;
        $shop_name = [];
        foreach($shop_id as $shopId)
        {

            foreach($shops as $shop)
            {
                if ($shop->id == $shopId) {
                    $shop_name[] = $shop;
                }
            }
        }
        $shop_name = (object)$shop_name;
        return $shop_name;
	}

    public function getInkassaUpdate($product, $inkassaSub, $request, $inkassa)
    {

        $qolganSoni = $inkassaSub->soni - $request->quantity;
        $inkassaSub->soni = $inkassaSub->soni - $request->quantity;
        $inkassaSub->full_price = $inkassaSub->sotish_narxi*$qolganSoni;
        $qolgan_product = $product->soni - $request->quantity;
        $product->soni = $qolgan_product;
        $product->full_price = $product->olingan_narxi*$qolgan_product + $product->yuk_narxi*$product->weight*$qolgan_product;
        
        $product->update();
        $inkassaSub->update();

        $delet = 0;
        $full = 0;
                foreach ($inkassa->inkassaSubs as $inkassaSub) {
                    if ($inkassaSub->soni > 0) {
                        $delet = $delet + $inkassaSub->soni;
                        $full = $inkassaSub->soni*$inkassaSub->sotish_narxi + $full;
                    }
                }
        $inkassa['products_num'] = $delet;
        $inkassa['full_price'] = $full;
        $inkassa->update();
        if ($delet == 0) {
            foreach($inkassa->inkassaSubs as $inkassaSubDelet){
                $inkassaSubDelet->delete();
            }
            $inkassa->delete();
            
            $meinORD = MainOrder::where('id', $inkassa->mainOrder_id)->get();
            
            foreach($meinORD as $key) {
                $key['status'] = '1';
                $key->update();
            }
        }
        return $inkassa;
    }
}


 ?>