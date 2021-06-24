@extends('admin.layouts.admin-layout')

@section('content')

    <H1>Posts</H1>

    <button><a href="{{ url('admin/posts/create') }}">Создать новый пост</a></button>

@endsection
