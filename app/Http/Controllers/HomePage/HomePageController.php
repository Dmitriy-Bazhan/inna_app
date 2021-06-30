<?php

namespace App\Http\Controllers\HomePage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    public function index(){
        $data['page'] = 'home-page';
        return view('site.pages.homepage', $data);
    }
}
