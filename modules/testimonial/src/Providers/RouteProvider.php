<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 19/03/2019
 * Time: 02:06
 */

namespace Testimonial\Providers;

use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider as ServiceProvider;

class RouteProvider extends ServiceProvider
{
    protected $namespace = 'Testimonial\Http\Controllers';

    public function boot()
    {
        Route::pattern('id', '[0-9]+');
        parent::boot(); // TODO: Change the autogenerated stub
    }

    public function map()
    {
        $this->mapWebRoutes();
        $this->mapApiRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => ['web'],
            'namespace' => $this->namespace
        ], function ($router) {
            require __DIR__ . '/../../routes/web.php';
        });
    }

    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace' => $this->namespace,
            'prefix' => 'v1'
        ], function ($router) {
            require __DIR__ . '/../../routes/api.php';
        });
    }
}