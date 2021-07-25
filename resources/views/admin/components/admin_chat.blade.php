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

            (function checkNewMessagesAjax() {
                $.ajax({
                    method: 'post',
                    url: 'check_has_new_message',
                    dataType: 'json',
                    data: {
                        _token: $('meta[name=csrf-token]').attr('content'),
                    },
                    success: function (data) {
                        if (data.response === 'has') {
                            $('.new-incoming-message').show('slow');
                        } else {
                            $('.new-incoming-message').hide();
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
                    let hasCurrentUserRow =
                        $('.chat-row-with-user-info').children('.block-with-open-chat').children('.open-chat').attr('data-user-id');

                    console.log(e.user_id);
                    console.log(hasCurrentUserRow);

                    if (hasCurrentUserRow == undefined || hasCurrentUserRow != e.user_id) {
                        $.ajax({
                            method: 'post',
                            url: 'add_row_to_chats_list',
                            dataType: 'json',
                            data: {
                                user_id: e.user_id,
                                _token: $('meta[name=csrf-token]').attr('content'),
                            },
                            success: function (data) {
                                $('.chat-row-with-title-of-cols').after(data.response);
                                $('.modal-chat-with-current-user').hide();
                            },
                            error: function (errorThrown) {
                                console.log(errorThrown);
                            }
                        });
                    }

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

                    $('.new-incoming-message').show('slow');
                    $('.chat-content').prepend(html);


                });

            function ucFirst(str) {
                if (!str) return str;

                return str[0].toUpperCase() + str.slice(1);
            }

        });

    </script>

</div>
