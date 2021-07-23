<div class="chat-main-block">

    <div class="container-fluid chat-header">

        <div class="row">

            <div class="col-10 ">

                <p class="chat-header-text">Чат в реальном времени </p>

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

    </div>

    <script>

        $(document).ready(function () {
            $('.chat-body').hide();

            (function () {
                $.ajax({
                    method: 'post',
                    url: 'check_has_new_message',
                    dataType: 'json',
                    data: {
                        _token: $('meta[name=csrf-token]').attr('content'),
                    },
                    success: function (data) {
                        console.log(data.response);
                        if (data.response === 'has') {
                            $('.new-incoming-message').show('slow');
                        } else {
                            $('.new-incoming-message').hide('slow');
                        }
                    },
                    error: function (errorThrown) {
                        console.log(errorThrown);
                    }
                });
            }());

            $('.chat-header').click(function () {
                $('.chat-body').toggle('slow');
            });

            Echo.private('admin-channel')
                .listen('AdminListenMessage', function (e) {
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
                        // '<span data-id="'+ e.id + '" class="oi oi-warning"></span>' +
                        '</div><br></div>';

                    // console.log('ECHO WORK');
                    // console.log(e.username);
                    addChatToChatList(e.username, e.user_id);

                    $('.new-incoming-message').show('slow');
                    $('.chat-content').prepend(html);


                });

            function addChatToChatList(username, id) {
                let listItem =
                    '<div class="chat-list-item-block" data-user-id="' + id + '">' +
                    '<p>Пользователь ' + username + ' написал сообщение</p>' +
                    '<button>Открыть чат с ' + username + '</button>' +
                    '</div>';

                let block = '.chat-list-item-block[data-user-id=' + id + ']';
                let hasItem = $(block).attr('data-user-id');

                if (hasItem !== id) {
                    $('.chat-listing').prepend(listItem);
                }
            }

            function ucFirst(str) {
                if (!str) return str;

                return str[0].toUpperCase() + str.slice(1);
            }
        });

    </script>

</div>

