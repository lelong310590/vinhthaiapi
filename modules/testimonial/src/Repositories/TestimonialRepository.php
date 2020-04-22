<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 19/03/2019
 * Time: 02:15
 */

namespace Testimonial\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Testimonial\Models\Testimonial;

class TestimonialRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return Testimonial::class;
    }

    /**
     * @param $keyword
     * @return mixed
     */
    public function getSearch($keyword)
    {
        return $this->scopeQuery(function ($q) use ($keyword){
            $defaultQuery = $q->orderBy('created_at', 'desc')
                ->where('name','LIKE', '%'.$keyword.'%')
                ->orWhere('company','LIKE', '%'.$keyword.'%');
            return $defaultQuery;
        })->paginate(20);
    }
}