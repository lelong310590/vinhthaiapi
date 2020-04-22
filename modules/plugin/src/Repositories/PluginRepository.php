<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 24/03/2019
 * Time: 17:25
 */

namespace Plugin\Repositories;

use Plugin\Models\Plugin;
use Prettus\Repository\Eloquent\BaseRepository;

class PluginRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return Plugin::class;
    }

    /**
     * @param $keyword
     * @return mixed
     */
    public function getSearch($keyword)
    {
        return $this->scopeQuery(function ($q) use ($keyword){
            $defaultQuery = $q->orderBy('created_at', 'desc')
                ->where('core', '!=', 'active')
                ->where('name','LIKE', '%'.$keyword.'%');
            return $defaultQuery;
        })->all(['id', 'name', 'description', 'path', 'status', 'core', 'created_at']);
    }
}