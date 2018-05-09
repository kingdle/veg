<?php

namespace App\Http\Resources;

use App\Config;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ShopCollection extends ResourceCollection
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
        return [
            'status'=>'success',
            'status_code'=>'200',
            'slogan'=>Config::find('1'),
            'slide'=>json_decode(Config::find('1')->slide),
            'notice'=>json_decode(Config::find('1')->notice),
        ];
    }
}
