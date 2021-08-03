<div class="row chat-row-with-user-info">

    <div class="col-2 user-id-block">

        <span class="chat-row-with-user-info-text">{{ $user->id }}</span>

    </div>

    <div class="col-2">

        <span class="chat-row-with-user-info-text">{{ $user->name }}</span>

    </div>

    <div class="col-3 offset-3 block-with-open-chat">

        <button data-user-id="{{ $user->id }}" class="btn btn-success open-chat">
            Открыть чат

            <span class="new-incoming-message-on-button-signal">New</span>

        </button>

        <script>
            $(document).ready(function () {
                Echo.private('chat.' + {{ $user->id }})
                    .listen('ChatMessage', function (e) {
                        let element = '.modal-chat-with-current-user[data-user-id=' + {{ $user->id }} +']';
                        let html = '<div class="chat-incoming-message">' +
                            '<div class="chat-message-data-block">' +
                            '<span class="chat-message-data-block-text">' + formatData(e.created_at) + '</span></div>' +
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

                function formatData(data) {
                    let options = {
                        day: 'numeric',
                        month: 'long',
                        // year: 'numeric',
                        hour: 'numeric',
                        minute: 'numeric'
                    }

                    function getDate(str) {
                        let date = new Date(str);
                        return date.toLocaleString('ru', options)
                    }

                    return getDate(data);
                }
            });
        </script>

    </div>

    <div data-user-id="{{ $user->id }}" class="col-2 close-problem-block">


        <button data-user-id="{{ $user->id }}"
                class="btn btn-success close-problem">
            Сделано
        </button>


    </div>

</div>

<div class="modal-chat-with-current-user" data-user-id="{{ $user->id }}">

    <button class="btn btn-success close-modal-chat">x</button>

    <div class="modal-chat-content-block">


    </div>

    <div class="container-fluid modal-chat-form">

        <div class="row">

            <div class="col-12">

                <form class="form">

                        <textarea class="modal-chat-input admin-input_message" rows="5" placeholder="Введите сообщение"
                                  data-user-id=" {{ $user->id }}"
                                  data-user-name=" {{ $user->name }}"
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
