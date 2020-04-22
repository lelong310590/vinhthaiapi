<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/11/2019
 * Time: 2:34 PM
 */

namespace Menu\Repositories;

use Menu\Models\Menu;
use Prettus\Repository\Eloquent\BaseRepository;

class MenuRepositories extends BaseRepository
{
    public function model()
    {
        return Menu::class;
    }
}