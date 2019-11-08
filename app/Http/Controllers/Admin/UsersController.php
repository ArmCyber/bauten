<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Basket;
use App\Models\Part;
use App\Models\PartnerGroup;
use App\Models\User;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersController extends BaseController
{
    public function main(){
        $data = ['title'=>'Клиентская база'];
        $data['items'] = User::adminList();
        $data['types'] = User::getTypes();
        return view('admin.pages.users.main', $data);
    }

    public function view($id){
        $data = [];
        $data['item'] = User::getItem($id);
        $data['managers'] = Admin::getManagers();
        $data['partner_groups'] = PartnerGroup::adminList();
        $data['title'] = 'Пользователь "'.$data['item']->email.'"';
        $data['basket_parts'] = Basket::getPartsForUser($data['item']->id);
//        $data['back_url'] = route('admin.users.main');
        return view('admin.pages.users.view', $data);
    }

    public function changeManager(Request $request) {
        $user = User::getItem($request->input('id'));
        $manager_id = $request->input('manager_id');
        if ($manager_id) {
            $manager_exists = Admin::managerExists($manager_id);
        } else $manager_id = null;
        if (isset($manager_exists) && $manager_exists===false ) {
            Notify::error('Менеджер не найден.');
        }
        else {
            $user->manager_id = $manager_id;
            $user->save();
            Notify::get('changes_saved');
        }
        return redirect()->route('admin.users.view', ['id'=>$user->id]);
    }

    public function changePartnerGroup(Request $request) {
        $user = User::getItem($request->input('id'));
        $partner_group = PartnerGroup::find($request->input('partner_group_id'));
        if (!$partner_group) {
            Notify::error('Группа не найдена');
        }
        elseif ($partner_group->id == $user->partner_group_id) {
            Notify::warning('Пользователь уже в данном группе.');
        }
        else {
            $user->partner_group_id = $partner_group->id;
            $user->save();
            if ($request->has('notify')) {
                $user->sendPartnerGroupChangedNotification($partner_group);
            }
            Notify::get('changes_saved');
        }
        return redirect()->route('admin.users.view', ['id'=>$user->id]);
    }

    public function changeStatus(Request $request) {
        $user = User::getItem($request->input('id'));
        $old_status = $user->status;
        $new_status = $request->input('status')==1?1:0;
        $user->status = $new_status;
        $user->save();
        if($old_status==User::STATUS_PENDING && $new_status=User::STATUS_ACTIVE) {
            $user->sendProfileActivatedNotification();
        }
        Notify::get('changes_saved');
        return redirect()->route('admin.users.view', ['id'=>$user->id]);
    }

    public function changePassword(Request $request) {
        $user = User::getItem($request->input('id'));
        $password = $request->input('password');
        if(Validator::make(['password'=>$password], ['password'=>'required|string|min:8'])->fails()){
            Notify::get('error_occurred');
            return redirect()->back();
        }
        User::changePassword($user, $password);
        Notify::get('changes_saved');
        return redirect()->route('admin.users.view', ['id'=>$user->id]);
    }

    public function delete(Request $request) {
        $user = User::getItem($request->input('id'));
        User::deleteItem($user);
        Notify::success('Профиль удален.');
        return redirect()->route('admin.users.main');
    }

    public function recommendedParts($id){
        $data = [];
        $data['user'] = User::getItem($id);
        $data['items'] = $data['user']->recommended_parts;
        $data['back_url'] = route('admin.users.main');
        $data['title'] = 'Рекомендованные товары полязователя "'.$data['user']->email.'"';
        return view('admin.pages.users.recommended_parts', $data);
    }

    public function recommendedParts_add(Request $request, $id) {
        $user = User::getItem($id);
        $request->validate([
            'code' => [
                'required',
                'string',
                'exists:parts,code',
            ]
        ]);
        $part = Part::getItemFromCode($request->code);
        if ($user->recommended_parts()->where('parts.id', $part->id)->count()) {
            return redirect()->back()->withErrors(['code'=>'Запчасть уже прикреплен.'])->withInput();
        }
        $user->recommended_parts()->attach($part->id);
        Notify::success('Запчасть прикреплен.');
        return redirect()->route('admin.users.recommended_parts', ['id' => $user->id]);
    }

    public function recommendedParts_delete(Request $request, $id) {
        $user = User::getItem($id);
        $itemId = (int) $request->input('item_id');
        if ($itemId) {
            $user->recommended_parts()->detach($itemId);
        }
        return response()->json(['success'=>1]);
    }

    public function favourites($id){
        $user = User::getItem($id);
        $data = [
            'title' => 'Сохраненные товары пользователя "'.$user->email.'"',
            'back_url' => route('admin.users.view', ['id'=>$user->id]),
            'items' => $user->all_favourites,
        ];
        return view('admin.pages.users.favourites', $data);
    }

    public function basketParts($id) {
        $user = User::getItem($id);
        $data = [
            'title' => 'Товары в корзине пользователя "'.$user->email.'"',
            'back_url' => route('admin.users.view', ['id'=>$user->id]),
        ];
        $data['items'] = Basket::getPartsForUser($user->id);
        return view('admin.pages.users.basket_parts', $data);
    }
}
