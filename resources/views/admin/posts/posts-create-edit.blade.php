@extends('admin.layouts.admin-layout')

@section('content')

    @if(isset($post))

        <H1>Edit posts()</H1>

    @else

        <H1>Make new posts()</H1>

    @endif

    <div class="container-fluid">

        <div class="row">

            <div class="col-2 offset-8">

                @if(isset($post))

                    <button class="btn btn-info"
                            onclick="event.preventDefault();
                            $('.my-form').submit();">Изменить
                    </button>


                @else

                    <button class="btn btn-info"
                            onclick="event.preventDefault();
                            $('.my-form').submit();">Сохранить
                    </button>

                @endif

            </div>

            <div class="col-2">

                <a href="{{ url('admin/posts') }}">
                    <button class="btn btn-danger">Отмена</button>
                </a>

            </div>

        </div>

    </div>

    <br>

{{--    {{ dd($errors) }}--}}

    <div class="container-fluid">

        <form class="my-form form-group" method="POST" enctype="multipart/form-data"
              action="@if(isset($post)){{ url('admin/posts/' . $post->id) }}@else{{ url('admin/posts') }}@endif">

            @csrf

            @if(isset($post))

                {{ method_field('PUT') }}

            @endif

            {{-- Alias --}}
            <div class="form-group">

                <div class="row">

                    <div class="col-12">

                        <div class="col-1">
                            <label class="control-label">Алиас:</label>
                        </div>

                        @if($errors->has('alias'))

                            @error('alias')

                            <input type="text" name="alias" value="{{ old('alias') }}"
                                   class="form-control input_in_admin"
                                   style="border: solid 1px red">

                            @enderror

                        @elseif(isset($post->alias))

                            <input type="text" name="alias" class="form-control input_in_admin"
                                   value="{{ $post->alias }}">

                        @else

                            <input type="text" name="alias" class="form-control input_in_admin"
                                   value="{{ old('alias') }}">

                        @endif

                    </div>

                </div>

            </div>

            <button class="change_lang" data-lang="ua">UA</button>
            <button class="change_lang" data-lang="ru">RU</button>
            <br>
            <br>

            @php($langs = ['ua', 'ru'])

            @foreach($langs as $key => $lang)

                <div id="{{ $lang }}">

                    {{--  Title--}}

                    <div class="form-group">

                        <div class="row">

                            <div class="col-12">

                                <div class="col-3">
                                    <label class="control-label">Заголовок {{ mb_strtoupper($lang) }}: </label>
                                </div>

                                @if($errors->has('title.'. $key))

                                    @error('title.'. $key)

                                    <input type="text" name="title[{{ $key }}]" value="{{ old('title.' . $key) }}"
                                           class="form-control input_in_admin"
                                           style="border: solid 1px red">

                                    @enderror

                                @elseif(isset($post->data[$key]->title))

                                    <input type="text" name="title[{{ $key }}]" class="form-control input_in_admin"
                                           value="{{ $post->data[$key]->title }}">

                                @else

                                    <input type="text" name="title[{{ $key }}]" class="form-control input_in_admin"
                                           value="{{ old('title.' . $key) }}">

                                @endif


                            </div>

                        </div>

                    </div>

                    {{-- Content --}}
                    <div class="form-group">

                        <div class="row">

                            <div class="col-12">

                                <div class="col-3">
                                    <label class="control-label">Контент {{ mb_strtoupper($lang) }}: </label>
                                </div>

                                @if($errors->has('content.'. $key))

                                    @error('content.'. $key)

                                    <textarea name="content[{{$key}}]" rows="5" class="form-control input_in_admin"
                                              style="border: solid 1px red">{{ old('content.'. $key) }}</textarea>

                                    @enderror

                                @elseif(isset($post->data[$key]->content))

                                    <textarea rows="5" class="form-control input_in_admin"
                                              name="content[{{$key}}]">{{ $post->data[$key]->content }}</textarea>

                                @else

                                    <textarea rows="5" class="form-control input_in_admin"
                                              name="content[{{$key}}]">{{ old('content.'. $key) }}</textarea>

                                @endif


                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

            {{-- Images --}}
            <div class="row">
                <div class="col-lg-6">
                    <label class="col-lg-5 control-label">Большая картинка</label>

                    <div style="border:solid 2px white;">
                        <div class="form-group">
                            @if(isset($post->image_big) && file_exists('storage/image_big/' . $post->image_big))
                                <img class="admin_image_big"
                                     src="{{ asset('storage/image_big/' . $post->image_big) }}">
                            @else
                                <img class="admin_image_big"
                                     src="{{ asset('/images/ava/no-img.png') }}">
                            @endif
                            <div class="col-lg-12">
                                <input type="hidden"
                                       value="{{ !is_null($post->image_big) ? $post->image_big : '' }}"
                                       name="old_image_big">
                                <input type="file" class="form-control input_in_admin" name="imageBig">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div style="border:solid 2px white;">
                        <label class="col-lg-5 control-label">Маленькая картинка</label>
                        <div class="form-group">
                            @if(isset($post->image_small) && file_exists('storage/image_small/' . $post->image_small))
                                <img class="admin_image_big"
                                     src="{{ asset('storage/image_small/' . $post->image_small) }}">
                            @else
                                <img class="admin_image_big"
                                     src="{{ asset('/images/ava/no-img.png') }}">
                            @endif
                            <div class="col-lg-12">
                                <input type="hidden"
                                       value="{{ isset($post->image_small) ? $post->image_small : '' }}"
                                       name="old_image_small">
                                <input type="file" class="form-control input_in_admin" name="imageSmall">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>

    <script>
        $('.change_lang[data-lang="ua"]').css('background', 'lightblue');
        $('.change_lang[data-lang="ru"]').css('background', 'blue');
        $('#ru').hide();
        $('#ua').show();
        $('.change_lang').click(function (event) {
            $('.change_lang').css('background', 'blue');
            $(this).css('background', 'lightblue');
            event.preventDefault();
            var div = '#' + $(this).attr('data-lang');
            if (div == '#ru') {
                var div1 = '#ua';
            } else {
                var div1 = '#ru';
            }
            $(div).show();
            $(div1).hide();
        });
    </script>

@endsection
