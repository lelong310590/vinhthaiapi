<?php
/**
 * Created by PhpStorm.
 * User: Wiseman
 * Date: 6/5/2019
 * Time: 11:22 AM
 */

namespace Base\Models;

use Illuminate\Database\Eloquent\Model;

class ScumarTerm extends Model
{
    protected $connection = 'mysql_scu';
    protected $table = 'terms';
}