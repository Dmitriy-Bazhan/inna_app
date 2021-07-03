<link href="{{ asset('css/header.css') }}" rel="stylesheet" type="text/css">

<div class="container-fluid site-header">

    <div class="row">

        <div class="col-1">

            <img src=" {{ asset('images/01.jpg') }}" style="height: 25px; width: 25px;">

            <span class="header-text">Metrise</span>

        </div>

        <div class="col-1">

            <span class="header-text">Магазин</span>

        </div>

        <div class="col-1">

            <span class="header-text">Блог</span>

        </div>

        <div class="col-1">

            <span class="header-text">Видеоблог</span>

        </div>


        <div class="col-1">

            <span class="header-text">Контакты</span>

        </div>


        <div class="col-1">

            <span class="header-text">Кто мы</span>

        </div>



        <div class="col-1 offset-1">

            <a href="">UA</a>
            <a href="">RU</a>
            <a href="">EN</a>

        </div>

        <div class="col-2">

            <form>

                <label>Поиск</label>
                <input type="text" name="search">
                <input type="submit" value="x" onclick="event.preventDefault()">

            </form>

        </div>

        @if(isset(Auth::user()->id) && Auth::user()->id != null)

            <div class="col-2">

                <a href=" {{ route('dashboard') }}"><span class="header-text">Вы зашли {{ Auth::user()->name }}</span></a>

            </div>

        @else

            <div class="col-2">

                <a href=" {{ route('login') }}"><span class="header-text">Login</span></a>
                <a href=" {{ route('register') }}"><span class="header-text">Register</span></a>

            </div>


        @endif

    </div>

</div>

