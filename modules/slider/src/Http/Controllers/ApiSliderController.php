<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/29/2019
 * Time: 11:03 AM
 */

namespace Slider\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Slider\Models\Slider;
use Slider\Repositories\GroupSlideRepository;
use Slider\Reposotories\SliderRepository;

class ApiSliderController extends BaseController
{
    protected $sl;
    protected $gr;

    public function __construct(GroupSlideRepository $groupSlideRepository, SliderRepository $sliderRepository)
    {
        $this->sl = $sliderRepository;
        $this->gr = $groupSlideRepository;
    }

    public function getSlider(Request $request){

        $group_id = $request->get('group_id');
        $limit = $request->get('limit');

        try {
            $group_sl = $this->gr->findWhere(['id' => $group_id, 'status' => 'active'])->first();
            $items = $this->sl->scopeQuery(function ($e) use ($group_sl, $limit) {
                return $e->orderBy('index', 'asc')->select('id', 'name', 'group_id', 'thumbnail', 'button_name', 'description', 'videoframe','content', 'url',
                    'index', 'status')
                    ->where(['group_id' => $group_sl->id,'status'=>'active'])->take($limit);
            })->all();
            return $items;
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }
    }

    public function getQc(Request $request){
        try {
            $items = Slider::where('group_id',3)->take(5)->get();
            return $items;
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }
    }
}