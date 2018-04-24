<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Shop extends JsonResource
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
            'userid'=>$this->user_id,
            'title'=>$this->title,
            'summary'=>$this->summary,
            'avatar'=>$this->avatar,
            'cityInfo'=>$this->cityInfo,
            'address'=>$this->address,
            'longitude'=>$this->longitude,
            'latitude'=>$this->latitude,
            'pic_count'=>$this->pic_count,
            'dynamic_count'=>$this->dynamic_count,
            'published_at'=>$this->published_at,
            'code'=>$this->code,
            'user'=>new User($this->user)
        ];
    }
}
