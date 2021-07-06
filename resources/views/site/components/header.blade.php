<link href="{{ asset('css/header.css') }}" rel="stylesheet" type="text/css">

<div class="container-fluid site-header">

    <div class="row">

        <div class="col-3 header-block">

            <img src=" {{ asset('images/ava/site-logo.jpg') }}" style="height: 25px; width: 25px;" alt="">

            <a href="{{ url_with_locale('/') }}"><span class="header-text">Metrise</span></a>

        </div>

        <div class="col-1 header-block">

            <a href="{{ url_with_locale('/shop') }}"><span class="header-text">Магазин</span></a>

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

            @foreach(['ua', 'ru'] as $locale)

                @if($locale == app()->getLocale())

                    <span class="header-text">{{ mb_strtoupper($locale) }}</span>

                @else

                    @php($path = take_path())
                    <a href="{{ url($path) }}"><span
                            class="header-text"  style="color: gray;">{{ mb_strtoupper($locale) }}</span></a>

                @endif

            @endforeach

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

