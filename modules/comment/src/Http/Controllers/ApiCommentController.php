<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/25/2019
 * Time: 4:13 PM
 */

namespace Comment\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Comment\Repositories\CommentRepository;
use Illuminate\Http\Request;

class ApiCommentController extends BaseController
{
    protected $com;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->com = $commentRepository;
    }

    public function postComment(Request $request)
    {
        $default = 'http://lito.vn/logo.png';
        $size = 50;
        $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $request->email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
        $data = [
            'post_id' => $request->post_id,
            'name'=> $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'comment_content' => $request->comment_content,
            'website' => $request->website,
            'thumbnail' => $grav_url
        ];
        if($request->get('parent')){
            $data['parent'] = $request->get('parent');
        }
        try{
            $this->com->create($data);
            return response()->json(['message' => 'success'])->setStatusCode(200);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }
    }

    public function getCommentByPost(Request $request)
    {
        $post_id = $request->get('post_id');
        try{
            $data = $this->com->getParentComment($post_id);
            return $data;
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }

    }

}