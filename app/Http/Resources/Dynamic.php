<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Dynamic extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $shop=new Shop($this->shop);
        return [
            'id'=>$this->id,
            'userid'=>$this->user_id,
            'shop_id'=>$this->shop_id,
            'sort_id'=>$this->sort_id,
            'content'=>$this->content,
            'pic'=>json_decode($this->pic),
            'followers_count'=>$this->followers_count,
            'published_at'=>$this->published_at,
            'is_hidden'=>$this->is_hidden,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'shop'=>$shop,
        ];
    }
}
