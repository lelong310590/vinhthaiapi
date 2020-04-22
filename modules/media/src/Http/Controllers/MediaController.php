<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 25/03/2019
 * Time: 11:38
 */

namespace Media\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;

class MediaController extends BaseController
{
    public function getIndex()
    {
        return view('lito-media::index');
    }
}