<?php

namespace App\Http\Resources;
use App\Config;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ConfigCollection extends ResourceCollection
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
//    public function with($request){
//        return [
//            'status'=>'success',
//            'status_code'=>'200',
//            'introduce'=>Config::find('1'),
//            'slogan'=>Config::find('2'),
//            'advert'=>Config::find('6'),
//            'advert_decode'=>json_decode(Config::find('6')->slide),
//        ];
//    }
}
