<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        return view('banner', [
            'title'=> 'banner'
        ]);
    }
    
}
