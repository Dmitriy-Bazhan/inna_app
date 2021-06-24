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

<div class="container-fluid">

    <div class="row">

        <div class="col-8 content-box offset-2">

            @include('site.components.header')

            @yield('content')

        </div>

    </div>

</div>

@include('site.components.footer')

<script src=" {{ asset('js/main.js') }}"></script>

</body>
</html>
