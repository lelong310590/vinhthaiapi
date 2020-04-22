<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 15/03/2019
 * Time: 15:10
 */

namespace TablePrice\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Illuminate\Http\Request;
use TablePrice\Http\Requests\CreateTablePriceRequest;
use TablePrice\Repositories\TablePriceGroupRepository;
use TablePrice\Repositories\TablePriceRepository;
use Illuminate\Support\Facades\Auth;

class TablePriceController extends BaseController
{
    protected $repository;

    public function __construct(TablePriceRepository $tablePriceRepository)
    {
        $this->repository = $tablePriceRepository;
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
            $data = $this->repository->with('getGroup')->orderBy('created_at', 'desc')->paginate(20);
        }

        return view('lito-table-price::index', [
            'data' => $data
        ]);
    }

    /**
     * @param TablePriceGroupRepository $tablePriceGroupRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate(TablePriceGroupRepository $tablePriceGroupRepository)
    {
        $group = $tablePriceGroupRepository->findWhere([
            'status' => 'active'
        ]);
        return view('lito-table-price::create', [
            'group' => $group
        ]);
    }

    /**
     * @param CreateTablePriceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(CreateTablePriceRequest $request)
    {
        $input = $request->except(['_token', 'continue_edit']);

        try {

            $create = $this->repository->create($input);

            do_action('lito_before_create_table_price',$create->name,'Thêm mới','Bảng giá');

            if ($request->has('continue_edit')) {
                return redirect()->route('lito::tableprice.create.get')->with(FlashMessage::returnMessage('create'));
            }

            return redirect()->route('lito::tableprice.index.get')->with(FlashMessage::returnMessage('create'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * @param $id
     * @param TablePriceGroupRepository $tablePriceGroupRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id, TablePriceGroupRepository $tablePriceGroupRepository)
    {
        $data = $this->repository->find($id);

        $group = $tablePriceGroupRepository->findWhere([
            'status' => 'active'
        ]);

        return view('lito-table-price::edit', [
            'data' => $data,
            'group' => $group
        ]);
    }

    /**
     * @param CreateTablePriceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(CreateTablePriceRequest $request, $id)
    {
        $input = $request->except('_token');

        try {

            $edit = $this->repository->update($input, $id);

            do_action('lito_before_edit_table_price',$edit->name,'Sửa','Bảng giá');

            return redirect()->route('lito::tableprice.index.get')->with(FlashMessage::returnMessage('edit'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getDelete($id)
    {
        $olditem = $this->repository->find($id);
        do_action('lito_before_delete_table_price',$olditem->name,'Xóa','Bảng giá');

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

        do_action('lito_before_edit_table_price','Trạng thái','Sửa','Bảng giá');

        return redirect()->back()->with(FlashMessage::returnMessage('edit'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getMain(Request $request)
    {
        $main = $request->get('main');
        $id = $request->get('id');

        $edited_by = Auth::id();

        try {
            $this->repository->update([
                'main' => $main,
                'edited_by' => $edited_by
            ], $id);

            do_action('lito_before_edit_table_price','Trạng thái','Sửa','Bảng giá');

            return redirect()->back()->with(FlashMessage::returnMessage('edit'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

    }

}