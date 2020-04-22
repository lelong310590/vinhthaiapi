<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 24/03/2019
 * Time: 17:26
 */

namespace Plugin\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Plugin\Repositories\PluginRepository;
use Illuminate\Support\Facades\Artisan;

class PluginController extends BaseController
{
    protected $repository;

    public function __construct(PluginRepository $pluginRepository)
    {
        $this->repository = $pluginRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex(Request $request)
    {
        $keyword = $request->get('keyword');

        if($keyword){
            $data = $this->repository->getSearch($keyword);
        }else {
            $data = $this->repository->orderBy('created_at', 'desc')->all([
                'id', 'name', 'description', 'path', 'status', 'core', 'created_at'
            ]);
        }

        return view('lito-plugin::index', [
            'data' => $data
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function getStatus(Request $request)
    {
        try {
            $status = $request->get('status');
            $id = $request->get('id');
            $plugins = $this->repository->find($id);

            if ($status == 'active') {
                $this->repository->update([
                    'status' => 'disable',
                    'edited_by' => Auth::id()
                ], $id);

                $this->changePluginStatus($plugins->path, false);
            }

            if ($status == 'disable') {
                $this->repository->update([
                    'status' => 'active',
                    'edited_by' => Auth::id()
                ], $id);

                $this->changePluginStatus($plugins->path, true);
            }

            Artisan::call('view:clear');
            Artisan::call('route:clear');

            return redirect()->route('lito::plugin.index.get')->with(FlashMessage::returnMessage('edit'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

    }

    /**
     * @param $path
     * @param $status
     */
    public function changePluginStatus($path, $status)
    {
        $moduleProviderPath = __DIR__.'./../../../../base/src/Providers/ModuleProvider.php';

        if ($status == true) {
            $oldText = '//$this->app->register('.$path.');';
            $newText = '$this->app->register('.$path.');';
        } else {
            $oldText = '$this->app->register('.$path.');';
            $newText = '//$this->app->register('.$path.');';
        }

        $str = file_get_contents($moduleProviderPath);

        $str = str_replace("$oldText", "$newText",$str);

        file_put_contents($moduleProviderPath, $str);
    }
}