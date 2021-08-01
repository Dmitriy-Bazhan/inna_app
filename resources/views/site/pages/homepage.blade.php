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
                            <span
                                class="next-post-text">{{ mb_substr($post->data[0]->short_description, 0, 400) }}</span>

                        </div>

                    @endif

                @endforeach

            @else

                <div class="col-11 offset-1">

                    <img class="homepage-box-first-image"
                         src="{{ asset('images/ava/no-img.png') }}">

                </div>

            @endif

        </div>

    </div>

@endsection
