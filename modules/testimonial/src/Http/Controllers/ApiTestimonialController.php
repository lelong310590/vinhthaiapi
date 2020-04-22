<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 20/03/2019
 * Time: 14:17
 */

namespace Testimonial\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Testimonial\Repositories\TestimonialRepository;

class ApiTestimonialController extends BaseController
{
    protected $repository;

    public function __construct(TestimonialRepository $testimonialRepository)
    {
        $this->repository = $testimonialRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function get(Request $request)
    {
        $limit = $request->get('limit');

        try {
            $data = $this->repository->scopeQuery(function ($q) use ($limit) {
                return $q->select('id', 'name', 'office', 'company', 'content', 'index', 'thumbnail', 'status')
                    ->where('status', 'active')
                    ->orderBy('index', 'asc')
                    ->take($limit);
            })->all();

            return $data;
        } catch (\Exception $e) {
            return response()->json(['message' => config('messages.error')])->setStatusCode(500);
        }
    }
}
