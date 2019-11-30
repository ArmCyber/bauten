<?php

namespace App\Http\Controllers\Site\Cabinet;

use App\Http\Controllers\Site\BaseController;
use App\Models\Application;
use App\Models\Part;
use App\Models\PartnerGroup;
use App\Models\PriceApplication;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MainController extends BaseController
{
    public function main(){
        $data = [];
        if (!$this->shared['user']->individual_sale) {
            $data['partner_group'] = $this->shared['user']->partner_group;
            $data['next_partner_group'] = PartnerGroup::getNextStatus($data['partner_group']);
        }
        $data['seo'] = $this->staticSEO('Личный кабинет');
        return view('site.pages.cabinet.main', $data);
    }

    public function sendApplication(Request $request, $id) {
        $item = Part::getActiveItem($id);
        if (!$item || (!$item->application_only && $item->max_count_wo_basket)) abort(404);
        $inputs = $request->all();
        Validator::make($inputs, [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|phone|max:255',
            'region' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ], [
            'required' => 'Поле обязательно для заполнения.',
            'string' => 'Поле обязательно для заполнения.',
            'max' => 'Макс. :max символов.',
            'exists' => 'Поле обязательно для заполнения.',
            'phone' => 'Недействительный номер телефона.',
        ])->validate();
        $count = $request->input('count');
        if (!$count || !is_id($count) || $count>9999 || $count%$item->multiplication!=0) {
            Notify::get('error_occurred');
            return redirect()->back();
        }
        $model = new Application();
        $model->user_id = $this->shared['user']->id;
        $model->name = $inputs['name'];
        $model->phone = $inputs['phone'];
        $model->region = $inputs['region'];
        $model->city = $inputs['city'];
        $model->part_id = $item->id;
        $model->part_name = $item->name;
        $model->part_code = $item->code;
        $model->price = $item->price;
        $model->real_price = $item->sale;
        $model->count = $count;
        $sum = $item->price*$count;
        $real_sum = $sum;
        if ($item->count_sale_count && $item->count_sale_percent && $count>=$item->count_sale_count) {
            $sum = $sum*(1 - $item->count_sale_percent/100);
        }
        else if ($this->shared['user']->sale) {
            $sum -= $sum*$this->shared['user']->sale/100;
        }
        $model->sum = $sum;
        $model->real_sum = $real_sum;
        $model->save();
        //TODO:: APPLICATION_SEND_MAIL
        Notify::success('Заявка отправлена.');
        return redirect()->back();
    }

    public function sendPriceApplication(Request $request, $id) {
        $item = Part::getActiveItem($id);
        if (!$item || $item->price) abort(404);
        $inputs = $request->all();
        Validator::make($inputs, [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|phone|max:255',
            'region' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ], [
            'required' => 'Поле обязательно для заполнения.',
            'string' => 'Поле обязательно для заполнения.',
            'max' => 'Макс. :max символов.',
            'exists' => 'Поле обязательно для заполнения.',
            'phone' => 'Недействительный номер телефона.',
        ])->validate();
        $model = new PriceApplication;
        $model->user_id = $this->shared['user']->id;
        $model->name = $inputs['name'];
        $model->phone = $inputs['phone'];
        $model->region = $inputs['region'];
        $model->city = $inputs['city'];
        $model->part_id = $item->id;
        $model->part_name = $item->name;
        $model->part_code = $item->code;
        $model->save();
        Notify::success('Заявка отправлена.');
        return redirect()->back();
    }
}
