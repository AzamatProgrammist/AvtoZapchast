<?php 

namespace App\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\ShopRepositoryInterface;

class ProductService
{
	public $productInterface;
	public $shopInterface;
	public function __construct(ProductRepositoryInterface $productInterface, ShopRepositoryInterface $shopInterface)
	{
		$this->productInterface = $productInterface;
		$this->shopInterface = $shopInterface;
	}

    public function getAll()
    {
        return $this->productInterface->getAllProduct();
    }
    public function get_product($id)
    {
        return $this->productInterface->getProduct($id);
    }

    public function sorts()
    {
        $sorts = [];
        $products = $this->productInterface->getAllProduct();
        foreach($products as $product)
        {
            if (!in_array($product->analog, $sorts)) {
                $sorts[] = $product->analog;
            }
        }

        sort($sorts);
        (object)$sorts;
        return $sorts;
    }

    public function product_count($orders)
    {
        $product_count = 0;
        $shop_id = [];
        foreach ($orders as $order) {
            
            $product_count = $product_count + $order->soni;
        }
        return $product_count;
    }
	public function store($request)
	{
        
        if ($request->file('image')) {
            
            $file = $request->file('image');
            $image_name = time().'.'.$file->getClientOriginalName();
            $file->move('site/products/images/', $image_name);
        }else{
            $image_name = "avto.jfif";
        }

        $user_id = $this->shopInterface->getUser_id($request->shop_id);

		$requestData = $this->productData($request->all(), $image_name, $user_id);

        $product = $this->productInterface->save($requestData);
	}
	
	public function update($request, $id)
	{
		$product = $this->productInterface->getProduct($id);

        $oldimage = $request->oldimage;
        $image_name = $oldimage;
        if ($request->file('image')) {
            $file = $request->file('image');
            $image_name = time().'.'.$file->getClientOriginalName();
            $file->move('site/products/images/', $image_name);
            if ($oldimage) {
                if(file_exists('site/products/images/'.$oldimage))
                {
                    $rr = file_exists('site/products/images/'.$oldimage);
                    dd($rr);
                    unlink('site/products/images/'.$oldimage);
                }
            }
        }
        $user_id = $this->shopInterface->getUser_id($request->shop_id);

       	$requestData = $this->productData($request->all(), $image_name, $user_id);

        $this->productInterface->update($requestData, $id);
	}

    public function destroy($id)
    {
        $oldimage = $this->productInterface->getProduct($id);
        if(file_exists('site/products/images/'.$oldimage->image)){
            if ($oldimage->image ==! "avto.jfif")
            {
                unlink('site/products/images/'.$oldimage->image);
            }
        }
        $this->productInterface->deleteProduct($id);
    }

	public function productData($request, $image_name, $user_id)
	{
		 $full_price = $request['olingan_narxi']*$request['soni'] + $request['yuk_narxi']*$request['weight']*$request['soni'];
        $requestData = [
            'name' => $request['name'],
            'Org_Dub' => $request['Org_Dub'],
            'part_number' => $request['part_number'],
            'image' => $image_name,
            'model' => $request['model'],
            'brendi' => $request['brendi'],
            'markasi' => $request['markasi'],
            'analog' => $request['analog'],
            'chiqqan_yili' => $request['chiqqan_yili'],
            'kelgan_yili' => $request['kelgan_yili'],
            'size' => $request['size'],
            'full_price' => $full_price,
            'sotish_narxi' => $request['sotish_narxi'],
            'olingan_narxi' => $request['olingan_narxi'],
            'weight' => $request['weight'],
            'yuk_narxi' => $request['yuk_narxi'],
            'soni' => $request['soni'],
            'little' => $request['little'],
            'many' => $request['many'],
            'ombor_id' => $request['ombor_id'],
            'shop_id' => $request['shop_id'],
            'user_id' => $user_id,
        ];
        return $requestData;
	}





}

 ?>