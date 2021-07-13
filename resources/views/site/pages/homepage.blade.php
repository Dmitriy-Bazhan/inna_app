@extends('site.layouts.layout')

@section('content')

    <div class="container-fluid">

        <div class="row homepage-big-block-post">

            <h1>MEMORY {{ $memory }}</h1>

            @if(isset($posts) && $posts->count() > 0)

                @foreach($posts as $post)

                    @if($loop->iteration == 1)

                        <div class="col-11 offset-1">

                            <h4><span>{{ mb_substr($post->created_at, 0 , -8) }}</span> : {{ $post->data[0]->title }}
                            </h4>

                            <span class="homepage-text-before-first-images">

                                @if(isset($post->image_big) && file_exists('storage/image_big/' . $post->image_big))
                                    <img class="homepage-box-first-image"
                                         src="{{ asset('storage/image_big/' . $post->image_big. '?' . rand(0,100)) }}">
                                    {{ mb_substr($post->data[0]->short_description, 0, 400) }}
                                @else
                                    <img class="homepage-box-first-image"
                                         src="{{ asset('/images/ava/no-photo.webp') }}">
                                    {{ mb_substr($post->data[0]->short_description, 0, 400) }}
                                @endif
                            </span>

                        </div>

                    @else

                        <div class="col-3 offset-1 homepage-small-block-post">


                            @if(isset($post->image_big) && file_exists('storage/image_big/' . $post->image_big))
                                <img class="homepage-box-image"
                                     src="{{ asset('storage/image_big/' . $post->image_big . '?' . rand(0,100)) }}">
                            @else
                                <img class="homepage-box-image"
                                     src="{{ asset('/images/ava/no-photo.webp') }}">
                            @endif

                            <h4><span>{{ mb_substr($post->created_at, 0 , -8) }}</span> : {{ $post->data[0]->title }}
                            </h4>
                            <br>
                            <span class="next-post-text">{{ mb_substr($post->data[0]->short_description, 0, 400) }}</span>

                        </div>

                    @endif

                @endforeach

        </div>

        @endif

        {{--        <div class="row">--}}

        {{--            <div class="col-10 offset-1">--}}

        {{--                <h2>Next</h2>--}}

        {{--                <span class="homepage-text-after-images">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet exercitationem fugiat laborum--}}
        {{--                    libero quas reiciendis sequi tempora totam veniam voluptatem.--}}
        {{--                     Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque illum ipsam perspiciatis possimus--}}
        {{--                     ratione, reiciendis sit tenetur ut veritatis vitae!--}}
        {{--                     Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam corporis cupiditate doloribus--}}
        {{--                    dolorum eius enim impedit labore placeat sit voluptates.</span>--}}

        {{--            </div>--}}

        {{--        </div>--}}

        {{--        <div class="row">--}}

        {{--            <div class="col-3 offset-1">--}}

        {{--                <img class="homepage-box-image" src="{{ asset('images/01.jpg') }}">--}}

        {{--            </div>--}}

        {{--            <div class="col-3 offset-1">--}}

        {{--                <img class="homepage-box-image" src="{{ asset('images/02.jpg') }}">--}}

        {{--            </div>--}}

        {{--            <div class="col-3 offset-1">--}}

        {{--                <img class="homepage-box-image" src="{{ asset('images/03.jpg') }}">--}}

        {{--            </div>--}}

        {{--        </div>--}}


    </div>

@endsection
