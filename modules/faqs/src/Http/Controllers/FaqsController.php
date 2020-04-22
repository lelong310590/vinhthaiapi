<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/2/2018
 * Time: 2:44 PM
 */

namespace Faqs\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Faqs\Http\Requests\FaqsValidate;
use Faqs\Repositories\FaqsRepository;
use Illuminate\Http\Request;

class FaqsController extends BaseController
{
    protected $faqs;

    public function __construct(FaqsRepository $faqsRepository)
    {
        $this->faqs = $faqsRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex(Request $request)
    {
        $keyword = $request->get('keyword');

        if($keyword){
            $faqs = $this->faqs->getSearch($keyword);
        }else {
            $faqs = $this->faqs->orderBy('created_at', 'desc')->paginate(20);
        }

        return view('lito-faqs::group.index', [
            'data' => $faqs
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate()
    {
        return view('lito-faqs::group.create');
    }

    /**
     * @param FaqsValidate $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(FaqsValidate $request)
    {
        $input = $request->except(['_token']);

        try {
            $faqs = $this->faqs->create($input);
            do_action('lito_before_create_faqs',$faqs->name,'Thêm mới','Danh mục hỏi đáp');
            if ($request->has('continue_edit')) {
                return redirect()->route('lito::faqs.edit.get', [
                    'id' => $faqs->id
                ])->with(FlashMessage::returnMessage('create'));
            }

            return redirect()->route('lito::faqs.index.get')->with(FlashMessage::returnMessage('create'));
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
        $data = $this->faqs->find($id);
        return view('lito-faqs::group.edit', [
            'data' => $data
        ]);
    }

    /**
     * @param $id
     * @param FaqsValidate $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit($id, FaqsValidate $request)
    {
        $input = $request->except(['_token']);
        try {
            $edit = $this->faqs->update($input, $id);
            do_action('lito_before_edit_faqs',$edit->name,'Sửa','Danh mục hỏi đáp');
            return redirect()->route('lito::faqs.index.get')->with(FlashMessage::returnMessage('edit'));
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
        $olditem = $this->faqs->find($id);
        do_action('lito_before_delete_faqs',$olditem->name,'Xóa','Danh mục hỏi đáp');
        return getDelete($id, $this->faqs);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getStatus(Request $request)
    {
        $status = $request->get('status');
        $id = $request->get('id');

        if ($status == 'active') {
            $this->faqs->update([
                'status' => 'disable'
            ], $id);
        }

        if ($status == 'disable') {
            $this->faqs->update([
                'status' => 'active'
            ], $id);
        }

        return redirect()->back()->with(FlashMessage::returnMessage('edit'));
    }
}