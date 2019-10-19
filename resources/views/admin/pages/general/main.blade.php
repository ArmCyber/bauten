@extends('admin.layouts.app')
@section('content')
    <p class="h5">Добро пожаловать {{ $user->name }}.</p>
    <p class="h5">Ваш роль - <span class="text-success">{{ $roles[$user->role] }}</span>.</p>
@endsection
