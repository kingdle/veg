<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Seed extends JsonResource
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
            'username'=>$this->username,
            'address'=>$this->address,
            'email'=>$this->email,
            'content'=>$this->content,
            'phone'=>$this->phone,
            'web_url'=>$this->web_url,
            'remark'=>$this->remark,
            'published_at'=>$this->published_at,
        ];
    }
}
