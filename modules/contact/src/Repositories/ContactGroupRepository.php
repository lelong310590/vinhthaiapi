<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 03/05/2019
 * Time: 10:36
 */

namespace Contact\Repositories;

use Contact\Models\ContactGroup;
use Prettus\Repository\Eloquent\BaseRepository;

class ContactGroupRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return ContactGroup::class;
    }

    /**
     * @param $keyword
     * @return mixed
     */
    public function getSearch($keyword)
    {
        return $this->scopeQuery(function ($q) use ($keyword){
            $defaultQuery = $q->orderBy('created_at', 'desc')->where('name','LIKE', '%'.$keyword.'%');
            return $defaultQuery;
        })->paginate(20);
    }
}