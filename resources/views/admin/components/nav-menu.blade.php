<ul class="list-group admin-nav-menu-list">
    <li class="list-group-item admin-nav-menu-list-item">
        <a class="admin-nav-menu-list-item-link"
           id="chat-link"
           href="{{ url('admin/chat') }}">
            <span>Чаты</span>
            <span class="new-incoming-message">New</span>
        </a>
    </li>
    <li class="list-group-item  admin-nav-menu-list-item"><a class="admin-nav-menu-list-item-link" href=" {{ route('admin.users') }}">Пользователи</a>
    </li>
    <li class="list-group-item"><a class="admin-nav-menu-list-item-link" href=" {{ url('admin/posts') }}">Статьи</a>
    </li>
    <li class="list-group-item">
        <button class="products-list"><span class="admin-nav-menu-list-item-link">Продукты</span></button>
        <ul class="list-group list-in-products">
            <li class="list-group-item"><a class="admin-nav-menu-list-item-link" href=" {{ url('admin/products') }}">Продукты</a>
            </li>
            <li class="list-group-item"><a class="admin-nav-menu-list-item-link" href=" {{ url('admin/category') }}">Категории</a>
            </li>
            <li class="list-group-item"><a class="admin-nav-menu-list-item-link" href=" {{ url('admin/filters') }}">Фильтры</a>
            </li>
        </ul>
    </li>
    <li class="list-group-item"><a class="admin-nav-menu-list-item-link" href="">Видео</a></li>
    <li class="list-group-item"><a class="admin-nav-menu-list-item-link" href="">Коментарии</a></li>
    <li class="list-group-item"><a class="admin-nav-menu-list-item-link" href=" {{ url('admin/parsing') }}">Парсинг</a>
    </li>
</ul>

<script>
    $(document).ready(function () {
        $('.list-in-products').hide();
        let page = $('head').children('title').text();
        if (page == 'Products' || page == 'Filters' || page == 'Category') {
            $('.list-in-products').show();
        }

        $('.products-list').click(function (event) {
            event.preventDefault();
            $('.list-in-products').toggle('slow');
        });
    });
</script>
