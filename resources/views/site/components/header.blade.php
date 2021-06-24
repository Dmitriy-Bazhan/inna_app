<link href="{{ asset('css/header.css') }}" rel="stylesheet" type="text/css">

<div class="container-fluid site-header">

    <div class="row">

        <div class="col-2">

            <span class="header-text">DDD</span>

        </div>

        <div class="col-6">


        </div>

        <div class="col-2">

        </div>

        @if(isset(Auth::user()->id) && Auth::user()->id != null)

            <div class="col-2">

                <a href=" {{ route('dashboard') }}"><span class="header-text">{{ Auth::user()->name }}</span></a>

            </div>

        @else

            <div class="col-2">

                <a href=" {{ route('login') }}"><span class="header-text">Login</span></a>
                <a href=" {{ route('register') }}"><span class="header-text">Register</span></a>

            </div>


        @endif

    </div>

</div>

