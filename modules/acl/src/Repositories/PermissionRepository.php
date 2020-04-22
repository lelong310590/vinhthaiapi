<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/26/2017
 * Time: 11:38 AM
 */

namespace Acl\Repositories;

use Acl\Models\Permission;
use Prettus\Repository\Eloquent\BaseRepository;

class PermissionRepository extends BaseRepository
{
	public function model()
	{
		// TODO: Implement model() method.
		return Permission::class;
	}

    /**
     * @param $keyword
     * @return mixed
     */
	public function getSearch($keyword)
    {
        return $this->scopeQuery(function ($q) use ($keyword){
            $defaultQuery = $q->orderBy('created_at', 'desc')->select('name', 'display_name', 'description', 'module', 'id')
                ->where('name','LIKE', '%'.$keyword.'%')
                ->orWhere('display_name','LIKE', '%'.$keyword)
                ->orWhere('description','LIKE','%'.$keyword.'%');
            return $defaultQuery;
        })->paginate(20);
    }
}