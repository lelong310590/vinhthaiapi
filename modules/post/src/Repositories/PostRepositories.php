<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/12/2019
 * Time: 3:32 PM
 */

namespace Post\Repositories;


use Post\Models\Post;
use Prettus\Repository\Eloquent\BaseRepository;

class PostRepositories extends BaseRepository
{
    public function model()
    {
        return Post::class;
    }



}