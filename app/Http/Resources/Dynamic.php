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
//        $tags=new TagCollection($this->tags);
        return [
            'id'=>$this->id,
            'userid'=>$this->user_id,
            'shop_id'=>$this->shop_id,
            'sort_id'=>$this->sort_id,
            'content'=>$this->content,
            'pic'=>json_decode($this->pic),
            'followers_count'=>$this->followers_count,
            'answers_count'=>$this->answers_count,
            'close_comment'=>$this->close_comment,
            'is_hidden'=>$this->is_hidden,
            'published_at'=>$this->published_at,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'shop'=>$shop,
            'tags'=>$this->tags,
            'sorts'=>$this->sorts,
        ];
    }
}
