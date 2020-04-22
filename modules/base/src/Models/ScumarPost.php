<?php
/**
 * Created by PhpStorm.
 * User: Wiseman
 * Date: 6/5/2019
 * Time: 10:58 AM
 */

namespace Base\Models;

use Illuminate\Database\Eloquent\Model;

class ScumarPost extends Model
{
    protected $connection = 'mysql_scu';
    protected $table = 'posts';

    public function getTermTaxonomy()
    {
        return $this->belongsToMany(ScumarTaxonomy::class, 'term_relationships', 'object_id', 'term_taxonomy_id');
    }
}