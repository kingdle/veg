<?php

namespace App\Http\Controllers;

use App\Http\Resources\SortCollection;
use App\Sort;
use Illuminate\Http\Request;

class SortsController extends Controller
{
    public function index(Request $request)
    {
        $sorts = Sort::where('parent_id','=','0')->where('title','like','%'.$request->query('q').'%')->orderBy('hot', 'desc')->get();
        return new SortCollection($sorts);
    }
    public function sorts(Request $request)
    {
        $sorts = Sort::where('title','like','%'.$request->query('q').'%')->orderBy('hot', 'desc')->get();
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
    public function store(Request $request,Sort $sort){
        $sort->fill($request->all());
        $sort->save();
    }
}
