<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/18/2019
 * Time: 3:51 PM
 */

namespace Taxonomy\Models;


use Illuminate\Database\Eloquent\Model;

class TaxonomyMeta extends Model
{
    protected $table = 'taxonomy_meta';

    protected $fillable= [
        'id','taxonomy_id','meta_key','meta_value'
    ];
}