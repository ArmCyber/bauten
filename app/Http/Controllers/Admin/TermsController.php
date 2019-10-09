<?php

namespace App\Http\Controllers\Admin;

use App\Models\Term;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;

class TermsController extends BaseController
{
    public function main(){
        $data = ['title'=>'Контент страницы "Условия"'];
        $data['items'] = Term::adminList();
        $data['back_url'] = route('admin.pages.main');
        return view('admin.pages.terms.main', $data);
    }

    public function add(){
        $data = ['title'=>'Добавление блока условии', 'edit'=>false];
        $data['back_url'] = route('admin.terms.main');
        return view('admin.pages.terms.form', $data);
    }

    public function add_put(Request $request){
        if(Term::action(null, $request->all())) {
            Notify::success('Блок добавлен.');
            return redirect()->route('admin.terms.main');
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['title'=>'Редактирование блока условии', 'edit'=>true];
        $data['back_url'] = route('admin.terms.main');
        $data['item'] = Term::getItem($id);
        return view('admin.pages.terms.form', $data);
    }

    public function edit_patch($id, Request $request){
        $item = Term::getItem($id);
        if(Term::action($item, $request->all())) {
            Notify::success('Блок условии редактирован.');
            return redirect()->route('admin.terms.edit', ['id'=>$item->id]);
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function sort(){ return Term::sortable(); }

    public function delete(Request $request) {
        $result = ['success'=>false];
        $id = $request->input('item_id');
        if ($id && is_id($id)) {
            $item = Term::where('id',$id)->first();
            if ($item && Term::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

}
