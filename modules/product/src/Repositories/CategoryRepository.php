<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/19/2019
 * Time: 10:56 PM
 */

namespace Product\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;
use Product\Models\Category;

class CategoryRepository extends BaseRepository
{

    public function model()
    {
        return Category::class;
    }

}