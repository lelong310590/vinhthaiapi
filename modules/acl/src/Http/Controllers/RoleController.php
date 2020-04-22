<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/26/2017
 * Time: 11:35 AM
 */

namespace Acl\Http\Controllers;

use Acl\Http\Requests\CreateRoleValidate;
use Acl\Http\Requests\EditRoleValidate;
use Acl\Repositories\PermissionRepository;
use Acl\Repositories\RoleRepository;
use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;

class RoleController extends BaseController
{
	private $role;
	
	function __construct(RoleRepository $roleRepository)
	{
		$this->role = $roleRepository;
	}
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getIndex()
	{
		$roles = $this->role->paginate(20);
		return view('lito-acl::components.role.index', [
			'data' => $roles
		]);
	}
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getCreate()
	{
		return view('lito-acl::components.role.create');
	}
	
	/**
	 * @param \Acl\Http\Requests\CreateRoleValidate $request
	 *
	 * @return $this|\Illuminate\Http\RedirectResponse
	 */
	public function postCreate(CreateRoleValidate $request)
	{
		try {
			$input = $request->except(['_token', 'continue_edit']);
			$role = $this->role->create($input);

            do_action('lito_before_create_new_role',$role->name,'Thêm mới','Vai trò');

			if ($request->has('continue_edit')) {
				return redirect()->route('lito::role.edit.get', [
					'id' => $role->id
				])->with(FlashMessage::returnMessage('create'));
			}
			
			return redirect()->route('lito::role.index.get')->with(FlashMessage::returnMessage('create'));
		} catch (\Exception $e) {
			return redirect()->back()->withErrors($e->getMessage());
		}
		
	}
	
	/**
	 * @param                                        $id
	 * @param \Acl\Repositories\PermissionRepository $permissionRepository
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getEdit($id, PermissionRepository $permissionRepository)
	{
        $role = $this->role->find($id);
        $perms = $permissionRepository->orderBy('module', 'asc')->orderBy('created_at', 'asc')->all();
        $currentPermision = $role->perms()->get()->toArray();
		$args = [];
		foreach ($currentPermision as $perm) {
			$args[] = $perm['id'];
		}

		return view('lito-acl::components.role.edit', [
			'data' => $role,
			'perms' => $perms,
			'currentPermision' => $args
		]);
	}
	
	/**
	 * @param                                     $id
	 * @param \Acl\Http\Requests\EditRoleValidate $request
	 *
	 * @return $this|\Illuminate\Http\RedirectResponse
	 */
	public function postEdit($id, EditRoleValidate $request)
	{
		try {
			$input = $request->only(['description', 'display_name', 'name', 'edited_by']);

			$edit = $this->role->update($input, $id);

			$this->role->sync($id, 'perms', $request->permission);

            do_action('lito_before_edit_role',$edit->name,'Sửa','Vai trò');
			
			return redirect()->back()->with(FlashMessage::returnMessage('edit'));
		} catch (\Exception $e) {
			return redirect()->back()->withErrors(config('messages.error'));
		}
	}
	
	/**
	 * @param $id
	 *
	 * @return $this|\Illuminate\Http\RedirectResponse
	 */
	public function getDelete($id)
	{
		try {
			$role = $this->role->find($id);
			$userRole = $role->users()->get();

            do_action('lito_before_delete_role',$role->name,'Xóa','Vai trò');

			if (count($userRole) == 0) {
				$this->role->delete($id);
				return redirect()->back()->with(FlashMessage::returnMessage('delete'));
			} else {
				return redirect()->back()->withErrors(config('messages.role_error'));
			}
		} catch (\Exception $e) {
			return redirect()->back()->withErrors(config('messages.role_error'));
		}
	}
	
}