<?php
namespace App\Http\Traits;


trait GetFilters {
    protected function getFilters(){
        $request = request();
        $criteriaInput = $request->get('filters');
        $criteriaArray = $criteriaInput?explode('_', $criteriaInput):[];
        $criteria = [];
        foreach($criteriaArray as $criterion) if (is_id($criterion)) $criteria[] = $criterion;
        $sort = $request->get('sort');
        switch($sort) {
            case 'new': case 'sale': break;
            default: $sort = 'price';
        }
//        $sort_type = $request->get('sort_type', '0')?'desc':'asc';
        return [
            'criteria' => $criteria,
            'sort' => $sort,
//            'sort_type' => $sort_type,
        ];
    }

    protected function filterCriteria($filters, $criteria) {
        $result = [];
        if (count($criteria)) {
            $allCriteria = $filters->pluck('criteria')->flatten();
            foreach ($criteria as $criterion) {
                $this_criteria = $allCriteria->where('id', $criterion)->first();
                if ($this_criteria) $result[$this_criteria->filter_id][] = $this_criteria->id;
            }
        }
        return $result;
    }
}
