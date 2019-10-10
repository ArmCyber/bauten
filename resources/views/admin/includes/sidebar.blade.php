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
    @alink(['icon'=>'fas fa-car-side', 'title'=>'Двигатели'])
        @alink(['url'=>route('admin.engine_types.main'), 'icon'=>'fas fa-gas-pump', 'title'=>'Типы'])@endalink
        @alink(['url'=>route('admin.engines.main'), 'icon'=>'fas fa-list', 'title'=>'Список'])@endalink
    @endalink
    @alink(['url'=>route('admin.admins.main'), 'icon'=>'fas fa-user-tie', 'title'=>'Администраторы'])@endalink
@endcan
