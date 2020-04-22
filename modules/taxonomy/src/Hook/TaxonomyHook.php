<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/5/2019
 * Time: 4:07 PM
 */
namespace Taxonomy\Hook;

class TaxonomyHook
{
    public function handle()
    {
        echo view('lito-taxonomy::partials.sidebar');
    }
}