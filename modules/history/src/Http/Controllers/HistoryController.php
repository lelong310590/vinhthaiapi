<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/25/2019
 * Time: 10:11 PM
 */

namespace History\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HistoryController extends BaseController
{

    public function __construct()
    {

    }

    public function getIndex(Request $request)
    {
        try {
            if($request->get('find-date')){
                $date = $request->get('find-date');
                $dateto = str_replace('/','-',$date);
                $filename = $dateto.'.txt';
            }else{
                $filename = datetolog(now()).'.txt';
            }

            $url = storage_path('history\\'.$filename);
            $contents = File::get($url);
            $content = str_replace('.','</br>',$contents);

            return view('lito-history::index',[
                'data' => $content
            ]);

        } catch (\Exception $e) {
            return view('lito-history::index',[
                'data' => []
            ]);
        }
    }
}