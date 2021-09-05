<?php

namespace App\Http\Controllers\HomePage;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostData;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class HomePageController extends Controller
{
    public function index()
    {
        $data['page'] = 'home-page';
        //Использование памяти (примитивно )
        $start = memory_get_usage();


        //Кеширование в Redis
        try {
            $item = Cache::store('redis')->get('posts');
            if (is_null($item)) {
                $data['posts'] = Post::with('data')->orderBy('created_at', 'desc')->get();
                Cache::store('redis')->put('posts', $data['posts'], 60000);
            } else {
                $data['posts'] = $item;
            }
        } catch (\Exception $exception) {
            //Временно. Исправить когда разберусь с логами
            dd('Redis not work');
        }

        //Использование памяти
        $end = memory_get_usage();
        $data['memory'] = $end - $start;

        return view('site.pages.homepage', $data);
    }
}
