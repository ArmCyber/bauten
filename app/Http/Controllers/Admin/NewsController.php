<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Services\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends BaseController
{
    public function main(){
        $data = ['title'=>'Новости'];
        $data['items'] = News::adminList();
        return view('admin.pages.news.main', $data);
    }

    public function add(){
        $data = ['title'=>'Добавление новости', 'edit'=>false];
        $data['back_url'] = route('admin.news.main');
        return view('admin.pages.news.form', $data);
    }

    public function add_put(Request $request){
        $validator = $this->validator($request, false);
        $validator['validator']->validate();
        if(News::action(null, $validator['inputs'])) {
            Notify::success('Новость добавлен.');
            return redirect()->route('admin.news.main');
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $data = ['title'=>'Редактирование новости', 'edit'=>true];
        $data['back_url'] = route('admin.news.main');
        $data['item'] = News::getItem($id);
        return view('admin.pages.news.form', $data);
    }

    public function edit_patch($id, Request $request){
        $item = News::getItem($id);
        $validator = $this->validator($request, $item->id);
        $validator['validator']->validate();
        if(News::action($item, $validator['inputs'])) {
            Notify::success('Новость редактирован.');
            return redirect()->route('admin.news.edit', ['id'=>$item->id]);
        }
        else {
            Notify::get('error_occurred');
            return redirect()->back()->withInput();
        }
    }

    public function delete(Request $request) {
        $result = ['success'=>false];
        $id = $request->input('item_id');
        if ($id && is_id($id)) {
            $item = News::where('id',$id)->first();
            if ($item && News::deleteItem($item)) $result['success'] = true;
        }
        return response()->json($result);
    }

    private function validator($request, $ignore=false) {
        $inputs = $request->all();
        $unique = $ignore===false?null:','.$ignore;
        if(!empty($inputs['url'])) $inputs['url'] = mb_strtolower($inputs['url']);
        $inputs['generated_url'] = !empty($inputs['title'])?to_url($inputs['title']):null;
        $request->merge(['url' => $inputs['url']]);
        $rules = [
            'generated_url'=>'required_with:generate_url|string|nullable',
            'title' => 'required|string|max:255',
            'image' => ($ignore?'nullable':'required').'|image|mimes:jpeg,png',
            'image_alt' => 'nullable|string|max:255',
            'image_title' => 'nullable|string|max:255',
            'short' => 'nullable|string',
            'content' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',

        ];
        if (empty($inputs['generate_url'])) {
            $rules['url'] = 'required|is_url|string|max:255|unique:news,url'.$unique.'|nullable';
        }
        $result = [];
        $result['validator'] = Validator::make($inputs, $rules);
        $result['inputs'] = $inputs;
        return $result;
    }
}
