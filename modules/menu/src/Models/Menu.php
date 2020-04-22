<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/11/2019
 * Time: 2:36 PM
 */

namespace Menu\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
   protected $table = 'menu';

   protected $fillable = [
       'id','name', 'slug','position', 'status','created_at','updated_at','created_by','edited_by'
   ];

}