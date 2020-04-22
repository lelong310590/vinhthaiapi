<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/23/2019
 * Time: 10:23 AM
 */

namespace Menu\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Menu\Repositories\MenuNodeRepositories;

class ApiNodeController extends BaseController
{
    protected $node;

    public function __construct(MenuNodeRepositories $menuNodeRepositories)
    {
        $this->node = $menuNodeRepositories;
    }

    public function getNodeMenu($id=0, Request $request){
        try{
            $menu_id = $request->get('menu_id');
            $data = $this->node->getApiMenuNode($menu_id);
            return $data;
        }catch (\Exception $e){
            return response()->json(['message' => config('messages.error')])->setStatusCode(500);
        }


    }

}