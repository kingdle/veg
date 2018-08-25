<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class bigDynamic extends JsonResource
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
            'id'=> $this->id,
            'sort_id'=> $this->sort_id,
            'user_id'=> $this->user_id,
            'title'=> $this->title,
            'content'=> $this->content,
            'pic'=> json_decode($this->pic),
            'is_hidden'=> $this->is_hidden,
            'published_at'=> $this->published_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
