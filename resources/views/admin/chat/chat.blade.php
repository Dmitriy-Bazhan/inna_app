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

                            <div class="col-2 user-id-block">

                                <span class="chat-row-with-user-info-text">{{ $comment->user->id }}</span>

                            </div>

                            <div class="col-2">

                                <span class="chat-row-with-user-info-text">{{ $comment->user->name }}</span>

                            </div>

                            <div class="col-3 offset-3 block-with-open-chat">

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


                                                let element = '.modal-chat-with-current-user[data-user-id=' + {{ $comment->user->id }} +']';

                                                let date = new Date();
                                                const month = date.toLocaleString('default', {month: 'long'});
                                                let timestamp = ucFirst(month) + ' ' + date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes();
                                                let html = '<div class="chat-incoming-message">' +
                                                    '<div class="chat-message-data-block">' +
                                                    '<span class="chat-message-data-block-text">' + timestamp + '</span></div>' +
                                                    '<div class="chat-message-content-block">' +
                                                    '<span class="chat-message-content-block-username">' + e.username + ': ' + '</span>' +
                                                    '<span class="chat-message-content-block-text">' + e.message + '</span>' +
                                                    '</div><div class="warning_in_chat">' +
                                                    '</div><br></div>';

                                                let signal = 'Открыть чат<span class="new-incoming-message-on-button-signal">New</span>';
                                                $('.block-with-open-chat > .open-chat[data-user-id=' + e.user_id + ']').html(signal);

                                                let button_complete = '<button data-user-id="' + e.user_id + '" class="btn btn-success close-problem">' +
                                                    'Сделано</button>';
                                                $('.close-problem-block[data-user-id=' + e.user_id + ']').html(button_complete);

                                                $('.new-incoming-message').show('slow');
                                                $(element).children('.modal-chat-content-block').prepend(html);
                                            });

                                        function ucFirst(str) {
                                            if (!str) return str;
                                            return str[0].toUpperCase() + str.slice(1);
                                        }
                                    });
                                </script>

                            </div>

                            <div data-user-id="{{ $comment->user->id }}" class="col-2 close-problem-block">

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

                            <div class="modal-chat-content-block">


                            </div>

                            <div class="container-fluid modal-chat-form">

                                <div class="row">

                                    <div class="col-12">

                                        <form class="form">

                        <textarea class="modal-chat-input admin-input_message" rows="5" placeholder="Введите сообщение"
                                  data-user-id=" {{ $comment->user->id }}"
                                  data-user-name=" {{ $comment->user->name }}"
                                  name="chat_message"></textarea>

                                            <button class="modal-chat-submit admin-send-chat-message"
                                                    data-token="{{ csrf_token() }}">
                                                &#8657;
                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                @endif

            </div>

        </div>

    </div>

    <script>
        $(document).ready(function () {
            $('.modal-chat-with-current-user').hide();

            $(document).on('click', '.open-chat', function (event) {
                event.preventDefault();
                let user_id = $(this).attr('data-user-id');
                let block = '.modal-chat-with-current-user[data-user-id=' + user_id + ']';
                $(block).children('.modal-chat-content-block').html('');

                $.ajax({
                    method: 'post',
                    url: 'add_messages_to_modal_chat',
                    dataType: 'json',
                    data: {
                        user_id: user_id,
                        _token: $('meta[name=csrf-token]').attr('content'),
                    },
                    success: function (data) {
                        data.response.forEach(function (index) {
                            if (index.is_user_admin == null) {
                                console.log(index.user.name);
                                let element = '.modal-chat-with-current-user[data-user-id=' + user_id + ']';

                                let date = new Date();
                                const month = date.toLocaleString('default', {month: 'long'});
                                let timestamp = ucFirst(month) + ' ' + date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes();
                                let html = '<div class="chat-incoming-message">' +
                                    '<div class="chat-message-data-block">' +
                                    '<span class="chat-message-data-block-text">' + timestamp + '</span></div>' +
                                    '<div class="chat-message-content-block">' +
                                    '<span class="chat-message-content-block-username">' + index.user.name + ': ' + '</span>' +
                                    '<span class="chat-message-content-block-text">' + index.message + '</span>' +
                                    '</div><div class="warning_in_chat">' +
                                    '</div><br></div>';

                                $(element).children('.modal-chat-content-block').prepend(html);
                            } else {
                                let element = '.modal-chat-with-current-user[data-user-id=' + user_id + ']';
                                let date = new Date();
                                const month = date.toLocaleString('default', {month: 'long'});
                                let timestamp = ucFirst(month) + ' ' + date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes();
                                let html = '<div class="chat-message">' +
                                    '<div class="chat-message-data-block">' +
                                    '<span class="chat-message-data-block-text">' + timestamp + '</span></div>' +
                                    '<div class="chat-message-content-block">' +
                                    '<span class="chat-message-content-block-text">' + index.message + '</span>' +
                                    '</div><div class="warning_in_chat">' +
                                    '</div><br></div>';

                                $(element).children('.modal-chat-content-block').prepend(html);
                            }
                        });

                    },
                    error: function (errorThrown) {
                        console.log(errorThrown);
                    }
                });

                function ucFirst(str) {
                    if (!str) return str;
                    return str[0].toUpperCase() + str.slice(1);
                }

                $(block).show('slow');
            });

            $(document).on('click', '.close-modal-chat', function () {
                $(this).parent().children('.modal-chat-content-block').html('');
                $('.modal-chat-with-current-user').hide();
            });

            $(document).on('click', '.close-problem', function (event) {
                event.preventDefault();
                let user_id = $(this).attr('data-user-id');
                let signal = $(this).parent().parent().children('.block-with-open-chat').children('.open-chat').children('.new-incoming-message-on-button-signal');
                let button_complete = $(this);

                $.ajax({
                    method: 'post',
                    url: 'admin_close_the_problems',
                    dataType: 'json',
                    data: {
                        user_id: user_id,
                        _token: $('meta[name=csrf-token]').attr('content'),
                    },
                    success: function (data) {
                        console.log('GOOD WORK' + data.response);
                        signal.remove();
                        button_complete.remove();
                    },
                    error: function (errorThrown) {
                        console.log(errorThrown);
                    }
                });
            });

            $(document).on('click', '.admin-send-chat-message', function (event) {
                event.preventDefault();

                let message = $(this).parent().children('.admin-input_message').val();
                let user_id = $(this).parent().children('.admin-input_message').attr('data-user-id');
                let username = $(this).parent().children('.admin-input_message').attr('data-user-name');
                let admin_id = $('body').attr('data-admin-id');
                $('.admin-input_message').val(null);

                axios.post(`http://app.lock/api/admin_send_message`, {
                    message: message,
                    user_id: user_id,
                    admin_id: admin_id,
                    username: username
                }).then((response) => {
                    let element = '.modal-chat-with-current-user[data-user-id=' + user_id + ']';
                    let date = new Date();
                    const month = date.toLocaleString('default', {month: 'long'});
                    let timestamp = ucFirst(month) + ' ' + date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes();
                    let html = '<div class="chat-message">' +
                        '<div class="chat-message-data-block">' +
                        '<span class="chat-message-data-block-text">' + timestamp + '</span></div>' +
                        '<div class="chat-message-content-block">' +
                        '<span class="chat-message-content-block-text">' + message + '</span>' +
                        '</div><div class="warning_in_chat">' +
                        '</div><br></div>';

                    $(element).children('.modal-chat-content-block').prepend(html);

                }).catch((error) => {
                    console.log(error);
                });

                function ucFirst(str) {
                    if (!str) return str;
                    return str[0].toUpperCase() + str.slice(1);
                }
            });
        });
    </script>

@endsection
