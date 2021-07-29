$(document).ready(function () {
    $('.chat-body').hide();

    (function () {
        let user_id = $('body').attr('data-user-id');

        $.ajax({
            method: 'post',
            url: 'add_messages_to_chat',
            dataType: 'json',
            data: {
                user_id: user_id,
                _token: $('meta[name=csrf-token]').attr('content'),
            },
            success: function (data) {
                data.response.forEach(function (index) {
                    if (index.is_user_admin == null) {

                        let date = new Date();
                        const month = date.toLocaleString('default', {month: 'long'});
                        let timestamp = ucFirst(month) + ' ' + date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes();
                        let html = '<div class="chat-message">' +
                            '<div class="chat-message-data-block">' +
                            '<span class="chat-message-data-block-text">' + timestamp + '</span></div>' +
                            '<div class="chat-message-content-block">' +
                            // '<span class="chat-message-content-block-username">' + index.user.name + ': ' + '</span>' +
                            '<span class="chat-message-content-block-text">' + index.message + '</span>' +
                            '</div><div class="warning_in_chat">' +
                            '</div><br></div>';

                        $('.chat-content').prepend(html);
                    } else {

                        let date = new Date();
                        const month = date.toLocaleString('default', {month: 'long'});
                        let timestamp = ucFirst(month) + ' ' + date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes();
                        let html = '<div class="chat-incoming-message">' +
                            '<div class="chat-message-data-block">' +
                            '<span class="chat-message-data-block-text">' + timestamp + '</span></div>' +
                            '<div class="chat-message-content-block">' +
                            '<span class="chat-message-content-block-username">' + 'Admin: ' + '</span>' +
                            '<span class="chat-message-content-block-text">' + index.message + '</span>' +
                            '</div><div class="warning_in_chat">' +
                            '</div><br></div>';

                        $('.chat-content').prepend(html);
                    }
                });

            },
            error: function (errorThrown) {
                console.log(errorThrown);
            }
        });
    })();

    $('.chat-header').click(function () {
        $('.chat-body').toggle('slow');
    });

    $('#input_message').keypress(function (e) {
        let key = e.which;
        if (key === 13) {
            sendMessage();
        }
    });

    $('#send_chat_message').click(function (event) {
        event.preventDefault();
        sendMessage();
    });

    function sendMessage() {
        let message = $('#input_message').val();
        let user_id = $('#input_message').attr('data-user-id');
        let username = $('#input_message').attr('data-user-name');
        $('#input_message').val(null);

        axios.post(`http://app.lock/api/message`, {
            message: message,
            user_id: user_id,
            username: username
        }).then((response) => {
            let date = new Date();
            const month = date.toLocaleString('default', {month: 'long'});
            let timestamp = ucFirst(month) + ' ' + date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes();
            var html = '<div class="chat-message">' +
                '<div class="chat-message-data-block">' +
                '<span class="chat-message-data-block-text">' + timestamp + '</span></div>' +
                '<div class="chat-message-content-block">' +
                '<span class="chat-message-content-block-text">' + message + '</span>' +
                '</div><div class="warning_in_chat">' +
                '</div><br></div>';

            $('.chat-content').prepend(html);

        }).catch((error) => {
            console.log(error);
        });
    }

    function ucFirst(str) {
        if (!str) return str;

        return str[0].toUpperCase() + str.slice(1);
    }


});
