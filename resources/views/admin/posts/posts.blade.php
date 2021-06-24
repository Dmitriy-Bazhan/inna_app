@extends('admin.layouts.admin-layout')

@section('content')

    <H1>Posts(Публикации)</H1>

    <div class="container-fluid">

        <div class="row">

            <div class="col-3 offset-9">

                <a href="{{ url('admin/posts/create') }}"><button class="btn btn-success">Создать новый пост</button></a>

            </div>

        </div>


    </div>


@endsection
