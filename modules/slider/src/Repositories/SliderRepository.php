<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/22/2019
 * Time: 2:51 PM
 */

namespace Slider\Reposotories;

use Prettus\Repository\Eloquent\BaseRepository;
use Slider\Models\Slider;


class SliderRepository extends BaseRepository
{
    public function model()
    {
        return Slider::class;
    }
}