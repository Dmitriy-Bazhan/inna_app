<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@lang('site.' . $page . '.title')</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="screen">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" media="screen">
    <link href="{{ asset('css/' . $page .'.css') }}" rel="stylesheet" type="text/css" media="screen">

</head>

<body>

<script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

@include('site.components.header')

{{--@include('site.components.header2')--}}

<div class="container-fluid">

    <div class="row" style="margin-top: 6%;">

        <div class="col-9">

            @yield('content')

        </div>

        <div class="col-3">

            @include('site.components.left-nav-menu')

        </div>


    </div>

</div>

@include('site.components.footer')

<script src=" {{ asset('js/main.js') }}"></script>

</body>
</html>
