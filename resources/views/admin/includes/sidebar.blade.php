@alink(['can'=>'operator_manager', 'icon'=>'fas fa-paperclip', 'title'=>'Заказы', 'counter'=>$new_orders_count+$pending_orders_count])
    @if($new_orders_count)
        @alink(['can'=>'operator_manager', 'url'=>route('admin.orders.new'), 'icon'=>'fas fa-plus-circle', 'title'=>'Новые заказы', 'counter'=>$new_orders_count])@endalink
    @endif
    @if($pending_orders_count)
        @alink(['can'=>'operator_manager', 'url'=>route('admin.orders.pending'), 'icon'=>'fas fa-tasks', 'title'=>'Невыполненные заказы', 'counter'=>$pending_orders_count])@endalink
    @endif
    @alink(['can'=>'operator_manager', 'url'=>route('admin.orders.done'), 'icon'=>'fas fa-check-circle', 'title'=>'Выполненные заказы'])@endalink
    @if($declined_orders_count)
        @alink(['can'=>'operator_manager', 'url'=>route('admin.orders.declined'), 'icon'=>'fas fa-times-circle', 'title'=>'Откланенные заказы'])@endalink
    @endif
@endalink
@alink(['can'=>'operator_manager', 'url'=>route('admin.applications.main'), 'icon'=>'far fa-file-alt', 'title'=>'Заявки', 'counter'=>$applications_count])@endalink
@alink(['can'=>'operator_manager', 'url'=>route('admin.users.main'), 'icon'=>'fas fa-user', 'title'=>'Пользователи', 'counter'=>$pending_users_count])@endalink
@alink(['can'=>'content', 'icon'=>'fas fa-list', 'title'=>'Каталог запчастей'])
    @alink(['can'=>'content', 'url'=>route('admin.groups.main'), 'icon'=>'fas fa-layer-group', 'title'=>'Группы'])@endalink
    @alink(['can'=>'content', 'url'=>route('admin.part_catalogs.main'), 'icon'=>'fas fa-list', 'title'=>'Категории'])@endalink
    @alink(['can'=>'manager_content', 'url'=>route('admin.parts.main'), 'icon'=>'fas fa-car-battery', 'title'=>'Запчасти'])@endalink
    @alink(['can'=>'admin', 'url'=>route('admin.filters.main'), 'icon'=>'fas fa-filter', 'title'=>'Глобальные фильтры'])@endalink
@endalink
@alink(['can'=>'admin', 'url'=>route('admin.engines.main'), 'icon'=>'fas fa-car-side', 'title'=>'Двигатели'])@endalink
@alink(['can'=>'admin', 'url'=>route('admin.pickup_points.main'), 'icon'=>'fas fa-map-marker', 'title'=>'Точки самовывоза'])@endalink
@alink(['can'=>'admin', 'url'=>route('admin.banners', ['page'=>'settings']), 'icon'=>'fas fa-cog', 'title'=>'Настройки магазина'])@endalink
@alink(['can'=>'admin', 'url'=>route('admin.marks.main'), 'icon'=>'fas fa-car', 'title'=>'Марки'])@endalink
@alink(['can'=>'manager_content', 'url'=>route('admin.brands.main'), 'icon'=>'fas fa-list-ol', 'title'=>'Бренды'])@endalink
@alink(['can'=>'content', 'url'=>route('admin.partner_groups.main'), 'icon'=>'fas fa-handshake', 'title'=>'Группы партнеров'])@endalink
@alink(['can'=>'admin', 'url'=>route('admin.admins.main'), 'icon'=>'fas fa-user-tie', 'title'=>'Администраторы'])@endalink
@alink(['can'=>'admin', 'url'=>route('admin.delivery_regions.main'), 'icon'=>'fas fa-globe-europe', 'title'=>'Регионы доставки'])@endalink
@alink(['can'=>'admin', 'title' => 'Импортирование', 'icon'=>'mdi mdi-file-import'])
    @alink(['can'=>'admin', 'url'=>route('admin.import', ['page'=>'marks']), 'icon'=>'fas fa-car', 'title'=>'Марки'])@endalink
    @alink(['can'=>'admin', 'url'=>route('admin.import', ['page'=>'models']), 'icon'=>'fas fa-list', 'title'=>'Модели'])@endalink
    @alink(['can'=>'admin', 'url'=>route('admin.import', ['page'=>'generations']), 'icon'=>'fas fa-list-alt', 'title'=>'Кузовы'])@endalink
    @alink(['can'=>'admin', 'url'=>route('admin.import', ['page'=>'parts']), 'icon'=>'fas fa-car-battery', 'title'=>'Запчасти'])@endalink
    @alink(['can'=>'admin', 'url'=>route('admin.import', ['page'=>'engines']), 'icon'=>'fas fa-car-side', 'title'=>'Двигатели'])@endalink
@endalink
@alink(['can'=>'content', 'icon'=>'fas fa-sitemap', 'title'=>'Справочник'])
    @alink(['can'=>'content', 'url'=>route('admin.pages.main'), 'icon'=>'mdi mdi-receipt', 'title'=>'Страницы'])@endalink
    @alink(['can'=>'content', 'url'=>route('admin.banners', ['page'=>'info']), 'icon'=>'fas fa-info-circle', 'title'=>'Информация']) @endalink
    @alink(['can'=>'content', 'url'=>route('admin.banners', ['page'=>'images']), 'icon'=>'fas fa-file-image', 'title'=>'Основные изоброжения'])@endalink
    @alink(['can'=>'content', 'url'=>route('admin.news.main'), 'icon'=>'far fa-newspaper', 'title'=>'Новости'])@endalink
    @alink(['can'=>'content', 'url'=>route('admin.home_slider.main'), 'icon'=>'mdi mdi-play-box-outline', 'title'=>'Главный слайдер'])@endalink
    @alink(['can'=>'content', 'icon'=>'fas fa-columns', 'title'=>'Блоки стат. страниц'])
        @alink(['can'=>'content', 'url'=>route('admin.banners', ['page'=>'auth']), 'icon'=>'fas fa-key', 'title'=>'Вход/Регистрация'])@endalink
        @alink(['can'=>'content', 'url'=>route('admin.banners', ['page'=>'texts']), 'icon'=>'fas fa-list', 'title'=>'Другие тексты'])@endalink
    @endalink
@endalink
