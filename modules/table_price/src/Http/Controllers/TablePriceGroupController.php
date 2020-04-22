<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 02/04/2019
 * Time: 14:26
 */

namespace TablePrice\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use TablePrice\Repositories\TablePriceGroupRepository;
use Illuminate\Http\Request;
use Auth;

class TablePriceGroupController extends BaseController
{
    protected $repository;

    public function __construct(TablePriceGroupRepository $tablePriceGroupRepository)
    {
        $this->repository = $tablePriceGroupRepository;
    }

    /**
     * @param Request $request
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

        return view('lito-table-price::group.index', [
            'data' => $data
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate()
    {
        return view('lito-table-price::group.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $input = $request->except(['_token']);

        try {

            $create = $this->repository->create($input);

            do_action('lito_before_create_table_price',$create->name,'Thêm mới','Nhóm bảng giá');


            return redirect()->route('lito::tablepricegroup.index.get')->with(FlashMessage::returnMessage('create'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        $data = $this->repository->find($id);
        return view('lito-table-price::group.edit', [
            'data' => $data
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request, $id)
    {
        $input = $request->except('_token');

        try {

            $edit = $this->repository->update($input, $id);

            do_action('lito_before_edit_table_price',$edit->name,'Sửa','Nhóm bảng giá');

            return redirect()->route('lito::tablepricegroup.index.get')->with(FlashMessage::returnMessage('edit'));

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

        do_action('lito_before_delete_table_price',$olditem->name,'Xóa','Nhóm bảng giá');

        return getDelete($id, $this->repository);
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

        if ($status == 'active') {
            $this->repository->update([
                'status' => 'disable'
            ], $id);
        }

        if ($status == 'disable') {
            $this->repository->update([
                'status' => 'active'
            ], $id);
        }

        do_action('lito_before_edit_table_price','Trạng thái','Sửa','Nhóm bảng giá');

        return redirect()->back()->with(FlashMessage::returnMessage('edit'));
    }
}