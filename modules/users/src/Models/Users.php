<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/31/2017
 * Time: 4:52 PM
 */

namespace Users\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Laravel\Passport\HasApiTokens;

class Users extends Authenticatable
{
    use EntrustUserTrait, Notifiable, HasApiTokens;

    protected $table = 'users';

    protected $fillable = [
        'username', 'email', 'password', 'thumbnail', 'full_name', 'phone', 'status', 'created_at', 'updated_at', 'created_by', 'edited_by', 'description'
    ];

    protected $hidden = [
        'password', 'remember_token', 'google2fa_secret'
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }


    //Big block of caching functionality.
    public function cachedRoles()
    {
        $userPrimaryKey = $this->primaryKey;
        $cacheKey = 'entrust_roles_for_user_' . $this->$userPrimaryKey;
        return Cache::tags(Config::get('acl.role_user_table'))->remember($cacheKey, Config::get('cache.ttl'), function () {
            return $this->roles()->get();
        });
    }

    /**
     * @param array $options
     * @return bool
     */
    public function save(array $options = [])
    {   //both inserts and updates
        $result = parent::save($options);
        Cache::tags(Config::get('acl.role_user_table'))->flush();
        return $result;
    }

    /**
     * @param array $options
     * @return bool|null
     * @throws \Exception
     */
    public function delete(array $options = [])
    {   //soft or hard
        $result = parent::delete($options);
        Cache::tags(Config::get('acl.role_user_table'))->flush();
        return $result;
    }

    /**
     * @return mixed
     */
    public function restore()
    {   //soft delete undo's
        $result = parent::restore();
        Cache::tags(Config::get('acl.role_user_table'))->flush();
        return $result;
    }

    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Config::get('acl.role'), Config::get('acl.role_user_table'), Config::get('acl.user_foreign_key'), Config::get('acl.role_foreign_key'));
    }

    /**
     * Get role name
     * @return null
     */
    public function getRole()
    {
        $roles = $this->roles()->first();
        if (!empty($roles)) {
            return $roles->display_name;
        } else {
            return null;
        }
    }
}