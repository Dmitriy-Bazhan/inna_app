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

            <div class="col-1">

                <a href="{{ url('admin/posts') }}">
                    <button class="btn btn-danger">Отмена</button>
                </a>

            </div>

        </div>

    </div>

    <br>

    @if($errors->count() > 0)

        <div class="contaimer-fluid">

            <div class="row">

                <div class="col-8 offset-2">

                    <span style="color: red; font-size: 14px;font-weight: 600;">Не все поля заполнены или заполнены неправильно. Проверьте поля для русского языка.</span>

                </div>

            </div>

        </div>

    @endif

    <div class="container-fluid">

        <form class="my-form form-group" method="POST" enctype="multipart/form-data"
              action="@if(isset($post)){{ url('admin/posts/' . $post->id) }}@else{{ url('admin/posts') }}@endif">

            @csrf

            @if(isset($post))

                {{ method_field('PUT') }}

            @endif

            <span style="color:blue;font-size: 12px;font-weight: 500;">
                Кнопки переключения между украинским и русским вариантами статьи
            </span>
            <br>

            <button class="change_lang" data-lang="ua">Описание на украинском</button>
            <button class="change_lang" data-lang="ru">Описание на русском</button>
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

                                @if($errors->has('title.'. $lang))

                                    @error('title.'. $lang)

                                    <input type="text" name="title[{{ $lang }}]" value="{{ old('title.' . $lang) }}"
                                           class="form-control input_in_admin"
                                           style="border: solid 1px red">

                                    @enderror

                                @elseif(isset($post->data[$key]->title))

                                    <input type="text" name="title[{{ $lang }}]" class="form-control input_in_admin"
                                           value="{{ $post->data[$key]->title }}">

                                @else

                                    <input type="text" name="title[{{ $lang }}]" class="form-control input_in_admin"
                                           value="{{ old('title.' . $lang) }}">

                                @endif


                            </div>

                        </div>

                    </div>

                    {{-- Description --}}
                    <div class="form-group">

                        <div class="row">

                            <div class="col-12">

                                <div class="col-3">
                                    <label class="control-label">Краткое описание {{ mb_strtoupper($lang) }} (максимум
                                        400 символов): </label>
                                </div>

                                @if($errors->has('short_description.'. $lang))

                                    @error('short_description.'. $lang)

                                    <textarea class="form-control input_in_admin" rows="4" maxlength="400"
                                              name="short_description[{{$lang}}]"
                                              style="border: solid 1px red">{{ old('short_description.'. $lang) }}</textarea>

                                    @enderror

                                @elseif(isset($post->data[$key]->short_description))

                                    <textarea class="form-control input_in_admin" rows="4" maxlength="400"
                                              name="short_description[{{$lang}}]">{{ $post->data[$key]->short_description }}</textarea>

                                @else

                                    <textarea class="form-control input_in_admin" rows="4" maxlength="400"
                                              name="short_description[{{$lang}}]">{{ old('short_description.'. $lang) }}</textarea>

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

                                @if($errors->has('content.'. $lang))

                                    @error('content.'. $lang)

                                    <textarea name="content[{{$lang}}]" rows="7" class="form-control input_in_admin"
                                              style="border: solid 1px red">{{ old('content.'. $lang) }}</textarea>

                                    @enderror

                                @elseif(isset($post->data[$key]->content))

                                    <textarea rows="7" class="form-control input_in_admin"
                                              name="content[{{$lang}}]">{{ $post->data[$key]->content }}</textarea>

                                @else

                                    <textarea rows="7" class="form-control input_in_admin"
                                              name="content[{{$lang}}]">{{ old('content.'. $lang) }}</textarea>

                                @endif


                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

            {{-- Images --}}
            <div class="row">

                <div class="col-6">

                    <span class="control-label">Большая картинка</span>

                </div>

                <div class="col-6">

                    <span class="control-label">Маленькая картинка</span><br>

                </div>

            </div>
            <br>

            <div class="row">

                <div class="col-lg-6">

                    <div class="form-group">

                        <div class="col-6 offset-3" id="list_big_image">
                            @if(isset($post->image_big) && file_exists('storage/image_big/' . $post->image_big))
                                <img class="admin_image_big"
                                     src="{{ asset('storage/image_big/' . $post->image_big) }}">
                            @else
                                <img class="admin_image_big"
                                     src="{{ asset('/images/ava/no-img.png') }}">
                            @endif
                        </div>

                        <br>

                        <div class="col-8 offset-2">
                            <label class="custom-file-label" for="customFile">Выберите фаил</label>
                            <input type="file" id="input-big-image"
                                   class="form-control input_in_admin custom-file-input"
                                   name="imageBig">
                        </div>

                    </div>

                </div>

                <div class="col-6">

                    <div class="form-group">

                        <div class="col-6 offset-3" id="list_small_image">
                            @if(isset($post->image_small) && file_exists('storage/image_small/' . $post->image_small))
                                <img class="admin_image_small"
                                     src="{{ asset('storage/image_small/' . $post->image_small) }}">
                            @else
                                <img class="admin_image_small"
                                     src="{{ asset('/images/ava/no-img.png') }}">
                            @endif
                        </div>

                        <br>

                        <div class="col-8 offset-2">
                            <label class="custom-file-label" for="customFile">Выберите фаил</label>
                            <input type="file" id="input-small-image"
                                   class="form-control input_in_admin custom-file-input"
                                   name="imageSmall">
                        </div>

                    </div>

                </div>

            </div>

        </form>


    </div>

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

            <div class="col-1">

                <a href="{{ url('admin/posts') }}">
                    <button class="btn btn-danger">Отмена</button>
                </a>

            </div>

        </div>

    </div>

    <script>
        $('.change_lang[data-lang="ua"]').css('background', 'lightgreen');
        $('.change_lang[data-lang="ru"]').css('background', 'lightgray');
        $('#ru').hide();
        $('#ua').show();
        $('.change_lang').click(function (event) {
            $('.change_lang').css('background', 'lightgray');
            $(this).css('background', 'lightgreen');
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

        document.querySelector("#input-small-image").addEventListener("change", handleFileSelect, false);
        document.querySelector("#input-big-image").addEventListener("change", handleFileSelect, false);

        //Предпросмотр изображения
        function handleFileSelect(evt) {
            let files = evt.target.files; // Объект списка файлов
            let list = $(this).parent().parent().children('div').attr('id');
            let removeClass = $(this).parent().parent().children().children('img').attr('class');
            // Прокрутите список файлов и визуализируйте файлы изображений в виде эскизов.
            for (let i = 0, f; f = files[i]; i++) {

                //  обрабатывать только файлы изображений.
                if (!f.type.match('image.*')) {
                    continue;
                }

                var reader = new FileReader();

                // Закрытие для сбора информации о файле.
                reader.onload = (function (theFile) {
                    return function (e) {
                        // Визуализировать миниатюру.
                        $('.' + removeClass).remove();
                        $('img[data-id=' + list + ']').remove();
                        let span = document.createElement('span');
                        span.innerHTML = ['<img class="thumb" data-id="' + list + '" src="', e.target.result,
                            '" title="', theFile.name, '"/>'].join('');
                        document.getElementById(list).append(span);
                    };
                })(f);

                // Прочитать файл изображения как URL-адрес данных.
                reader.readAsDataURL(f);
            }
        }
    </script>

@endsection
