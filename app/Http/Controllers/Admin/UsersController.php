<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Models\Admin;
use App\Models\Application;
use App\Models\Basket;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Part;
use App\Models\PartnerGroup;
use App\Models\PriceApplication;
use App\Models\User;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

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
        $data['order_counts'] = Order::getUserOrdersCount($data['item']->id);
        $data['statuses'] = Order::STATUSES;
        $data['applications'] = Application::getUserItems($data['item']->id);
        $data['price_applications'] = PriceApplication::getUserItems($data['item']->id);
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
        $partner_group_id = $request->input('partner_group_id');
        if ($partner_group_id == 0) {
            $individual_sale = $request->input('individual_sale');
            if (!$individual_sale || !is_id($individual_sale) || $individual_sale>=100){
                Notify::error('Недействительный процент скидки');
            }
            else {
                $individual_sale = (int) $individual_sale;
                $user->partner_group_id = null;
                $user->individual_sale = $individual_sale;
                $user->save();
                if ($request->has('notify')) {
                    $user->sendIndividualSaleChangedNotification($individual_sale);
                }
                Notify::get('changes_saved');
            }
        }
        else {
            $partner_group = PartnerGroup::find($partner_group_id);
            if (!$partner_group) {
                Notify::error('Группа не найдена');
            }
            elseif ($partner_group->id == $user->partner_group_id) {
                Notify::warning('Пользователь уже в данном группе.');
            }
            else {
                $user->partner_group_id = $partner_group->id;
                $user->individual_sale = 0;
                $user->save();
                if ($request->has('notify')) {
                    $user->sendPartnerGroupChangedNotification($partner_group);
                }
                Notify::get('changes_saved');
            }
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
        $data['title'] = 'Товары для полязователя "'.$data['user']->email.'"';
        return view('admin.pages.users.recommended_parts', $data);
    }

    public function recommendedParts_add(Request $request, $id) {
        $user = User::getItem($id);
        $request->validate([
            'ref' => [
                'required',
                'string',
                'exists:parts,ref',
            ]
        ]);
        $part = Part::getItemFromRef($request->ref);
        if ($user->recommended_parts()->where('parts.id', $part->id)->count()) {
            return redirect()->back()->withErrors(['ref'=>'Запчасть уже прикреплен.'])->withInput();
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

    public function restrictedBrands($id){
        $data = [];
        $data['user'] = User::getItem($id);
        $data['title'] = 'Ограничения пользователя "'.$data['user']->email.'" по брендам';
        $data['items'] = $data['user']->restricted_brands;
        $data['back_url'] = route('admin.users.main');
        return view('admin.pages.users.restricted_brands', $data);
    }

    public function export(){
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function restrictedBrands_add(Request $request, $id) {
        $user = User::getItem($id);
        $request->validate([
            'id' => [
                'required',
                'integer',
                'exists:brands,id',
            ]
        ], [], [
            'id' => 'ID бренда'
        ]);
        $brand = Brand::getItem($request->input('id'));
        if ($user->restricted_brands()->where('brands.id', $brand->id)->count()) {
            return redirect()->back()->withErrors(['id'=>'Бренд уже ограничен.'])->withInput();
        }
        $user->restricted_brands()->attach($brand->id);
        Basket::deletePartsForBrand($user->id, $brand->id);
        Notify::success('Бренд ограничен.');
        return redirect()->route('admin.users.restricted_brands', ['id' => $user->id]);
    }

    public function restrictedBrands_delete(Request $request, $id) {
        $user = User::getItem($id);
        $itemId = (int) $request->input('item_id');
        if ($itemId) {
            $user->restricted_brands()->detach($itemId);
        }
        return response()->json(['success'=>1]);
    }
}
