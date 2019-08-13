@extends('admin.layouts.app')
@section('content')
<form action="{!! $edit?route('admin.admins.edit', ['id'=>$item->id]):route('admin.admins.add') !!}" method="post">
    @csrf @method($edit?'patch':'put')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="c-title">Имя</div>
                <div class="little-p">
                    <input type="text" name="name" class="form-control" placeholder="Имя" value="{{ old('name', $item->name??null) }}">
                </div>
            </div>
            <div class="card">
                <div class="c-title">Роль</div>
                <div class="little-p">
                    <select name="role" class="select2" style="width: 100%">
                        @php $selectedRole = old('role', $item->role??0) @endphp
                        @foreach($roles as $key=>$role)
                            @if($loop->last) @break @endif
                            <option value="{{ $key }}"{!! $key==$selectedRole?' selected':null !!}>{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card">
                <div class="c-title">Статус</div>
                <div class="little-p">
                    @labelauty(['id'=>'active', 'label'=>'Неактивно|Активно', 'checked'=>oldCheck('active', ($edit && empty($item->active))?false:true)])@endlabelauty
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="c-title">Адрес эл.почты</div>
                <div class="little-p">
                    <input type="text" name="email" class="form-control" placeholder="Адрес эл.почты" value="{{ old('email', $item->email??null) }}">
                </div>
            </div>
            <div class="card">
                <div class="c-title">Пароль</div>
                <div class="little-p">
                    <input type="password" style="margin-top:8px;" autocomplete="new-password" name="password" class="form-control" placeholder="Новый пароль">
                    <input type="password" style="margin-top:8px;" autocomplete="new-password-confirmation" name="password_confirmation" class="form-control" placeholder="Повторите пароль">
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 save-btn-fixed"><button type="submit"></button></div>
</form>
@endsection
@push('js')
    @js(aApp('select2/select2.js'))
    <script>
        $('.select2').select2();
    </script>
@endpush
@push('css')
    @css(aApp('select2/select2.css'))
@endpush