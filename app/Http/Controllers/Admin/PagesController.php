<?php
namespace App\Http\Controllers\Admin;
use App\Services\Notify\Facades\Notify;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class PagesController extends BaseController
{
    private const CONTENT_PAGES = [
        'home' => 'home',
    ];
    /*
        private const GALLERY_PAGES = [
            //
        ];

        private const VIDEO_GALLERY_PAGES = [
            //
        ];
    */
    public function main(){
        $data = [];
        $data['content_pages'] = self::CONTENT_PAGES;
//        $data['gallery_pages'] = self::GALLERY_PAGES;
//        $data['video_gallery_pages'] = self::VIDEO_GALLERY_PAGES;
        $data['title'] = 'Страницы';
        $data['items'] = Page::adminList();
        return view('admin.pages.pages.main', $data);
    }

    public function addPage(){
        $data = [];
        $data['title'] = 'Добавление страницы';
        $data['back_url'] = route('admin.pages.main');
        $data['edit'] = false;
        $data['homepage'] = \PageManager::getHomePage();
        return view('admin.pages.pages.form', $data);
    }

    public function addPage_put(Request $request){
        $validator = $this->validator($request);
        $validator['validator']->validate();
        Page::action(null, $validator['inputs']);
        Notify::success('Страница добавлена.');
        return redirect(route('admin.pages.main'));
    }
    public function editPage($id) {
        $data = [];
        $data['item'] = Page::getPage($id);
        $data['back_url'] = route('admin.pages.main');
        $data['title'] = 'Редактирование страницы "'.$data['item']->title.'"';
        $data['edit'] = true;
        $data['homepage'] = \PageManager::getHomePage();
        return view('admin.pages.pages.form', $data);
    }
    public function editPage_patch($id, Request $request) {
        $page = Page::getPage($id);
        $validator = $this->validator($request, $id, $page);
        $validator['validator']->validate();
        if(Page::action($page, $validator['inputs'])) {
            Notify::success('Страница редактирована.');
            return redirect()->route('admin.pages.edit', ['id'=>$id]);
        }
        else {
            Notify::get('nothing_changed');
            return redirect()->back()->withInput();
        }
    }
    public function sort() {return Page::sortable();}
    public function deletePage_delete(Request $request) {
        $result = ['success'=>false];
        $id = $request->input('item_id');
        if ($id && is_id($id)) {
            $page = Page::where(['id'=>$id, 'static'=>null])->first();
            if ($page && Page::deletePage($page)) $result['success'] = true;
        }
        return response()->json($result);
    }

    private function validator($request, $ignore=false, $page=null) {
        $inputs = $request->all();
        if ($page && $page->static==\PageManager::getHomePage()){
            $inputs['url']=$page->url;
        }
        if(!empty($inputs['url'])) $inputs['url'] = mb_strtolower($inputs['url']);
        $inputs['generated_url'] = !empty($inputs['title'])?to_url($inputs['title']):null;
        $request->merge(['url' => $inputs['url']]);
        $unique = $ignore===false?null:','.$ignore;
        $result = [];
        $rules = [
            'generated_url'=>'required_with:generate_url|string|nullable',
            'title' => 'nullable|string|max:255',
            'seo_title' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
        ];
        if (empty($inputs['generate_url'])) {
            $rules['url'] = 'required|is_url|string|unique:pages,url'.$unique.'|min:3|nullable';
            if (!$page || $page->url!==$inputs['url']){
                $rules['url'].='|not_in_routes';
            }
        }
        $result['validator'] = Validator::make($inputs, $rules, [
            'generated_url.required_with'=>'Введите название чтобы сгенерировать URL.',
        ]);
        $result['inputs'] = $inputs;
        return $result;
    }
}
