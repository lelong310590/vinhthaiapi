<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/25/2019
 * Time: 8:30 PM
 */

namespace Testimonial\Hook;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class HistoryTestimonialHook
{
    public function handle()
    {

    }

    public static function createHis($desc,$method,$module)
    {
        createHistory($desc, $method, $module);
    }

}