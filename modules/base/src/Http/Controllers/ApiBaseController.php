<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 09/04/2019
 * Time: 17:06
 */

namespace Base\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Post\Repositories\PostRepositories;

class ApiBaseController extends BaseController
{
    /**
     * @param Request $request
     * @param PostRepositories $postRepositories
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function search(Request $request, PostRepositories $postRepositories)
    {
        $keywords = str_slug($request->get('keywords'));

        try {

            $result = $postRepositories->with('author')->scopeQuery(function ($q) use ($keywords) {
                return $q->where('post_title', 'LIKE', '%'.$keywords.'%')->where('post_status', 'publish')->where('post_type', 'post');
            })->paginate(9);

            return $result;

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }
    }
}