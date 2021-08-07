<!DOCTYPE html>
<html lang="{{ app()->getLocale() == 'ru' ? 'ru-UA' : 'uk-UA' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@lang('site.' . $page . '.title')</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="screen">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" media="screen">

    <link href="{{ asset('css/' . $page .'.css') }}" rel="stylesheet" type="text/css" media="screen">

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ '/js/lang/' . app()->getLocale() }}"></script>

</head>

<body @if(Auth::check()) data-user-id="{{ Auth::user()->id }}" data-user-name="{{ Auth::user()->name }}" @endif>

@include('site.components.header')

{{--@include('site.components.header2')--}}

<div class="container-fluid">

    <div class="row" style="margin-top: 6%;">

        <div class="col-7 offset-1">

            @yield('content')

        </div>

        <div class="col-3">

            @include('site.components.aside-menu')

        </div>


    </div>

</div>

@include('site.components.footer')

@if(auth()->check())

    <script src="{{mix('js/app.js')}}"></script>
    <div id="vue-chat">
        <vue-chat-component></vue-chat-component>
    </div>



    <link href="{{ asset('css/chat.css') }}" rel="stylesheet" type="text/css" media="screen">

{{--    @include('site.components.chat')--}}

    <script src=" {{ asset('js/chat.js') }}"></script>

@endif

<script src=" {{ asset('js/main.js') }}"></script>

</body>
</html>
