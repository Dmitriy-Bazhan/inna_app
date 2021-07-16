$(document).ready(function () {

    $('.chat-body').hide();

    $('.chat-header').click(function () {
        $('.chat-body').toggle('slow');
    });

    Echo.channel('chat')
        .listen('ChatMessage', function (e) {
            let date = new Date();
            let timestamp = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
            var html = '<div class="chat-incoming-message">' +
                '<div class="div_date_message"><span class="date_message">' + timestamp + '</span></div>' +
                '<div class="message_div1">' +
                '<span class="span_message_vue">' + e.message + '</span>' +
                '</div><div class="warning_in_chat">' +
                // '<span data-id="'+ e.id + '" class="oi oi-warning"></span>' +
                '</div><br></div>';

            // console.log('ECHO WORK');
            // console.log(e.message);

            $('.chat-content').append(html);
        });

    $('#send_chat_message').click(function (event) {
        event.preventDefault();

        let message = $('#input_message').val();
        let id = $('#input_message').attr('data-id');
        $('#input_message').val(null);

        axios.post(`http://app.lock/api/message`, {
            // user: this.userId,
            message: message,
            id: id,
        }).then((response) => {
            console.log('Message written');

            let date = new Date();
            let timestamp = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
            var html = '<div class="chat-message">' +
                '<div class="div_date_message"><span class="date_message">' + timestamp + '</span></div>' +
                '<div class="message_div1">' +
                '<span class="span_message_vue">' + message + '</span>' +
                '</div><div class="warning_in_chat">' +
                // '<span data-id="'+ e.id + '" class="oi oi-warning"></span>' +
                '</div><br></div>';

            $('.chat-content').append(html);

        }, (error) => {
            console.log(error);
        });


        // $.ajax({
        //     method: 'post',
        //     url: 'api/message',
        //     // dataType: 'json',
        //     data: {
        //         _token: $(this).data('token'),
        //         message: data,
        //     },
        //     success: function (data) {
        //         console.log('Message written');
        //     },
        //     error: function (errorThrown) {
        //         console.log('ERROR');
        //         console.log(errorThrown);
        //     }
        // });
    });


});
