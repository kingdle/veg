<?php

namespace App\Http\Controllers;

use App\Http\Resources\SortCollection;
use App\Sort;
use Illuminate\Http\Request;

class SortsController extends Controller
{
    public function index()
    {
        $sorts = Sort::where('parent_id',0)->get();
        return new SortCollection($sorts);
    }

    public function show($id)
    {
        $sort = Sort::where('parent_id',$id)->get();
        if ($sort->count() == 0) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new SortCollection($sort);
    }
}
