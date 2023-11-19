<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InkassaSubResource extends JsonResource
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
                'name' => $this->name,
                'Org_Dub' => $this->Org_Dub,
                'part_number' => $this->part_number,
                'image' => $this->image,
                'model' => $this->model,
                'brendi' => $this->brendi,
                'markasi' => $this->markasi,
                'chiqqan_yili' => $this->chiqqan_yili,
                'kelgan_yili' => $this->kelgan_yili,
                'size' => $this->size,
                'full_price' => $this->full_price,
                'sotish_narxi' => $this->sotish_narxi,
                'count' =>$this->soni,
                
            ];
    }
}
