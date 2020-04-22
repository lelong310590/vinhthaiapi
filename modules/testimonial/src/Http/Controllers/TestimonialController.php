<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 19/03/2019
 * Time: 02:17
 */

namespace Testimonial\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Illuminate\Http\Request;
use Testimonial\Hook\HistoryTestimonialHook;
use Testimonial\Http\Requests\TestimonialCreateRequest;
use Testimonial\Repositories\TestimonialRepository;

class TestimonialController extends BaseController
{
    protected $repository;

    public function __construct(TestimonialRepository $testimonialRepository)
    {
        $this->repository = $testimonialRepository;
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

        return view('lito-testimonial::index', [
            'data' => $data
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate()
    {
        return view('lito-testimonial::create');

    }

    /**
     * @param TestimonialCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(TestimonialCreateRequest $request)
    {
        $input = $request->except('_token');

        try {

            $create = $this->repository->create($input);

            do_action('lito_before_create_testimonial',$create->name,'Thêm mới','Ý kiến khách hàng');

            if ($request->has('continue_edit')) {
                return redirect()->route('lito::testimonial.create.get')->with(FlashMessage::returnMessage('create'));
            }

            return redirect()->route('lito::testimonial.index.get')->with(FlashMessage::returnMessage('create'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        $data = $this->repository->find($id);
        return view('lito-testimonial::edit', [
            'data' => $data
        ]);
    }

    /**
     * @param TestimonialCreateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(TestimonialCreateRequest $request, $id)
    {
        $input = $request->except('_token');

        try {

           $edit = $this->repository->update($input, $id);

            do_action('lito_before_edit_testimonial',$edit->name,'Sửa','Ý kiến khách hàng');

            return redirect()->route('lito::testimonial.index.get')->with(FlashMessage::returnMessage('edit'));

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
        do_action('lito_before_delete_testimonial',$olditem->name,'Xóa','Ý kiến khách hàng');

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

        do_action('lito_before_edit_testimonial','Trạng thái','Sửa','Ý kiến khách hàng');

        return redirect()->back()->with(FlashMessage::returnMessage('edit'));
    }
}