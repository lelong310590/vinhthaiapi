<?php
/**
 * Created by PhpStorm.
 * User: Wiseman
 * Date: 5/18/2019
 * Time: 11:03 AM
 */

namespace Product\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;
use Product\Models\Product;

class ProductRepository extends BaseRepository
{
    public function model()
    {
        return Product::class;
    }
}