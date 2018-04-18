<?php

namespace App\Http\Controllers;

use App\Http\Resources\DynamicCollection;
use App\Dynamic;
use Illuminate\Http\Request;

class DynamicsController extends Controller
{
    public function index()
    {
        $dynamics = Dynamic::with('user')->paginate(5);
        return new DynamicCollection($dynamics);
    }

    public function show($user_id)
    {
        $dynamics = Dynamic::where('user_id', $user_id)->paginate(5);
        if ($dynamics->count() == 0) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return $dynamics;
    }
}
