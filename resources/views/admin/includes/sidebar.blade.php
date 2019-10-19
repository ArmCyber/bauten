{{--@can('operator')

@endcan
@can('manager')

@endcan--}}
@can('admin')
    @alink(['icon'=>'fas fa-sitemap', 'title'=>'Информационные части'])
        @alink(['url'=>route('admin.pages.main'), 'icon'=>'mdi mdi-receipt', 'title'=>'Страницы'])@endalink
        @alink(['url'=>route('admin.banners', ['page'=>'info']), 'icon'=>'fas fa-info-circle', 'title'=>'Информация']) @endalink
        @alink(['url'=>route('admin.banners', ['page'=>'images']), 'icon'=>'fas fa-file-image', 'title'=>'Основные изоброжения'])@endalink
        @alink(['url'=>route('admin.news.main'), 'icon'=>'far fa-newspaper', 'title'=>'Новости'])@endalink
        @alink(['url'=>route('admin.home_slider.main'), 'icon'=>'mdi mdi-play-box-outline', 'title'=>'Главный слайдер'])@endalink
        @alink(['url'=>route('admin.countries.main'), 'icon'=>'fas fa-globe-americas', 'title'=>'Страны'])@endalink
        @alink(['icon'=>'fas fa-columns', 'title'=>'Блоки стат. страниц'])
            @alink(['url'=>route('admin.banners', ['page'=>'auth']), 'icon'=>'fas fa-key', 'title'=>'Вход/Регистрация'])@endalink
        @endalink
    @endalink
    @alink(['icon'=>'fas fa-list', 'title'=>'Каталог запчастей'])
        @alink(['url'=>route('admin.groups.main'), 'icon'=>'fas fa-layer-group', 'title'=>'Группы'])@endalink
        @alink(['url'=>route('admin.part_catalogs.main'), 'icon'=>'fas fa-list', 'title'=>'Категории'])@endalink
        @alink(['url'=>route('admin.parts.main'), 'icon'=>'fas fa-car-battery', 'title'=>'Запчасти'])@endalink
        @alink(['url'=>route('admin.filters.main'), 'icon'=>'fas fa-filter', 'title'=>'Глобальные фильтры'])@endalink
    @endalink
    @alink(['url'=>route('admin.marks.main'), 'icon'=>'fas fa-car', 'title'=>'Марки'])@endalink
    @alink(['url'=>route('admin.brands.main'), 'icon'=>'fas fa-list-ol', 'title'=>'Бренды'])@endalink
    @alink(['url'=>route('admin.years.main'), 'icon'=>'fas fa-calendar-week', 'title'=>'Годы'])@endalink
    @alink(['url'=>route('admin.engine_filters.main'), 'icon'=>'fas fa-car-side', 'title'=>'Двигатели'])@endalink
    @alink(['url'=>route('admin.users.main'), 'icon'=>'fas fa-user', 'title'=>'Пользователи', 'counter'=>$pending_users_count])@endalink
    @alink(['url'=>route('admin.admins.main'), 'icon'=>'fas fa-user-tie', 'title'=>'Администраторы'])@endalink
    @alink(['title' => 'Импортирование', 'icon'=>'mdi mdi-file-import'])
        @alink(['url'=>route('admin.import', ['page'=>'marks']), 'icon'=>'fas fa-car', 'title'=>'Импортирование Марок'])@endalink
        @alink(['url'=>route('admin.import', ['page'=>'models']), 'icon'=>'fas fa-list', 'title'=>'Импортирование Моделей'])@endalink
    @endalink
@endcan
