<?php

namespace App\Http\Controllers\Admin;

use App\Imports\CatalogsImport;
use App\Imports\EnginesImport;
use App\Imports\GenerationsImport;
use App\Imports\MarksImport;
use App\Imports\ModelsImport;
use App\Imports\PartsImport;
use App\Imports\RecommendedPartsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImportController extends BaseController
{
    //region Private
    public function render(Request $request, $page){
        if(!array_key_exists($page, self::IMPORTS)) abort(404);
        $import = self::IMPORTS[$page];
        if($request->getMethod()=='POST') {
            if(Validator::make($request->only('file'), [
                'file' => 'required|file|mimes:xlsx,xls,csv'
            ])->fails()) {
                $response = 'unvalidated';
            }
            else {
                $file = $request->file('file');
                $response = $import['importer']::import($file);
            }
            return redirect()->back()->with(['import_response' => $response]);
        }
        else {
            $data = [
                'title'=>$import['title']??null,
                'response' => session('import_response'),
                'columns' => $import['importer']::getColumns(),
            ];
            return view('admin.pages.general.import', $data);
        }
    }
    //endregion

    private const IMPORTS = [
        'marks' => [
            'importer' => MarksImport::class,
            'title' => 'Импортирование марок',
        ],
        'models' => [
            'importer' => ModelsImport::class,
            'title' => 'Импортирование моделей',
        ],
        'generations' => [
            'importer' => GenerationsImport::class,
            'title' => 'Импортирование кузовов',
        ],
        'parts' => [
            'importer' => PartsImport::class,
            'title' => 'Импортирование запчастей',
        ],
        'engines' => [
            'importer' => EnginesImport::class,
            'title' => 'Импортирование двигателей'
        ],
        'catalogs' => [
            'importer' => CatalogsImport::class,
            'title' => 'Импортирование категории'
        ],
        'recommended_parts' => [
            'importer' => RecommendedPartsImport::class,
            'title' => 'Импортирование рекомендованных товаров'
        ]
    ];
}
