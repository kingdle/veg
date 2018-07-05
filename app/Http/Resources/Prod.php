<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Prod extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
//            'shop_id'=>$this->shop_id,
            'sort_id'=>$this->sort_id,
            'title'=>$this->title,
            'introduce'=>$this->introduce,
            'sort'=>$this->sort->title,
            'pic'=>$this->pic,
            'unit_price'=>$this->unit_price,
            'created_at'=>$this->created_at->format('Y年m月d日'),
//            'update_at'=>$this->update_at,
        ];
    }
}
