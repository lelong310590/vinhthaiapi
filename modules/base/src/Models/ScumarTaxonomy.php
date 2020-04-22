<?php
/**
 * Created by PhpStorm.
 * User: Wiseman
 * Date: 6/5/2019
 * Time: 11:05 AM
 */

namespace Base\Models;

use Illuminate\Database\Eloquent\Model;

class ScumarTaxonomy extends Model
{
    protected $connection = 'mysql_scu';
    protected $table = 'term_taxonomy';

    public function getPost()
    {
        return $this->belongsToMany(ScumarTaxonomy::class, 'term_relationships', 'term_taxonomy_id', 'object_id');
    }

    public function getTerm()
    {
        return $this->belongsTo(ScumarTerm::class, 'term_id', 'term_id');
    }
}