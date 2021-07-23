@extends('admin.layouts.admin-layout')

@section('content')

    <h1>Чат</h1>

    <div class="chat-listing">

    </div>

    @if(isset($comments) && !is_null($comments))

        @foreach($comments as $comment)

            <h1>{{ $comment->status }}</h1>

        @endforeach

    @endif

@endsection
