<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/6/2017
 * Time: 11:23 PM
 */
namespace Users\Http\Controllers;

use Acl\Repositories\RoleRepository;
use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Users\Http\Requests\UserCreateRequest;
use Users\Http\Requests\UserEditRequest;
use Users\Repositories\UsersRepository;

class UsersController extends BaseController
{
	protected $users;
	
	public function __construct(UsersRepository $repository)
	{
		$this->users = $repository;
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getIndex(Request $request)
	{
        $keyword = $request->get('keyword');

        if($keyword){
            $users = $this->users->getSearch($keyword);
        }else {
            $users = $this->users->orderBy('created_at', 'desc')->paginate(20);
        }

        return view('lito-users::components.index', [
            'data' => $users
        ]);
	}
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getCreate(RoleRepository $roleRepository)
	{
		$role = $roleRepository->all();
		return view('lito-users::components.create', [
			'role' => $role
		]);
	}



    /**
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
	public function postCreate(UserCreateRequest $request)
	{
		try {
			$data = $request->except(['_token', 'continue_edit']);
			$user = $this->users->create($data);
			$user->roles()->sync($data['role']);

            do_action('lito_before_create_new_user',$user->email,'Thêm mới','Tài khoản');

			if ($request->has('continue_edit')) {
				return redirect()->route('lito::users.create.get')->with(FlashMessage::returnMessage('create'));
			}

			return redirect()->route('lito::users.index.get')->with(FlashMessage::returnMessage('create'));
			
		} catch (\Exception $e) {
			return redirect()->back()->withErrors(config('messages.error'));
		}
	}
	
	/**
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getEdit($id, RoleRepository $roleRepository)
	{
		$user = $this->users->find($id);
		$roles = $roleRepository->all();
		return view('lito-users::components.edit', [
			'data' => $user,
			'role' => $roles
		]);
	}
	
	/**
	 * @param \Users\Http\Requests\UserEditRequest $request
	 */
	public function postEdit($id, UserEditRequest $request)
	{
		try {
			if ($request->get('password') == null) {
				$data = $request->except(['_token', 'email', 'password', 're_password']);
			} else {
				$data = $request->except(['_token', 'email']);
			}
			$user = $this->users->update($data, $id);
			$user->roles()->sync($data['role']);

            do_action('lito_before_edit_user',$user->username,'Sửa','Tài khoản');

			return redirect()->route('lito::users.index.get')->with(FlashMessage::returnMessage('edit'));
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
	    $olditem = $this->users->find($id);
        do_action('lito_before_delete_new_user',$olditem->username,'Xóa','Tài khoản');

		return getDelete($id, $this->users);
	}

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function getStatus(Request $request)
    {
        $status = $request->get('status');
        $id = $request->get('id');

        $currentId = Auth::id();

        if ($id == $currentId) {
            return redirect()->back()->withErrors('Không thể thay đổi trạng thái tài khoản hiện dùng');
        }

        if ($status == 'active') {
            $this->users->update([
                'status' => 'disable'
            ], $id);
        }

        if ($status == 'disable') {
            $this->users->update([
                'status' => 'active'
            ], $id);
        }

        do_action('lito_before_edit_user');

        return redirect()->back()->with(FlashMessage::returnMessage('edit'));
    }

}