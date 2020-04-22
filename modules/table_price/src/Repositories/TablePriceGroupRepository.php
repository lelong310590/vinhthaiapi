<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 02/04/2019
 * Time: 14:47
 */

namespace TablePrice\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use TablePrice\Models\TablePriceGroup;

class TablePriceGroupRepository extends BaseRepository
{
    public function model()
    {
        return TablePriceGroup::class;
    }

    /**
     * @param $keyword
     * @return mixed
     */
    public function getSearch($keyword)
    {
        return $this->scopeQuery(function ($q) use ($keyword){
            $defaultQuery = $q->orderBy('created_at', 'desc')
                ->where('name','LIKE', '%'.$keyword.'%');
            return $defaultQuery;
        })->paginate(20);
    }
}