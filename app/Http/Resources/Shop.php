<?php

namespace App\Http\Resources;

use Dingo\Api\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Auth;

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
        /**
         * 计算两点地理坐标之间的距离
         * @param  Decimal $longitude1 起点经度
         * @param  Decimal $latitude1  起点纬度
         * @param  Decimal $longitude2 终点经度
         * @param  Decimal $latitude2  终点纬度
         * @param  Int     $unit       单位 1:米 2:公里
         * @param  Int     $decimal    精度 保留小数位数
         * @return Decimal
         */
        $unit = 1;
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
        $distance = $distance * $EARTH_RADIUS*1000;
        if($distance>1000){
            $distance = $distance / 1000;
            $distance = round($distance, $decimal)."公里";
        }else{
            $distance = $distance / 100;
            $distance = round($distance, $decimal)."米";
        }
//        if(Auth::user()){
//            $favorites=Auth::user()->favorites()->pluck('shop_id')->ToArray();
//            if (in_array($this->id, $favorites)) {
//                $favorite=1;
//            }else{
//                $favorite=0;
//            }
//        }

        return [
            'id'=>$this->id,
            'userid'=>$this->user_id,
            'title'=>$this->title,
            'summary'=>$this->summary,
            'avatar'=>$this->avatar,
            'country'=>$this->country,
            'province'=>$this->province,
            'cityInfo'=>$this->cityInfo,
            'address'=>$this->address,
            'villageInfo'=>$this->villageInfo,
            'longitude'=>$this->longitude,
            'latitude'=>$this->latitude,
            'pic_count'=>$this->pic_count,
            'dynamic_count'=>$this->dynamic_count,
            'published_at'=>$this->published_at,
            'updated_at'=>$this->updated_at,
            'code'=>$this->code,
            'comments_count'=>$this->comments_count,
            'click_count'=>$this->click_count,
            'followers_count'=>$this->followers_count,
            'answers_count'=>$this->answers_count,
            'close_comment'=>$this->close_comment,
            'user'=>new User($this->user),
            'distance'=>$distance,
        ];
    }
}
