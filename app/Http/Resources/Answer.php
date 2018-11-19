<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Answer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'to_user_id'=>$this->to_user_id,
            'dynamic_id'=>$this->dynamic_id,
            'body'=>$this->body,
            'votes_count'=>$this->votes_count,
            'comments_count'=>$this->comments_count,
            'is_hidden'=>$this->is_hidden,
            'is_read'=>$this->is_read,
            'read_at'=>$this->read_at,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
