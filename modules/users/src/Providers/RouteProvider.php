<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/31/2017
 * Time: 2:22 PM
 */

namespace Users\Providers;

use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider as ServiceProvider;

class RouteProvider extends ServiceProvider
{
    protected $namespace = 'Users\Http\Controllers';

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
            'prefix' => 'services'
        ], function ($router) {
            require __DIR__ . '/../../routes/api.php';
        });
    }
}