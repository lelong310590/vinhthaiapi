<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/2/2018
 * Time: 2:48 PM
 */

namespace Faqs\Repositories;

use Faqs\Model\FaqsItem;
use Prettus\Repository\Eloquent\BaseRepository;

class FaqsItemRepository extends BaseRepository
{
    public function model()
    {
        return FaqsItem::class;
    }

    /**
     * @param $keyword
     * @return mixed
     */
    public function getSearch($keyword)
    {
        $data = $this->with('getFaqs')->scopeQuery(function ($q) use ($keyword) {
            return $q->orderBy('created_at', 'desc')->select()
                ->where('question','LIKE', '%'.$keyword.'%')
                ->orWhere('answer','LIKE', '%'.$keyword.'%');
        })->paginate(20);

        return $data;
    }
}