<?php

namespace App\Http\Controllers\Site;

use App\Http\Traits\GetFilters;
use App\Models\Filter;
use App\Models\Part;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchSmController extends BaseController
{
    use GetFilters;
    private function search_str($request){
        $string = trim($request->get('q'));
        $query  = Part::query();
        if ($string) {
            $exploded = array_map('trim', explode(' ', $string));
            foreach ($exploded as $str) {
                $query->where(function($q) use ($str){
                    $q->where('name', 'like', '%'.$str.'%')->orWhere('oem', $str)->orWhere('code', $str)->orWhere('description', 'like', '%'.$str.'%')->orWhereHas('criteria', function($q) use ($str) {
                        $q->where('criteria.title', 'like', '%'.$str.'%')->orWhereHas('filter', function($q) use ($str){
                            $q->where('filters.title', 'like', '%'.$str.'%');
                        });
                    })->orWhereHas('catalogue', function ($q) use ($str){
                        $q->where('part_catalogs.name', 'like', '%'.$str.'%')->orWhereHas('group', function($q) use ($str) {
                            $q->where('groups.name', 'like', '%'.$str.'%');
                        });
                    })->orWhereHas('brand', function ($q) use ($str){
                        $q->where('brands.name', 'like', '%'.$str.'%');
                    })->orWhereHas('modifications', function($q) use ($str){
                        $q->whereHas('generation', function($q) use ($str){
                            $q->where('generations.name', 'like', '%'.$str.'%')->orWhereHas('model', function($q) use ($str){
                                $q->where('models.name', 'like', '%'.$str.'%')->orWhereHas('mark', function($q) use ($str){
                                    $q->where('marks.name', 'like', '%'.$str.'%');
                                });
                            });
                        });
                    })
                    ->orWhereHas('engines', function ($q) use ($str){
                        $q->where('engines.name', 'like', '%'.$str.'%');
                    });
                });
            }
        }
        else return false;
        return $query;
    }

    public function live(Request $request) {
        $r='';
        $query = $this->search_str($request);
        $find = $query->where('active', 1)->brandAllowed()->orderBy('name')->limit(5)->get();
        if ($find && count($find)) {
            foreach ($find as $elem) {
                $r.='<a href="'.e(route('part', ['url'=>$elem->url])).'">'.e($elem->name).'</a>';
            }
        }
        return response($r);
    }

    public function page(Request $request){
        $data = [
            'seo' => self::staticSEO('Результаты поиска'),
            'appends' => [],
        ];
        $string = trim($request->get('q'));
        if ($string) {
            $data['search_val'] = $string;
            $appends['q'] = $string;
        }
        $query = $this->search_str($request);
        if (!$query) return redirect()->route('page');
        $ids = (clone $query)->pluck('id');
        $data['filters'] = Filter::siteListForIds($ids);
        $data['filtered'] = $this->getFilters();
        $criteriaGrouped = $this->filterCriteria($data['filters'], $data['filtered']['criteria']);
        $data['appends'] = $appends;
        $appends['filters'] = $request->get('filters');
        $appends['sort'] = $data['filtered']['sort'];
        $data['items'] = $query->where('active', 1)->brandAllowed()->filtered($criteriaGrouped)->sort([$data['filtered']['sort']])->paginate(settings('pagination'));
//        $appends['sort_type'] = $data['filtered']['sort_type']=='asc'?0:1;
        $data['items']->appends($appends);

        return view('site.pages.search_sm', $data);
    }
}
