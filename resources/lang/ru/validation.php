<?php

return [

    'required' => 'Введите :attribute.',
    'string' => 'Введите :attribute.',
    'email' => 'Недейтвительный адрес эл.почты.',
    'is_url' => 'Недейтвительный URL.',
    'min' => [
        'string'=>':Attribute должен содержать мин. :min символов.',
    ],
    'unique'=>':Attribute уже используется.',
    'not_in_routes'=>':Attribute уже используется.',
    'confirmed' => ':Attribute и подверждение не совпадают.',

    'attributes' => [
        'email' => 'адрес эл. почты',
        'password' => 'пароль',
        'new_password' => 'новый пароль',
        'current_password' => 'текуший пароль',
        'name' => 'имя',
        'url' => 'ссылка'
    ],

];
