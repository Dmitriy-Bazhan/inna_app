@extends('admin.layouts.admin-layout')

@section('content')

    <H1>Статьи</H1>

    <div class="container-fluid">

        <div class="row">

            <div class="col-3 offset-9">

                <a href="{{ url('admin/posts/create') }}">
                    <button class="btn btn-success">Добавить новую статью</button>
                </a>

            </div>

        </div>

    </div>

    <br>

    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <table rules="all" cellpadding="15px" border="solid 1px black">

                    <th>Id</th>
                    <th>Alias</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Content</th>
                    <th>PhotoBig</th>
                    <th>PhotoSmall</th>
                    <th>Action</th>

                    @if($posts->count() > 0)

                        @foreach($posts as $post)

                            <tr>

                                <td>{{ $post->id }}</td>
                                <td>{{ $post->alias }}</td>
                                <td>{{ $post->data[0]->title }}</td>
                                <td>{{ mb_substr($post->data[0]->short_description, 0, 200) . '...' }}</td>
                                <td>{{ mb_substr($post->data[0]->content, 0, 200) . '...' }}</td>
                                @if(!is_null($post->image_big))

                                    <td><img class="" style="width: 75px; height: 75px;"
                                             src="{{ asset('storage/image_big/' . $post->image_big . '?' . rand(0,100)) }}">
                                    </td>

                                @else

                                    <td><img class="" style="width: 75px; height: 75px;"
                                             src="{{ asset('/images/ava/no-img.png') }}"></td>

                                @endif
                                @if(!is_null($post->image_small))

                                    <td><img class="" style="width: 75px; height: 75px;"
                                             src="{{ asset('storage/image_small/' . $post->image_small . '?' . rand(0,100)) }}">
                                    </td>

                                @else

                                    <td><img class="" style="width: 75px; height: 75px;"
                                             src="{{ asset('/images/ava/no-img.png') }}"></td>

                                @endif

                                <td>

                                    <a href="{{ url('admin/posts/' . $post->id . '/edit') }}">Изменить</a>

                                    <form method="POST" action="{{ url('admin/posts/' . $post->id) }}">

                                        @csrf

                                        {{ method_field('DELETE') }}

                                        <input class="remove-post" type="submit" value="Удалить">

                                    </form>

                                </td>

                            </tr>

                        @endforeach

                    @else
                        <tr>

                            <td colspan="4">Нет записей</td>

                        </tr>

                    @endif


                </table>


            </div>

        </div>

    </div>

    <br>

    <div class="container-fluid">

        <div class="row">

            <div class="col-4 offset-4">

                {{ $posts->links() }}

            </div>

        </div>

    </div>

    <script>
        $('.remove-post').click(function (event) {
            event.preventDefault();
            let agree = confirm('Вы уверены');
            if (agree) {
                $(this).parent().submit();

            }

        });
    </script>

@endsection
