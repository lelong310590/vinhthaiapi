<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/12/2019
 * Time: 11:50 AM
 */

namespace Taxonomy\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Taxonomy\Models\Taxonomy;

class TaxonomyRepositories extends BaseRepository
{
    public function model()
    {
       return Taxonomy::class;
    }
}