<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InkassaOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return 
        [
            'shop_name' => $this->shop_name,
            'admin' => $this->admin,
            'full_price' => $this->full_price,
            'date' => date_format($this->created_at, 'Y-m-d'),
            'products' => InkassaSubResource::collection($this->inkassaSubs),
        ];
    }
}
