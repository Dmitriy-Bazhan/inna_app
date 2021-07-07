<ul class="list-group">
    <li class="list-group-item"><a class="btn btn-primary stretched-link" href=" {{ route('admin.users') }}">Пользователи</a>
    </li>
    <li class="list-group-item"><a class="btn btn-primary stretched-link" href=" {{ url('admin/posts') }}">Статьи</a>
    </li>
    <li class="list-group-item">
        <button class="btn btn-primary stretched-link products-list">Продукты</button>
        <ul class="list-group list-in-products">
            <li class="list-group-item"><a class="btn btn-primary stretched-link" href=" {{ url('admin/products') }}">Продукты</a>
            </li>
            <li class="list-group-item"><a class="btn btn-primary stretched-link" href=" {{ url('admin/category') }}">Категории</a></li>
            <li class="list-group-item"><a class="btn btn-primary stretched-link" href=" {{ url('admin/filters') }}">Фильтры</a></li>
        </ul>
    </li>
    <li class="list-group-item"><a class="btn btn-primary stretched-link" href="">Видео</a></li>
    <li class="list-group-item"><a class="btn btn-primary stretched-link" href="">Коментарии</a></li>
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
