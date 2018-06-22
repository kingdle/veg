<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
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
            'user_id'=>$this->user_id,
            'to_user_id'=>$this->to_user_id,
            'prod_id'=>$this->prod_id,
            'tag_id'=>$this->tag_id,
            'tags'=>$this->tag,
            'counts'=>$this->counts,
            'price'=>$this->price,
            'unit_price'=>$this->unit_price,
            'total_price'=>$this->total_price,
            'name'=>$this->name,
            'value'=>$this->name,
            'nickname'=>$this->nickname,
            'address'=>$this->address,
            'cityInfo'=>$this->cityInfo,
            'villageInfo'=>$this->villageInfo,
            'longitude'=>$this->longitude,
            'latitude'=>$this->latitude,
            'phone'=>$this->phone,
            'state'=>$this->state,
            'state_at'=>$this->state_at,
            'payment'=>$this->payment,
            'payment_at'=>$this->payment_at,
            'is_confirm'=>$this->is_confirm,
            'buyer_at'=>$this->buyer_at,
            'seller_at'=>$this->seller_at,
            'buyer_confirm_at'=>$this->buyer_confirm_at,
            'start_at'=>substr($this->start_at,0,10),
            'end_at'=>substr($this->end_at,0,10),
            'sendDate'=>[substr($this->start_at,0,10),substr($this->end_at,0,10)],
            'note_buy'=>$this->note_buy,
            'rate_buyer'=>$this->rate_buyer,
            'note_sell'=>$this->note_sell,
            'rate_seller'=>$this->rate_seller,
            'is_del'=>$this->is_del,
            'deleted_at'=>$this->deleted_at,
            'created_at'=>$this->created_at->format('Y年m月d日H点i分'),
            'update_at'=>$this->update_at,
        ];
    }
}
