<template>
    <div class="chat-main-block">
        <div class="container-fluid chat-header" v-on:click="hideShowChatBody">
            <div class="row">
                <div class="col-10 ">
                    <p class="chat-header-text">Напишите нам, мы в онлайн!! </p>
                </div>
            </div>
        </div>

        <div class="chat-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 vue-chat-content">
                        <div v-for="comment in comments"
                             v-bind:class="[ comment.is_user_admin === null ? chatMessage : chatIncomingMessage]">
                            <div class="chat-message-content-block">
                                <div class="chat-message-data-block">
                                    <span class="chat-message-data-block-text">{{
                                            formatData(comment.created_at)
                                        }}</span>
                                </div>
                                <div class="chat-message-content-block">
                                    <span class="chat-message-content-block-username">{{
                                            putAdminName(comment.is_user_admin)
                                        }}</span>
                                    <span class="chat-message-content-block-text">{{ comment.message }}</span>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid chat-form">
                <div class="row">
                    <div class="col-12">
                        <form class="form">
                        <textarea id="vue-input_message" class="chat-input" rows="5" placeholder="Введите сообщение"
                                  :data-user-id="user_id"
                                  :data-user-name="user_name"
                                  name="chat_message"
                                  v-on:keypress="sendMessageClickEnter"
                        ></textarea>
                            <button class="chat-submit" v-on:click="sendMessageClick">
                                &#8657;
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "test",
    data() {
        return {
            chatMessage: "chat-message",
            chatIncomingMessage: "chat-incoming-message",
            comments: [],
            user_id: $('body').attr('data-user-id'),
            user_name: $('body').attr('data-user-name'),
            token: $('meta[name=csrf-token]').attr('content')
        }
    },
    methods: {
        getComments() {
            axios.get('/api/getComments/' + this.user_id)
                .then((response) => {

                    this.comments = response.data.comments;
                });
        },
        formatData(data) {
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
        },
        putAdminName(admin) {
            let name = '';
            if (admin !== null) {
                name = 'Admin';
            } else {
                name = '';
            }
            return name;
        },
        sendMessageClickEnter(e) {
            let key = e.which;
            if (key === 13) {
                this.sendMessage();
            }
        },
        sendMessageClick(event) {
            event.preventDefault();
            this.sendMessage()
        },
        sendMessage() {
            let message = $('#vue-input_message').val();
            let user_id = this.user_id;
            let username = this.user_name;
            let is_user_admin = null;
            let created_at = new Date();
            $('#vue-input_message').val('')

            axios.post(`http://app.lock/api/message`, {
                message: message,
                user_id: user_id,
                username: username,
                is_user_admin: is_user_admin,
            }).then((response) => {

                this.comments.unshift({
                    'is_user_admin' : is_user_admin,
                    'created_at' : created_at,
                    'message' : message,
                    'user_id' : user_id,
                    'username' : username
                });

            }).catch((error) => {
                console.log(error);
            });
        },
        hideShowChatBody(){
            $('.chat-body').toggle('slow');
        }
    },
    mounted() {
        $('.chat-body').hide();
        this.getComments();

        window.Echo.private('chat.' + this.user_id)
            .listen('ChatMessage', (response) => {
                this.comments.unshift(response);
            });
    }
}
</script>

<style scoped>
.chat-main-block {
    position: fixed;
    bottom: 0;
    left: 75%;
    width: 22%;
    z-index: 10000;
    /*border: solid 1px #238443;*/
    border-radius: 10px 30px 0px 0px;
    background: white;
}

.vue-chat-content {
    padding-top: 10px;
    width: 100%;
    min-height: 300px;
    max-height: 300px;
    background: white;
    border-left: solid 1px #238443;
    border-right: solid 1px #238443;
    border-bottom: dotted 1px gray;
    overflow: auto;
}
</style>
