@extends('admin.layouts.app')
@section('content')
    <p class="h5">Добро пожаловать {{ $user->name }}.</p>
    <p class="h5">Ваш роль: <span class="text-cyan">{{ $roles[$user->role] }}</span>.</p>
    @if($user->role == config('roles.manager'))
        <p class="h5">Ваш уникальный ID: <span class="text-cyan">{{ $user->code }}</span></p>
    @endif
@endsection
