<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 17/03/2019
 * Time: 14:50
 */

namespace TablePrice\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use TablePrice\Repositories\TablePriceGroupRepository;
use TablePrice\Repositories\TablePriceRepository;

class ApiTablePriceController extends BaseController
{
    protected $repository;
    protected $tablePriceGroup;

    public function __construct(TablePriceRepository $tablePriceRepository, TablePriceGroupRepository $tablePriceGroupRepository)
    {
        $this->repository = $tablePriceRepository;
        $this->tablePriceGroup = $tablePriceGroupRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function get(Request $request)
    {
        $limit = $request->get('limit');

        try {
            $data = $this->repository->scopeQuery(function ($q) use ($limit) {
                return $q->select('id', 'name', 'price', 'sale_price', 'price_type', 'description', 'content', 'status', 'main', 'index', 'created_at')
                    ->where('status', 'active')
                    ->orderBy('index', 'asc')
                    ->take($limit);
            })->all();

            return $data;
        } catch (\Exception $e) {
            return response()->json(['message' => config('messages.error')])->setStatusCode(500);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function getByGroup(Request $request)
    {
        $limit = $request->get('limit');
        $groupId = $request->get('groupId');

        try {
            $data = $this->tablePriceGroup->with(['getTablePrice' => function($relation) use ($limit) {
                return $relation->where('status', 'active')->orderBy('index', 'asc')->take($limit);
            }])->findWhere([
                'id' => $groupId,
                'status' => 'active'
            ])->first();

            return $data;

        } catch (\Exception $e) {
            return response()->json(['message' => config('messages.error')])->setStatusCode(500);
        }
    }
}