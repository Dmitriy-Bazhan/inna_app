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
                                  data-id = {{ \Illuminate\Support\Facades\Auth::id() }}
                                   name="chat_message"></textarea>

                        <button class="chat-submit" id="send_chat_message" data-token="{{ csrf_token() }}">
                            &#8657;
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

