<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(){
        $data['page'] = 'shop';

        return view('site.pages.shop', $data);
    }
}
