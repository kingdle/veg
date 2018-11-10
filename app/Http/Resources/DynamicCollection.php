<?php

namespace App\Http\Resources;

use App\Config;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DynamicCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
    public function with($request){
        $config=Config::find('1');
        return [
            'status'=>'success',
            'status_code'=>'200',
            'slogan'=>$config,
            'slide'=>json_decode($config->slide),
        ];
    }
}
