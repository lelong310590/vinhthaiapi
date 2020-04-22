<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/2/2018
 * Time: 2:48 PM
 */

namespace Faqs\Repositories;

use Faqs\Model\Faqs;
use Prettus\Repository\Eloquent\BaseRepository;

class FaqsRepository extends BaseRepository
{
    public function model()
    {
        return Faqs::class;
    }

    /**
     * @return mixed
     */
    public function getFaqsItem()
    {
        return $this->with(['getFaqsItem' => function($e) {
            return $e->orderBy('sort', 'asc')->select('faqs_group', 'question', 'answer', 'thumbnail')
                ->where('status', 'active');
        }])->orderBy('sort', 'asc')->scopeQuery(function ($q) {
            return $q->select('id', 'name')->where('status', 'active')->take(2);
        })->all();
    }

    /**
     * @param $keyword
     * @return mixed
     */
    public function getSearch($keyword)
    {
        return $this->scopeQuery(function ($q) use ($keyword){
            $defaultQuery = $q->orderBy('created_at', 'desc')->select('username', 'email', 'full_name', 'phone', 'id', 'status', 'thumbnail')
                ->where('name','LIKE', '%'.$keyword.'%');
            return $defaultQuery;
        })->paginate(20);
    }
}