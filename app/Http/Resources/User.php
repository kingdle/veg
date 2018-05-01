<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'name'=>$this->name,
            'phone'=>substr_replace($this->phone,'****',3,4),
            'email'=>$this->email,
//            'avatar'=>$this->avatar,
            'avatar_url'=>$this->avatar_url,
            'is_active'=>$this->is_active,
            'is_admin'=>$this->is_admin,
//            'shop'=>new Shop($this->shop)
        ];
    }

}
