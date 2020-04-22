<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/23/2019
 * Time: 11:29 AM
 */

namespace Slider\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;
use Slider\Models\GroupSlide;

class GroupSlideRepository extends BaseRepository
{
    public function model()
    {
        return GroupSlide::class;
    }
}