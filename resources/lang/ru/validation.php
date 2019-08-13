<?php

return [

    'required' => 'Введите :attribute.',
    'string' => 'Введите :attribute.',
    'email' => 'Недейтвительный адрес эл.почты.',
    'mail' => 'Недейтвительный адрес эл.почты.',
    'is_url' => 'Недейтвительный URL.',
    'integer' => ':Attribute должен содержать только цифры.',
    'between' => [
        'numeric' => ':Attribute должен быть между :min и :max.',
    ],
    'min' => [
        'string'=>':Attribute должен содержать мин. :min символов.',
    ],
    'max' => [
        'string'=>':Attribute должен содержать макс. :max символов.',
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
