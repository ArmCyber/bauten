@can('manager')
    @alink(['url'=>route('admin.pages.main'), 'icon'=>'mdi mdi-receipt', 'title'=>'Страницы'])@endalink
@endcan
@can('admin')
    @alink(['url'=>route('admin.admins.main'), 'icon'=>'fas fa-user-tie', 'title'=>'Администраторы'])@endalink
@endcan
