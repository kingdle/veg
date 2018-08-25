<?php

namespace App\Http\Controllers\bigcode;

use App\BigDynamic;
use App\Http\Resources\bigDynamicCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class dynamicsController extends Controller
{
    public function index()
    {
        $dynamics = BigDynamic::orderBy('id', 'desc')->paginate(9);
        return new bigDynamicCollection($dynamics);
    }

    public function show($id)
    {
        $dynamics = BigDynamic::find($id)->get();
        if ($dynamics->count() == 0) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return $dynamics;
    }
}
