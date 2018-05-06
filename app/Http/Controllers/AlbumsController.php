<?php

namespace App\Http\Controllers;

use App\Album;
use App\Http\Resources\AlbumCollection;
use Illuminate\Http\Request;

class AlbumsController extends Controller
{
    public function index()
    {
        $albums = Album::paginate(28);
        return new AlbumCollection($albums);
    }

    public function show($shop_id)
    {
        $album = Album::where('shop_id', $shop_id)->orderBy('id', 'desc')->paginate(9);
        if ($album->count() == 0) {
            return response()->json(['status' => false, 'status_code' => '401']);
        }
        return new AlbumCollection($album);

    }
}
