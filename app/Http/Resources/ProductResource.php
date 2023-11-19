<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'Org_Dub' => $this->Org_Dub,
            'part_number' => $this->part_number,
            'image' => '/site/products/images/'.$this->image,
            'model' => $this->model,
            'brendi' => $this->brendi,
            'markasi' => $this->markasi,
            'chiqqan_yili' => $this->chiqqan_yili,
            'kelgan_yili' => $this->kelgan_yili,
            'size' => $this->size,
            'price' => $this->sotish_narxi,
            'olingan_narxi' => $this->olingan_narxi,
            'weight' => $this->weight,
            'yuk_narxi' => $this->yuk_narxi,
            'count' => $this->soni,
        ];
    }
}
