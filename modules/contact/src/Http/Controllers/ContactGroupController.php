<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 03/05/2019
 * Time: 10:34
 */

namespace Contact\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Contact\Repositories\ContactGroupRepository;
use Contact\Repositories\ContactRepository;
use Illuminate\Http\Request;

class ContactGroupController extends BaseController
{
    protected $repository;

    public function __construct(ContactGroupRepository $contactGroupRepository)
    {
        $this->repository = $contactGroupRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex(Request $request)
    {
        $keyword = $request->get('keyword');

        if($keyword){
            $data = $this->repository->getSearch($keyword);
        }else {
            $data = $this->repository->orderBy('created_at', 'desc')->paginate(20);
        }

        return view('lito-contact::group.index', [
            'data' => $data
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate()
    {
        return view('lito-contact::group.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $input = $request->except(['_token']);
        try {
            $contactGroup = $this->repository->create($input);
            do_action('lito_before_create_contact_group',$contactGroup->name, 'Thêm mới', 'Form liên hệ');

            if ($request->has('continue_edit')) {
                return redirect()->back()->with(FlashMessage::returnMessage('create'));
            }

            return redirect()->route('lito-contact::group.index')->with(FlashMessage::returnMessage('create'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

    /**
     * @param $id
     * @param ContactRepository $contactRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id, ContactRepository $contactRepository)
    {
        $contacts = $contactRepository->orderBy('created_at','desc')->scopeQuery(function ($q) use ($id) {
            return $q->where('group', $id);
        })->paginate(20);

        $data = $this->repository->find($id);

        return view('lito-contact::group.edit', [
            'data' => $data,
            'group'=>$id,
            'contacts' => $contacts
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit($id, Request $request)
    {
        $input = $request->except(['_token']);

        try {
            $edit = $this->repository->update($input, $id);
            do_action('lito_before_edit_contact_group',$edit->name,'Sửa','Form liên hệ');
            return redirect()->back()->with(FlashMessage::returnMessage('edit'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getDelete($id)
    {
        $olditem = $this->repository->find($id);
        do_action('lito_before_delete_contact_group',$olditem->name,'Xóa','Form liên hệ');
        return getDelete($id, $this->repository);
    }
}