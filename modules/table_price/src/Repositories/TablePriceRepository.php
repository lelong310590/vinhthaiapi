<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 15/03/2019
 * Time: 22:18
 */

namespace TablePrice\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use TablePrice\Models\TablePrice;

class TablePriceRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return TablePrice::class;
    }

    /**
     * @param $keyword
     * @return mixed
     */
    public function getSearch($keyword)
    {
        return $this->with('getGroup')->scopeQuery(function ($q) use ($keyword){
            $defaultQuery = $q->orderBy('created_at', 'desc')
                ->where('name','LIKE', '%'.$keyword.'%');
            return $defaultQuery;
        })->paginate(20);
    }
}