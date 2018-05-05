<?php

namespace App\Http\Resources;

use Dingo\Api\Http\Request;
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
        $unit = 2;
        $decimal = 0;
        $latitude1 = $request->latitude;
        $latitude2 = $this->latitude;
        $longitude1 = $request->longitude;
        $longitude2 = $this->longitude;
        $EARTH_RADIUS = 6370.996; // 地球半径系数
        $PI = 3.1415926;
        $radLat1 = $latitude1 * $PI / 180.0;
        $radLat2 = $latitude2 * $PI / 180.0;
        $radLng1 = $longitude1 * $PI / 180.0;
        $radLng2 = $longitude2 * $PI / 180.0;
        $a = $radLat1 - $radLat2;
        $b = $radLng1 - $radLng2;
        $distance = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2)));
        $distance = $distance * $EARTH_RADIUS * 1000;
        if ($unit == 2) {
            $distance = $distance / 1000;
        }

        return [
            'id'=>$this->id,
            'userid'=>$this->user_id,
            'title'=>$this->title,
            'summary'=>$this->summary,
            'avatar'=>$this->avatar,
            'cityInfo'=>$this->cityInfo,
            'address'=>$this->address,
            'villageInfo'=>$this->villageInfo,
            'longitude'=>$this->longitude,
            'latitude'=>$this->latitude,
            'pic_count'=>$this->pic_count,
            'dynamic_count'=>$this->dynamic_count,
            'published_at'=>$this->published_at,
            'code'=>$this->code,
            'user'=>new User($this->user),
            'distance'=>round($distance, $decimal)
        ];
    }
}
