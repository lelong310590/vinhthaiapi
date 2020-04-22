<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/25/2019
 * Time: 3:44 PM
 */

namespace Comment\Repositories;


use Comment\Models\Comment;
use Prettus\Repository\Eloquent\BaseRepository;

class CommentRepository extends BaseRepository
{
    public function model()
    {
        return Comment::class;
    }

    public function getParentComment($post_id){
        $data = $this->scopeQuery(function ($e) use($post_id){
            return $e->orderBy('created_at','desc')
                ->where([
                    'post_id'=>$post_id,
                    'approved'=>'accept'
                ]);
        })->all();
       return $this->recursiveComment($data);
    }

    public function recursiveComment($data, $parent = 0)
    {
        $arr = [];
        foreach ($data as $val)
        {
            $key =[];
            $ids = $val['id'];
            $key['name'] = $val['name'];
            $key['email'] = $val['email'];
            $key['website'] = $val['website'];
            $key['parent'] = $val['parent'];
            $key['comment_content'] = $val['comment_content'];
            if ($val['parent'] == $parent) {
                $children = $this->recursiveComment($data, $ids);
                $key['children'] = $children;
                $arr[] = $key;
            }
        }
        return $arr;
    }

}