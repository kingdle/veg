<?php

namespace App\Http\Controllers;

use App\Config;
use App\Http\Resources\ConfigCollection;
use Illuminate\Http\Request;

class ConfigsController extends Controller
{
    public function index()
    {
        $configs = Config::wherein('id',[1,2,6])->get();
        return new ConfigCollection($configs);
    }
}
