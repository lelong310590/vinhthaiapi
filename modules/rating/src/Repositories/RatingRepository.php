<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/30/2019
 * Time: 3:43 PM
 */

namespace Rating\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;
use Rating\Models\Rating;

class RatingRepository extends BaseRepository
{
    public function model()
    {
        return Rating::class;
    }
}