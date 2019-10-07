{{--@can('operator')

@endcan
@can('manager')

@endcan--}}
@can('admin')
    @alink(['url'=>route('admin.pages.main'), 'icon'=>'mdi mdi-receipt', 'title'=>'Страницы'])@endalink
    @alink(['url'=>route('admin.home_slider.main'), 'icon'=>'mdi mdi-play-box-outline', 'title'=>'Главный слайдер'])@endalink
    @alink(['url'=>route('admin.banners', ['page'=>'info']), 'icon'=>'fas fa-info-circle', 'title'=>'Информация']) @endalink
    @alink(['url'=>route('admin.marks.main'), 'icon'=>'fas fa-car', 'title'=>'Марки'])@endalink
    @alink(['url'=>route('admin.admins.main'), 'icon'=>'fas fa-user-tie', 'title'=>'Администраторы'])@endalink
    @alink(['url'=>route('admin.countries.main'), 'icon'=>'fas fa-globe-americas', 'title'=>'Страны'])@endalink
    @alink(['url'=>route('admin.parts.main'), 'icon'=>'fas fa-car-battery', 'title'=>'Запчасти'])@endalink
    @alink(['url'=>route('admin.brands.main'), 'icon'=>'fas fa-list-ol', 'title'=>'Бренды'])@endalink
    @alink(['url'=>route('admin.part_catalogs.main'), 'icon'=>'fas fa-list', 'title'=>'Каталог запчастей'])@endalink
    @alink(['url'=>route('admin.news.main'), 'icon'=>'far fa-newspaper', 'title'=>'Новости'])@endalink
{{--    @alink(['url'=>route('admin.filters.main'), 'icon'=>'fas fa-filter', 'title'=>'Глобальные фильтры'])@endalink--}}
@endcan
