<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $page }}</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="screen">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet" type="text/css">

</head>

<body>

<script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

@include('admin.components.header')

<br>
<br>
<br>

<div class="container-fluid main-container">

    <div class="row">

        <div class="col-3">

            @include('admin.components.nav-menu')

        </div>

        <div class="col-9">

            @yield('content')

        </div>

    </div>

</div>

</body>

</html>
