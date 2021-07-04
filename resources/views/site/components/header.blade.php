<link href="{{ asset('css/header.css') }}" rel="stylesheet" type="text/css">

<div class="container-fluid site-header">

    <div class="row">

        <div class="col-3 header-block">

            <img src=" {{ asset('images/ava/site-logo.jpg') }}" style="height: 25px; width: 25px;">

            <span class="header-text">Metrise</span>

        </div>

        <div class="col-1 header-block">

            <span class="header-text">Магазин</span>

        </div>

        <div class="col-1 header-block">

            <span class="header-text">Блог</span>

        </div>

        <div class="col-1 header-block">

            <span class="header-text">Видеоблог</span>

        </div>


        <div class="col-1 header-block">

            <span class="header-text">Контакты</span>

        </div>


        <div class="col-1 header-block">

            <span class="header-text">Кто мы</span>

        </div>



        <div class="col-1 header-block">

            <a href=""><span class="header-text">UA</span></a>
            <a href=""><span class="header-text">RU</span></a>
{{--            <a href=""><span class="header-text">EN</span></a>--}}

        </div>

        <div class="col-2 header-block">

            <form>

                <label>Поиск</label>
                <input type="text" name="search">
                <input type="submit" value="x" onclick="event.preventDefault()">

            </form>

        </div>

        @if(isset(Auth::user()->id) && Auth::user()->id != null)

            <div class="col-1 header-block">

                <a href=" {{ route('dashboard') }}"><span class="header-text"> {{ Auth::user()->name }}</span></a>

            </div>

        @else

            <div class="col-1 header-block">

                <a href=" {{ route('login') }}"><span class="header-text">Login</span></a>
                <a href=" {{ route('register') }}"><span class="header-text">Register</span></a>

            </div>


        @endif

    </div>

</div>

