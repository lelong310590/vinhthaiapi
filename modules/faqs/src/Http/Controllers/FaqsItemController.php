<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/2/2018
 * Time: 3:19 PM
 */

namespace Faqs\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Faqs\Repositories\FaqsItemRepository;
use Faqs\Repositories\FaqsRepository;
use Illuminate\Http\Request;
use Base\Supports\FlashMessage;

class FaqsItemController extends BaseController
{
    protected $faqsItem;

    public function __construct(FaqsItemRepository $faqsItemRepository)
    {
        $this->faqsItem = $faqsItemRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex(Request $request)
    {
        $keyword = $request->get('keyword');

        if($keyword){
            $faqItems = $this->faqsItem->getSearch($keyword);
        }else {
            $faqItems = $this->faqsItem->with(['getFaqs' => function($q) {
                $q->select('id', 'name');
            }])->orderBy('sort', 'asc')->orderBy('created_at')->paginate(20);
        }

        return view('lito-faqs::item.index', [
            'data' => $faqItems
        ]);
    }

    /**
     * @param FaqsRepository $faqsRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate(FaqsRepository $faqsRepository)
    {
        $faqsGroup = $faqsRepository->orderBy('created_at', 'desc')->findWhere(['status' => 'active']);
        return view('lito-faqs::item.create', [
            'faqs' => $faqsGroup
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Request $request)
    {
        $input = $request->except(['_token']);

        try {
            $faqs = $this->faqsItem->create($input);
            do_action('lito_before_create_faqs',$faqs->question,'Thêm mới','Hỏi đáp');
            if ($request->has('continue_edit')) {
                return redirect()->route('lito::faqsitem.edit.get', [
                    'id' => $faqs->id
                ])->with(FlashMessage::returnMessage('create'));
            }

            return redirect()->route('lito::faqsitem.index.get')->with(FlashMessage::returnMessage('create'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * @param $id
     * @param FaqsRepository $faqsRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id, FaqsRepository $faqsRepository)
    {
        $faqsGroup = $faqsRepository->orderBy('created_at', 'desc')->findWhere(['status' => 'active']);
        $data = $this->faqsItem->find($id);
        return view('lito-faqs::item.edit', [
            'data' => $data,
            'faqs' => $faqsGroup
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
           $faqs = $this->faqsItem->update($input, $id);
            do_action('lito_before_edit_faqs',$faqs->question,'Sửa','Hỏi đáp');
            return redirect()->route('lito::faqsitem.index.get')->with(FlashMessage::returnMessage('edit'));
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
        $olditem = $this->faqsItem->find($id);
        do_action('lito_before_edit_faqs',$olditem->question,'Sửa','Hỏi đáp');
        return getDelete($id, $this->faqsItem);
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
            $this->faqsItem->update([
                'status' => 'disable'
            ], $id);
        }

        if ($status == 'disable') {
            $this->faqsItem->update([
                'status' => 'active'
            ], $id);
        }

        return redirect()->back()->with(FlashMessage::returnMessage('edit'));
    }
}