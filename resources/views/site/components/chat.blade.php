<div class="chat-main-block">

    <div class="container-fluid chat-header">

        <div class="row">

            <div class="col-10 ">

                <p class="chat-header-text">Напишите нам, мы в онлайн!! </p>

            </div>

        </div>

    </div>

    <div class="chat-body">

        <div class="container-fluid">

            <div class="row">

                <div class="col-12 chat-content">

                </div>

            </div>

        </div>

        <div class="container-fluid chat-form">

            <div class="row">

                <div class="col-12">

                    <form class="form">

                        <textarea id="input_message" class="chat-input" rows="5" placeholder="Введите сообщение"
                                  data-user-id=" {{ Auth::user()->id }}"
                                  data-user-name=" {{ Auth::user()->name }}"
                                  name="chat_message"></textarea>

                        <button class="chat-submit" id="send_chat_message" data-token="{{ csrf_token() }}">
                            &#8657;
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <script>

        $(document).ready(function () {
            // $('.chat-body').hide();

            $('.chat-header').click(function () {
                $('.chat-body').toggle('slow');
            });

            Echo.private('chat.' + {{ Auth::user()->id }})
                .listen('ChatMessage', function (e) {
                    let date = new Date();
                    const month = date.toLocaleString('default', {month: 'long'});
                    let timestamp = ucFirst(month) + ' ' + date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes();
                    var html = '<div class="chat-incoming-message">' +
                        '<div class="chat-message-data-block">' +
                        '<span class="chat-message-data-block-text">' + timestamp + '</span></div>' +
                        '<div class="chat-message-content-block">' +
                        '<span class="chat-message-content-block-username">' + e.username + ': ' + '</span>' +
                        '<span class="chat-message-content-block-text">' + e.message + '</span>' +
                        '</div><div class="warning_in_chat">' +
                        '</div><br></div>';

                    $('.chat-content').prepend(html);
                });


            $('#send_chat_message').click(function (event) {
                event.preventDefault();

                let message = $('#input_message').val();
                let user_id = $('#input_message').attr('data-user-id');
                let username = $('#input_message').attr('data-user-name');
                $('#input_message').val(null);

                axios.post(`http://app.lock/api/message`, {
                    message: message,
                    user_id: user_id,
                    username: username
                }).then((response) => {
                    // console.log('Message written');
                    // console.log(response);

                    let date = new Date();
                    const month = date.toLocaleString('default', {month: 'long'});
                    let timestamp = ucFirst(month) + ' ' + date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes();
                    var html = '<div class="chat-message">' +
                        '<div class="chat-message-data-block">' +
                        '<span class="chat-message-data-block-text">' + timestamp + '</span></div>' +
                        '<div class="chat-message-content-block">' +
                        '<span class="chat-message-content-block-text">' + message + '</span>' +
                        '</div><div class="warning_in_chat">' +
                        // '<span data-id="'+ e.id + '" class="oi oi-warning"></span>' +
                        '</div><br></div>';

                    $('.chat-content').prepend(html);

                }).catch((error) => {
                    console.log(error);
                });
            });

            function ucFirst(str) {
                if (!str) return str;

                return str[0].toUpperCase() + str.slice(1);
            }
        });

    </script>

</div>

