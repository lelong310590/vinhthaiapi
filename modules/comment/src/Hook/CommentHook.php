<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/25/2019
 * Time: 3:27 PM
 */

namespace Comment\Hook;

use Comment\Models\Comment;

class CommentHook
{
    public function handle()
    {
        $comment = Comment::where('approved','cancel')->count();
        echo view('lito-comment::partials.sidebar',['comment_num'=>$comment]);
    }
}