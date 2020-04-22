<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 22/03/2019
 * Time: 11:26
 */

namespace Faqs\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Faqs\Repositories\FaqsItemRepository;
use Faqs\Repositories\FaqsRepository;
use Illuminate\Http\Request;

class ApiFaqsController extends BaseController
{
    protected $repository;
    protected $item_repository;

    public function __construct(FaqsRepository $faqsRepository,FaqsItemRepository $faqsItemRepository)
    {
        $this->repository = $faqsRepository;
        $this->item_repository = $faqsItemRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function get(Request $request)
    {
        $id = $request->get('id');

        try {

            $faqs = $this->repository->with(['getFaqsItem' => function($relationQuery) {
                return $relationQuery->select('id', 'question', 'answer', 'group', 'status', 'sort')->orderBy('sort', 'asc')->where('status', 'active');
            }])->findWhere(['id' => $id]);

            if ($faqs->isEmpty()) {
                return [];
            }

            foreach ($faqs->first()->getFaqsItem as $k => $f) {
                $list = $faqs->first()->getFaqsItem;
                if ($k == 0) {
                    $list[$k]['toggle'] = true;
                } else {
                    $list[$k]['toggle'] = false;
                }
            }

            return $faqs->first();

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }

    }

    public function getAll(Request $request)
    {

        try {

            $faqs = $this->repository->with('getFaqsItem')->all();
            return $faqs;

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }

    }

    public function getAllFaq(Request $request)
    {

        try {

            $faqs = $this->item_repository->paginate(10);
            return $faqs;

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }

    }
}