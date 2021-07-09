<?php

namespace App\Http\Controllers\HomePage;

use App\Http\Controllers\Controller;
use App\Models\Characteristic;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    public function index(){
        $data['page'] = 'home-page';
        $data['posts'] = Post::with('data')->orderBy('created_at', 'desc')->get();
        return view('site.pages.homepage', $data);
    }
}
