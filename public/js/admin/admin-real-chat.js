$(document).ready(function () {
    $('.chat-body').hide();
    $('.new-incoming-message').hide();

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
            let hasCurrentUserRow = document.getElementsByClassName('open-chat');

            let add_row = true;
            Array.from(hasCurrentUserRow).forEach(function (value, index, array){
                let check_user_id = value.getAttribute('data-user-id');
                if(check_user_id === e.user_id){
                    add_row = false;
                }
            });

            if (add_row) {
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

    });

    function ucFirst(str) {
        if (!str) return str;

        return str[0].toUpperCase() + str.slice(1);
    }

});
