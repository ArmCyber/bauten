{{--@can('operator')

@endcan
@can('manager')

@endcan--}}
@can('admin')
{{--    @if($pending_orders_count>0)--}}
        @alink(['url'=>route('admin.orders.pending'), 'icon'=>'fas fa-user', 'title'=>'Заказы в ожидании', 'counter'=>0])@endalink
{{--    @endif--}}
    @alink(['icon'=>'fas fa-list', 'title'=>'Каталог запчастей'])
        @alink(['url'=>route('admin.groups.main'), 'icon'=>'fas fa-layer-group', 'title'=>'Группы'])@endalink
        @alink(['url'=>route('admin.part_catalogs.main'), 'icon'=>'fas fa-list', 'title'=>'Категории'])@endalink
        @alink(['url'=>route('admin.parts.main'), 'icon'=>'fas fa-car-battery', 'title'=>'Запчасти'])@endalink
        @alink(['url'=>route('admin.filters.main'), 'icon'=>'fas fa-filter', 'title'=>'Глобальные фильтры'])@endalink
        @alink(['url'=>route('admin.engine_filters.main'), 'icon'=>'fas fa-car-side', 'title'=>'Фильтры двигателя'])@endalink
    @endalink
    @alink(['url'=>route('admin.marks.main'), 'icon'=>'fas fa-car', 'title'=>'Марки'])@endalink
    @alink(['url'=>route('admin.brands.main'), 'icon'=>'fas fa-list-ol', 'title'=>'Бренды'])@endalink
    @alink(['url'=>route('admin.partner_groups.main'), 'icon'=>'fas fa-handshake', 'title'=>'Группы партнеров'])@endalink
    @alink(['url'=>route('admin.users.main'), 'icon'=>'fas fa-user', 'title'=>'Пользователи', 'counter'=>$pending_users_count])@endalink
    @alink(['url'=>route('admin.admins.main'), 'icon'=>'fas fa-user-tie', 'title'=>'Администраторы'])@endalink
    @alink(['title' => 'Импортирование', 'icon'=>'mdi mdi-file-import'])
        @alink(['url'=>route('admin.import', ['page'=>'marks']), 'icon'=>'fas fa-car', 'title'=>'Марки'])@endalink
        @alink(['url'=>route('admin.import', ['page'=>'models']), 'icon'=>'fas fa-list', 'title'=>'Модели'])@endalink
        @alink(['url'=>route('admin.import', ['page'=>'generations']), 'icon'=>'fas fa-list-alt', 'title'=>'Модификации'])@endalink
        @alink(['url'=>route('admin.import', ['page'=>'parts']), 'icon'=>'fas fa-car-battery', 'title'=>'Запчасти'])@endalink
    @endalink
    @alink(['icon'=>'fas fa-sitemap', 'title'=>'Справочник'])
        @alink(['url'=>route('admin.pages.main'), 'icon'=>'mdi mdi-receipt', 'title'=>'Страницы'])@endalink
        @alink(['url'=>route('admin.banners', ['page'=>'info']), 'icon'=>'fas fa-info-circle', 'title'=>'Информация']) @endalink
        @alink(['url'=>route('admin.banners', ['page'=>'images']), 'icon'=>'fas fa-file-image', 'title'=>'Основные изоброжения'])@endalink
        @alink(['url'=>route('admin.news.main'), 'icon'=>'far fa-newspaper', 'title'=>'Новости'])@endalink
        @alink(['url'=>route('admin.home_slider.main'), 'icon'=>'mdi mdi-play-box-outline', 'title'=>'Главный слайдер'])@endalink
        @alink(['url'=>route('admin.countries.main'), 'icon'=>'fas fa-globe-americas', 'title'=>'Страны'])@endalink
        @alink(['url'=>route('admin.delivery_regions.main'), 'icon'=>'fas fa-globe-europe', 'title'=>'Регионы доставки'])@endalink
        @alink(['icon'=>'fas fa-columns', 'title'=>'Блоки стат. страниц'])
            @alink(['url'=>route('admin.banners', ['page'=>'auth']), 'icon'=>'fas fa-key', 'title'=>'Вход/Регистрация'])@endalink
        @endalink
    @endalink
@endcan
