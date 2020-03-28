<?php

namespace App\Http\Controllers;

use App\Phone;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function store(Request $request,Phone $phone){
        $phone->fill($request->all());
        $phone->save();
        return response()->json([
            'message' => '填写成功',
            'data' =>$phone
        ]);
    }
}
