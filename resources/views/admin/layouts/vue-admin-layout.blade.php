<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>VUE ADMIN</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" media="screen">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="screen">
    <link href="{{ asset('css/admin/admin-main.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/admin/admin-chat.css') }}" rel="stylesheet" type="text/css" media="screen">

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</head>

<body data-admin-id="{{ Auth::user()->id }}">

@include('admin.components.header')

<br>
<br>
<br>

<div id="vue-admin-main" class="row">

    <vue-admin-main></vue-admin-main>

</div>

</body>
