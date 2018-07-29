<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class Message extends JsonResource
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
            'nickname'=> $this->user->nickname,
            'avatar'=> $this->user->avatar_url,
            'content'=>$this->content,
            'pic'=>json_decode($this->pic),
            'is_adopt'=>$this->is_adopt,
            'published_at'=>$this->published_at,
            'created_at'=>$this->created_at->format('Y-m-d H:i'),
            'updated_at'=>$this->updated_at,
        ];
    }
}
