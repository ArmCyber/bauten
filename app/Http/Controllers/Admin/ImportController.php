<?php

namespace App\Http\Controllers\Admin;

use App\Imports\MarksImport;
use App\Imports\ModelsImport;
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
                $response = ['status'=>0];
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
        ]
    ];
}