<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/6/2017
 * Time: 10:45 PM
 */

namespace Users\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Users\Models\Users;

class UsersRepository extends BaseRepository
{
	public function model()
	{
		return Users::class;
	}

    /**
     * @param $data
     * @return bool
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
	public function registerUser($data)
    {
        $email = $data['email'];
        $check = $this->findWhere(['email' => $email]);
        if ($check->isNotEmpty()) {
            return false;
        }

        $user = $this->create($data);
        return $user;
    }

    /**
     * @param $keyword
     * @return mixed
     */
    public function getSearch($keyword)
    {
        return $this->scopeQuery(function ($q) use ($keyword){
            $defaultQuery = $q->orderBy('created_at', 'desc')->select('username', 'email', 'full_name', 'phone', 'id', 'status', 'thumbnail')
                ->where('username','LIKE', '%'.$keyword.'%')
                ->orWhere('email','LIKE', '%'.$keyword)
                ->orWhere('full_name','LIKE','%'.$keyword.'%')
                ->orWhere('phone','LIKE','%'.$keyword.'%');
            return $defaultQuery;
        })->paginate(20);
    }
}