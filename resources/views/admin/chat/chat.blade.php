@extends('admin.layouts.admin-layout')

@section('content')

    <h1>Чат</h1>

    <div class="chat-listing">

    </div>

    <div class="container-fluid">

        <div class="row">

            <div class="col-8">

                <div class="row chat-row-with-title-of-cols">

                    <div class="col-2"><span class="chat-row-with-title-text">User ID</span></div>

                    <div class="col-2"><span class="chat-row-with-title-text">User name</span></div>

                </div>

                @if(isset($comments) && !is_null($comments))

                    @foreach($comments as $comment)

                        <div class="row chat-row-with-user-info">

                            <div class="col-2">

                                <span class="chat-row-with-user-info-text">{{ $comment->user->id }}</span>

                            </div>

                            <div class="col-2">

                                <span class="chat-row-with-user-info-text">{{ $comment->user->name }}</span>

                            </div>

                            <div class="col-3 offset-3">

                                <button data-user-id="{{ $comment->user->id }}" class="btn btn-success open-chat">
                                    Открыть чат

                                    @if($comment->status == 'not_answered')

                                        <span class="new-incoming-message-on-button-signal">New</span>

                                    @endif

                                </button>

                                <script>
                                    $(document).ready(function () {
                                        Echo.private('chat.' + {{ $comment->user->id }})
                                            .listen('ChatMessage', function (e) {
                                                let element = '.modal-chat-with-current-user[data-user-id=' + {{ $comment->user->id }} +'] > p';
                                                let span = '<span>' + e.username + ': ' + e.message + '</span>'
                                                $(element).html(span);
                                            });
                                    });
                                </script>

                            </div>

                            <div class="col-2">

                                @if($comment->status == 'not_answered')

                                    <button data-user-id="{{ $comment->user->id }}"
                                            class="btn btn-success close-problem">
                                        Сделано
                                    </button>

                                @endif

                            </div>

                        </div>

                        <div class="modal-chat-with-current-user" data-user-id="{{ $comment->user->id }}">

                            <button class="btn btn-success close-modal-chat">x</button>

                            <p class="modal-chat-text"></p>

                        </div>

                    @endforeach

                @endif

            </div>

        </div>

    </div>

    <script>
        $(document).ready(function () {
            $('.modal-chat-with-current-user').hide();

            $(document).on('click','.open-chat',function (event) {
                event.preventDefault();
                let user_id = $(this).attr('data-user-id');
                let block = '.modal-chat-with-current-user[data-user-id=' + user_id + ']';
                $(block).show('slow');
            });

            $('.close-modal-chat').click(function () {
                $('.modal-chat-with-current-user').hide();
            });

            $(document).on('click', '.close-problem', function (event) {
                event.preventDefault();
                let user_id = $(this).attr('data-user-id');
                alert('Hi id ' + user_id);

                //Сделать здесь аякс который меняет для данного user_id статусы всех комментариев на answered
                //метод в ChatController completeChat
            });
        });
    </script>

@endsection
