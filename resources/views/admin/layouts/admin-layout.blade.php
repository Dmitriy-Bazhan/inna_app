<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $page }}</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="screen">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet" type="text/css">

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</head>

<body>

@include('admin.components.header')

<br>
<br>
<br>


<div class="container-fluid main-container">

    <div class="row">

        <div class="col-2">

            @include('admin.components.nav-menu')

        </div>


        <div class="col-10">

            <div class="row">

                <div class="col-5 offset-7 must-remember-block">

                    <span class="must-remember">Для работы websockets на локальном сервере обязательно использование протокола <strong>HTTP.</strong></span><br>
                    <span class="must-remember">Проверять чтобы админка была с адресом http::/app.lock/admin, или не будет работать Echo.</span>
                    <span class="must-remember">Перед размещением на продакшен надо отработать работу сокетов через HTTPS.</span><br>
                    <span class="must-remember">Сменить PUSHER_APP_SCHEME на HTTPS в файле .env.</span>

                </div>

            </div>


            @yield('content')

        </div>

    </div>

</div>

<link href="{{ asset('css/admin-chat.css') }}" rel="stylesheet" type="text/css" media="screen">

@include('admin.components.admin_chat')

</body>

</html>
