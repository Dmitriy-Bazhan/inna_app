<?php

use Illuminate\Contracts\Routing\UrlGenerator;

if(!function_exists('url_with_locale')){
    function url_with_locale($path = null){
        $locale = app()->getLocale() != 'ua' ? app()->getLocale() : '';
        return app(UrlGenerator::class)->to($locale . $path);
    }
}

if (!function_exists('get_prefix')) {
    function get_prefix()
    {
        if (isset($_SERVER['REQUEST_URI'])) {
            $locale = substr($_SERVER['REQUEST_URI'], 0, 3);

            if ($locale == '/ru') {
                app()->setLocale('ru');
                $prefix = $locale;
            } else {
                app()->setLocale('ua');
                $prefix = '';
            }
            return $prefix;
        }
    }
}

if (!function_exists('take_path')) {
    function take_path()
    {
        $locale = substr($_SERVER['REQUEST_URI'], 0, 3);

        if ($locale == '/ru') {
            $path = substr($_SERVER['REQUEST_URI'], 3, strlen($_SERVER['REQUEST_URI']) - 3);
            $locale = '';
        } else {
            $path = $_SERVER['REQUEST_URI'];
            $locale = 'ru';
        }
        return app(UrlGenerator::class)->to($locale . $path);
    }
}
