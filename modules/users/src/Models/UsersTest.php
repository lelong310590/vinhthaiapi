<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/4/2018
 * Time: 10:44 AM
 */

namespace Users\Models;

use Illuminate\Database\Eloquent\Model;
use Users\Models\Users;

class UsersTest extends Model
{
    protected $connection = 'mysql';

    protected $table = 'user_test';

    /**
     * Relation n - 1 with User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(Users::class);
    }
}