<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Tag extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
//            'bio' => $this->bio,
//            'pic' => $this->pic,
//            'dynamics_count' => $this->dynamics_count,
//            'followers_count' => $this->followers_count,
//            'created_at' => $this->created_at,
//            'updated_at'=>$this->updated_at,
        ];
    }
}
