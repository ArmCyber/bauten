<!doctype html><html lang="{!! app()->getLocale() !!}"><head>
    <meta charset="utf-8">
    <title>Панель администратора - {!! config('admin.author') !!}</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="{{ aAdmin('img/favicon.ico') }}" rel="shortcut icon" type="image/x-icon">
    {!! newCss(aAdmin('css/auth.css')) !!}
</head><body>
<div class="auth-form-section">
    <div class="auth-form-container">
        <div class="auth-form-logo">
            <a href="https://astudio.am/" target="_blank"><img src="{!! aAdmin('img/auth/logo.png') !!}" alt="AStudio" title="AStudio"></a>
        </div>
        <div class="auth-form"><form action="@yield('form_action')" method="post">@csrf
            @yield('content')
        </form></div>
        <div class="auth-support">По вопросам и предложениям звоните: <a href="tel:+37477355555" class="auth-link">+374(77) 35 55 55</a></div>
    </div>
</div>
</body></html>