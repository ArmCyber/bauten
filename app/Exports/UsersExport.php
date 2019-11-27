<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection, ShouldAutoSize
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $header = [
            'ID',
            'Email',
            'ФИО',
            'Телефон',
            'Регион',
            'Город',
            'Тип',
            'Компания',
            'Бин',
            'Менеджер',
            'Скидка',
            'Статус',
            'Дата регистрации',
        ];
        $collection = User::with(['manager', 'partner_group'])->sort()->get()->map(function($item){
            return [
                $item->id,
                $item->email.($item->verification?' (не подтвержден)':null),
                $item->name,
                (string) $item->phone,
                $item->region,
                $item->city,
                $item->type_name,
                $item->type==User::TYPE_ENTITY?$item->company:'-',
                $item->type==User::TYPE_ENTITY?$item->bin:'-',
                $item->manager?$item->manager->email:'-',
                $item->individual_sale?'Индивидуальная ('.$item->individual_sale.'%)':'Партнерская группа "'.($item->partner_group->title??'?').'" ('.($item->partner_group->sale??'?').'%)',
                $item->status_name,
                $item->created_at->format('d.m.Y H:i'),
            ];
        });
        return $collection->prepend($header);
    }
}
