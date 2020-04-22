<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/11/2019
 * Time: 4:16 PM
 */

namespace Menu\Repositories;

use Menu\Models\MenuNode;
use Post\Models\Post;
use Prettus\Repository\Eloquent\BaseRepository;

class MenuNodeRepositories extends BaseRepository
{
    public function model()
    {
        return MenuNode::class;
    }

    public function getApiMenuNode($menu_id){
        $data = $this->scopeQuery(function ($e) use($menu_id){
            return $e->orderBy('index','asc')
                ->where([
                    'menu_id'=>$menu_id,
                    'status'=>'active'
                ]);
        })->all();

        return $this->recursiveMenu($data);
    }

    public function getMenuNode($menu_id){
        $data = $this->scopeQuery(function ($e) use($menu_id){
            return $e->orderBy('index','asc')
                ->where([
                    'menu_id'=>$menu_id
                ]);
        })->all();

        return $this->recursiveMenu($data);
    }

    public function recursiveMenu($data, $parent = 0)
    {
        $arr = [];
        foreach($data as $val){
            $ids = $val['id'];
            $key = [];
            $key['name'] = $val['name'];
            if($val['menu_type']=='page'){
                $typename = Post::find($val['type_id']);
                if($typename){
                    $key['slug'] = $typename->post_slug;
                }else{
                    $key['slug'] = '';
                }

            }else{
                $key['slug'] = $val['slug'];
            }

            $key['url'] = $val['url'];
            $key['is_home'] = $val['is_home'];
            $key['target'] = $val['target'];
            $key['id'] = $val['id'];
            $key['parent'] = $val['parent'];
            $key['menu_id'] = $val['menu_id'];
            $key['menu_type'] = $val['menu_type'];
            $key['type_id'] = $val['type_id'];
            $key['index'] = $val['index'];
            $key['status'] = $val['status'];
            if ($val['parent'] == $parent) {
                $sub = $this->recursiveMenu($data, $ids);
                $key['sub'] = $sub;
                $arr[] = $key;
            }
        }
        return $arr;
    }

}