@extends('site.layouts.layout')

@section('content')

    <div class="container-fluid">

        <div class="row">

            <div class="col-8 offset-2">

                <span class="homepage-text-before-images">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet exercitationem fugiat laborum
                    libero quas reiciendis sequi tempora totam veniam voluptatem.
                     Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque illum ipsam perspiciatis possimus
                     ratione, reiciendis sit tenetur ut veritatis vitae!</span>

            </div>

        </div>

        <div class="row">

            <div class="col-6">

                <img class="homepage-box-image1" src=" {{ asset('images/01.jpg') }}"/>

            </div>

            <div class="col-6">

                <img class="homepage-box-image2" src=" {{ asset('images/02.jpg') }}"/>

            </div>

        </div>

        <div class="row">

            <div class="col-8 offset-1">

                <img class="homepage-box-image3" src=" {{ asset('images/03.jpg') }}"/>

                <img class="homepage-box-image4" src=" {{ asset('images/04.jpg') }}"/>

            </div>

        </div>

        <div class="row">

            <div class="col-10 offset-1">

                <span class="homepage-text-after-images">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet exercitationem fugiat laborum
                    libero quas reiciendis sequi tempora totam veniam voluptatem.
                     Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque illum ipsam perspiciatis possimus
                     ratione, reiciendis sit tenetur ut veritatis vitae!
                     Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam corporis cupiditate doloribus
                    dolorum eius enim impedit labore placeat sit voluptates.</span>

            </div>

        </div>

    </div>

@endsection
