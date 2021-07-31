@extends('admin.layouts.admin-layout')

@section('content')

    <h1>PARSING</h1>

    <p>Здесь надо реализовать парсинг какого нибудь сайта. Потренироваться</p>

    <div id="app">
        <test-component></test-component>
    </div>
    <script src="{{mix('js/app.js')}}"></script>

@endsection
