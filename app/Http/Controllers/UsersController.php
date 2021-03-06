<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Location;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Iwanli\Wxxcx\Wxxcx;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    protected $wxxcx;

    function __construct(Wxxcx $wxxcx)
    {
        $this->wxxcx = $wxxcx;
    }

    public function index()
    {
        $users = User::with('shop')->orderBy('id', 'desc')->paginate(9);
        return new UserCollection($users);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new \App\Http\Resources\User($user);
    }

    public function weappStore(UserRequest $request)
    {
        // 缓存中是否存在对应的 key
        $verifyData = \Cache::get($request->verification_key);

        if (!$verifyData) {
            return response()->json(['status' => false, 'message' => '验证码已失效'],422);
        }

        // 判断验证码是否相等，不相等反回 401 错误
        if (!hash_equals((string)$verifyData['code'], $request->verification_code)) {
            return response()->json(['status' => false, 'message' => '验证码错误'],422);
        }

        // 获取微信的 openid 和 session_key
        $miniProgram = \EasyWeChat::miniProgram();
        $data = $miniProgram->auth->session($request->code);

        if (isset($data['errcode'])) {
            return response()->json(['status' => false, 'message' => 'code 不正确'],422);
        }

        // 如果 openid 对应的用户已存在，报错403
        $user = User::where('weapp_openid', $data['openid'])->first();

        if ($user) {
            return response()->json(['status' => false, 'message' => '微信已绑定其他用户，请直接登录'],422);
        }

        // 创建用户
        $user = User::create([
//            'name' => $request->name,
            'phone' => $verifyData['phone'],
            'password' => bcrypt($request->password),
            'weapp_openid' => $data['openid'],
            'weixin_session_key' => $data['session_key'],
        ]);

        // 清除验证码缓存
        \Cache::forget($request->verification_key);

        // meta 中返回 Token 信息
        return response()->item($user, new UserCollection())
            ->setMeta([
                'access_token' => \Auth::guard('api')->fromUser($user),
                'token_type' => 'Bearer',
                'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
            ])
            ->setStatusCode(201);
    }

//    public function store(Request $request)
//    {
//        if (!$request->get('phone') or !$request->get('password')) {
//            return [
//                'status' => 'error',
//                'status_code' => '404',
//                'message' => '请重新输入手机号'
//            ];
//        }
//        User::create([
//            'phone' => $request->phone,
//            'email' => $request->email,
//            'password' => Hash::make($request->password),
//        ]);
//        return response()->json(['status' => true]);
//    }
    public function getPhone(Request $request)
    {
        $code = request('code', '');
        $encryptedData = request('encryptedData', '');
        $iv = request('iv', '');
        //根据 code 获取用户 session_key 等信息, 返回用户openid 和 session_key
        $userInfo = $this->wxxcx->getLoginInfo($code);
        //获取解密后的用户信息
        $wxinfo=$this->wxxcx->getUserInfo($encryptedData, $iv);
        return $wxinfo;
    }
    public function userPhoneUpdate(Request $request)
    {
        $userid = Auth::guard('api')->user()->id;
        $user = User::find($userid);
        $attributes['phone'] = request('phoneNumber', '');
        // 更新用户数据
        $user->update($attributes);
        return response()->json([
            'data'=>$user
        ], 200);
    }
    public function update()
    {
        request()->user()->update(request()->only('name'));
        return response()->json(['status' => true]);
    }
    public function weappupdate(Request $request)
    {
        $userId = Auth::guard('api')->user()->id;
        $user = User::where('id', $userId)->first();

        $attributes['country'] = $request->country;
        $attributes['province'] = $request->province;
        $attributes['city'] = $request->city;
        $attributes['district'] = $request->district;
        $attributes['town'] = $request->town;
        $attributes['address'] = $request->address;
        $attributes['villageInfo'] = $request->villageInfo;
        $attributes['latitude'] = $request->latitude;
        $attributes['longitude'] = $request->longitude;
        // 更新用户数据
        $user->update($attributes);

        Location::create([
            'user_id' => $userId,
            'country' => $request->country,
            'province' => $request->province,
            'city' => $request->city,
            'district' => $request->district,
            'town' => $request->town,
            'street' => $request->street,
            'street_number' => $request->street_number,
            'crossroad' => $request->crossroad,
            'nation_code' => $request->nation_code,
            'city_code' => $request->city_code,
            'adcode' => $request->adcode,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'location_title' => $request->location_title,
            'location_dir_desc' => $request->location_dir_desc,
            'live_place' => $request->live_place,
        ]);

        return response()->json([
            'data'=>$user
        ], 200);
    }
}
