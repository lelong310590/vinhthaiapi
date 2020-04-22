<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/11/2019
 * Time: 1:53 PM
 */
namespace Post\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Illuminate\Http\Request;
use Post\Http\Requests\PostValidate;
use Post\Repositories\PostmetaRepositories;
use Post\Repositories\PostRepositories;
use Setting\Repositories\SettingRepositories;
use Taxonomy\Repositories\TaxonomyRepositories;
use Illuminate\Support\Str;

class PostController extends BaseController
{
    protected $ta;
    protected $tax;
    protected $meta;
    protected $set;

    public function __construct(PostRepositories $postRepositories,
                                TaxonomyRepositories $taxonomyRepositories,
                                PostmetaRepositories $postmetaRepositories,
                                SettingRepositories $settingRepositories)
    {
        $this->ta = $postRepositories;
        $this->tax = $taxonomyRepositories;
        $this->meta = $postmetaRepositories;
        $this->set = $settingRepositories;
    }

    public function savePostMeta($data)
    {
        foreach ($data as $key => $d) {
            $this->meta->updateOrCreate([
                'meta_key' => $key
            ], [
                'meta_value' => $d
            ]
            );
        }
    }

    public function getIndex(Request $request)
    {
        $post_type = $request->get('post_type');
        $keyword= $request->get('keyword');
        if($request->get('keyword')){
            $data = $this->ta->with('taxonomy')->scopeQuery(function ($d) use ($keyword){
                return $d->orderBy('created_at','desc')->where('post_title','like','%'.$keyword.'%');
            })->paginate(20);
            //dd($data);
        }else{
            $data = $this->ta->with('author')->scopeQuery(function ($e) use($post_type){
                return $e->orderBy('created_at','desc')->select('id','post_title','thumbnail','post_author','created_at','post_status','post_type','display')->where('post_type',$post_type);
            })->paginate(20);
        }

        return view('lito-post::index', ['data'=> $data,'post_type'=>$post_type]);
    }

    public function getCreate(Request $request)
    {
        $posttype = $request->get('post_type');
        $taxonomy = $this->tax->scopeQuery(function ($e) {
           return $e->orderBy('index','asc')->select('id','name','parent','slug')->where('taxonomy_type','category')
               ->get();
        })->all();

        $tags = $this->tax->scopeQuery(function ($q) {
           return $q->orderBy('id','desc')->select('id','name','slug')->where('taxonomy_type','tag')->limit(20)->get();
        })->all();

        return view('lito-post::create',['taxonomy'=>$taxonomy,'posttype'=>$posttype,'tags'=>$tags]);
    }

    public function postCreate(PostValidate $request)
    {
        $input = $request->except(['_token']);
        $slug = $request->get('post_slug');
        $old = $this->ta->findWhere(['post_slug'=>$slug]);
        if(!empty($old) && count($old)>0){
            return redirect()->back()->with(['message'=>'Tiêu đề bài viết đã có trên hệ thống !']);
        }
        $tagname = $request->tag_name;
        if(!empty($tagname)){
            $tagname = explode(',',$tagname);
        }
        $id = [];

        $settingPage = [
            'about_title_1' => $request->about_title_1,
            'about_title_larger_1'  => $request->about_title_larger_1,
            'about_desc_1'  => $request->about_desc_1,
            'about_title_button_1'  => $request->about_title_button_1,
            'about_title_link_1'  => $request->about_title_link_1,
            'about_title_box_1' => $request->about_title_box_1,
            'about_title_box_2' => $request->about_title_box_2,
            'about_desc_box_1'=> $request->about_desc_box_1,
            'about_desc_box_2' => $request->about_desc_box_2,
            'about_title_box_3' => $request->about_title_box_3,
            'about_title_box_4' => $request->about_title_box_4,
            'about_desc_box_3' => $request->about_desc_box_3,
            'about_desc_box_4' => $request->about_desc_box_4,
            'about_title_main_form_2' => $request->about_title_main_form_2,
            'about_desc_main_form_2' => $request->about_desc_main_form_2,
            'about_title_main_button_2' => $request->about_title_main_button_2,
            'about_link_main_form_2' => $request->about_link_main_form_2,
            'contact_form_title' => $request->contact_form_title,
            'contact_form_address' => $request->contact_form_address,
            'contact_form_phone_1' => $request->contact_form_phone_1,
            'contact_form_phone_2' => $request->contact_form_phone_2,
            'google_map_contact' => $request->google_map_contact
        ];

        try{
           $post = $this->ta->create($input);
            do_action('lito_before_create_post',$post->post_title,'Thêm mới','Bài viết');
            $seosetting = [
                'seo_title' => $request->seo_title,
                'seo_keyword' => $request->seo_keyword,
                'seo_description' => $request->seo_description,
                'facebook_title' => $request->facebook_title,
                'facebook_description' => $request->facebook_description,
                'facebook_image' => $request->facebook_image,
                'index_link' => $request->index_link,
                'follow_link' => $request->follow_link,
                'breadcrumb_title' => $request->breadcrumb_title,
                'canonical_url' => $request->canonical_url
            ];
            foreach($seosetting as $key => $val){
                $this->meta->create(['post_id'=>$post->id,'meta_key'=>$key,'meta_value'=>$val]);
            }

            if(!empty($settingPage)){
                foreach($settingPage as $k=>$v){
                    $this->set->updateOrCreate(['setting_key'=>$k],['setting_value'=>$v]);
                }
            }


           if(!empty($request->taxonomy_id)){
               $id = $request->taxonomy_id;
           }

           if(!empty($tagname) && count($tagname) > 0){
               foreach ($tagname as $key => $val){
                   $slug = Str::slug($val,'-');
                   $data = ['name'=>$val, 'slug'=>$slug,'taxonomy_type'=>'tag','parent'=>0,'index'=>0];

                   $old_tag = $this->tax->findWhere(['slug'=>$slug,'taxonomy_type'=>'tag'])->all();
                   if(!empty($old_tag) && count($old_tag) > 0){
                       foreach($old_tag as $t){
                           $id[] = $t->id;
                       }
                   }else{
                       $tagCreate =  $this->tax->create($data);
                       $id[] = $tagCreate->id;
                   }
               }

           }
            $this->ta->sync($post->id,'taxonomy',$id);

            if ($request->has('continue_edit')) {
                return redirect()->route('lito::post.create.get',['post_type'=>$post->post_type])->with
                (FlashMessage::returnMessage('create'));
            }
            return redirect()->route('lito::post.index.get',['post_type'=>$post->post_type])->with(FlashMessage::returnMessage('create'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getEdit($id, Request $request)
    {
        $posttype = $request->get('post_type');

        $data = $this->ta->find($id);

        $taxonomy = $this->tax->scopeQuery(function ($e) {
            return $e->orderBy('index','asc')->select('id','name','parent','slug')->where('taxonomy_type','category')
                ->get();
        })->all();
        //category selected
        $cateSelected = $data->taxonomy()->where('taxonomy_type','category')->get();
        $selected = [];
        foreach ($cateSelected as $c){
            $selected[] = $c->id;
        }
        //tag selected
        $tagSelected = $data->taxonomy()->where('taxonomy_type','tag')->get();

        $cattag = [];
        foreach($tagSelected as $t){
            $cattag[] = $t->name;
        }

        $cat = implode(',',$cattag);

        return view('lito-post::edit',
            ['data'=>$data, 'taxonomy'=>$taxonomy,'selected'=>$selected,'cat'=>$cat,'posttype'=>$posttype]
        );
    }

    public function postEdit($id, PostValidate $request)
    {
        $input = $request->except(['_token']);
        $tagname = $request->tag_name;
        $postype = $request->get('post_type');
        if(!empty($tagname)){
            $tagname = explode(',',$tagname);
        }

        $seosetting = [
            'seo_title' => $request->seo_title,
            'seo_keyword' => $request->seo_keyword,
            'seo_description' => $request->seo_description,
            'facebook_title' => $request->facebook_title,
            'facebook_description' => $request->facebook_description,
            'facebook_image' => $request->facebook_image,
            'index_link' => $request->index_link,
            'follow_link' => $request->follow_link,
            'breadcrumb_title' => $request->breadcrumb_title,
            'canonical_url' => $request->canonical_url,
            'daotao_name_1' => $request->daotao_name_1,
            'daotao_anh1' => $request->daotao_anh1,
            'daotao_mota1' => $request->daotao_mota1,
            'daotao_name_2' => $request->daotao_name_2,
            'daotao_anh2' => $request->daotao_anh2,
            'daotao_mota2' => $request->daotao_mota2,
            'daotao_name_3' => $request->daotao_name_3,
            'daotao_anh3' => $request->daotao_anh3,
            'daotao_mota3' => $request->daotao_mota3,
            'dichvu_anh_mota' => $request->dichvu_anh_mota,
            'dichvu_name_1' => $request->dichvu_name_1,
            'dichvu_anh1' => $request->dichvu_anh1,
            'dichvu_mota1' => $request->dichvu_mota1,
            'dichvu_name_2' => $request->dichvu_name_2,
            'dichvu_anh2' => $request->dichvu_anh2,
            'dichvu_mota2' => $request->dichvu_mota2,
            'dichvu_name_3' => $request->dichvu_name_3,
            'dichvu_anh3' => $request->dichvu_anh3,
            'dichvu_mota3' => $request->dichvu_mota3,
            'ggads_title'=> $request->ggads_title,
            'ggads_mota'=> $request->ggads_mota,
            'ggads_anh1'=> $request->ggads_anh1,
            'ggads_noidung1'=> $request->ggads_noidung1,
            'ggads_anh2'=> $request->ggads_anh2,
            'ggads_noidung2'=> $request->ggads_noidung2,
            'ggads_buoc1_title'=>$request->ggads_buoc1_title,
            'ggads_buoc1_des'=>$request->ggads_buoc1_des,
            'ggads_buoc2_title'=>$request->ggads_buoc2_title,
            'ggads_buoc2_des'=>$request->ggads_buoc2_des,
            'ggads_buoc3_title'=>$request->ggads_buoc3_title,
            'ggads_buoc3_des'=>$request->ggads_buoc3_des,
            'ggads_buoc4_title'=>$request->ggads_buoc4_title,
            'ggads_buoc4_des'=>$request->ggads_buoc4_des,
            'ggads_phidichvu'=>$request->ggads_phidichvu,
            'dichvu_noidung'=>$request->dichvu_noidung,
            'daotao_noidung'=>$request->daotao_noidung,
            'marketing_title'=>$request->marketing_title,
            'marketing_des'=>$request->marketing_des,
            'marketing_quytrinhlamviec'=>$request->marketing_quytrinhlamviec,
            'marketing_chuyengiatuvan'=>$request->marketing_chuyengiatuvan,
            'marketing_name_dv1'=>$request->marketing_name_dv1,
            'marketing_name_dv1_vn'=>$request->marketing_name_dv1_vn,
            'marketing_price_dv1'=>$request->marketing_price_dv1,
            'marketing_hd_dv1_vn'=>$request->marketing_hd_dv1_vn,
            'marketing_des_dv1'=>$request->marketing_des_dv1,
            'marketing_content_dv1'=>$request->marketing_content_dv1,
            'marketing_name_dv2'=>$request->marketing_name_dv2,
            'marketing_name_dv2_vn'=>$request->marketing_name_dv2_vn,
            'marketing_price_dv2'=>$request->marketing_price_dv2,
            'marketing_hd_dv2_vn'=>$request->marketing_hd_dv2_vn,
            'marketing_des_dv2'=>$request->marketing_des_dv2,
            'marketing_content_dv2'=>$request->marketing_content_dv2,
            'marketing_name_dv3'=>$request->marketing_name_dv3,
            'marketing_name_dv3_vn'=>$request->marketing_name_dv3_vn,
            'marketing_price_dv3'=>$request->marketing_price_dv3,
            'marketing_hd_dv3_vn'=>$request->marketing_hd_dv3_vn,
            'marketing_des_dv3'=>$request->marketing_des_dv3,
            'marketing_content_dv3'=>$request->marketing_content_dv3,
            'marketing_trietly'=>$request->marketing_trietly,
            'marketing_anhtrietly'=>$request->marketing_anhtrietly,
            'marketingtree_title'=>$request->marketingtree_title,
            'marketingtree_des'=>$request->marketingtree_des,
            'marketingtree_content'=>$request->marketingtree_content,
            'marketingtree_khaigiang_name'=>$request->marketingtree_khaigiang_name,
            'marketingtree_khaigiang_num'=>$request->marketingtree_khaigiang_num,
            'marketingtree_khaigiang_price'=>$request->marketingtree_khaigiang_price,
            'marketingtree_khaigiang_price_km'=>$request->marketingtree_khaigiang_price_km,
            'marketingtree_khaigiang_location'=>$request->marketingtree_khaigiang_location,
            'marketingtree_khaigiang_date'=>$request->marketingtree_khaigiang_date,
            'marketingtree_newbie'=>$request->marketingtree_newbie,
            'marketingtree_fit'=>$request->marketingtree_fit,
            'marketingtree_giangvien_name1'=>$request->marketingtree_giangvien_name1,
            'marketingtree_giangvien_des1'=>$request->marketingtree_giangvien_des1,
            'marketingtree_giangvien_anh1'=>$request->marketingtree_giangvien_anh1,
            'marketingtree_giangvien_fb1'=>$request->marketingtree_giangvien_fb1,
            'marketingtree_giangvien_email1'=>$request->marketingtree_giangvien_email1,
            'marketingtree_giangvien_gt1' => $request->marketingtree_giangvien_gt1,
            'marketingtree_giangvien_you1' => $request->marketingtree_giangvien_gt1,
            'marketingtree_giangvien_name2'=>$request->marketingtree_giangvien_name2,
            'marketingtree_giangvien_des2'=>$request->marketingtree_giangvien_des2,
            'marketingtree_giangvien_anh2'=>$request->marketingtree_giangvien_anh2,
            'marketingtree_giangvien_fb2' => $request->marketingtree_giangvien_fb2,
            'marketingtree_giangvien_email2'=>$request->marketingtree_giangvien_email2,
            'marketingtree_giangvien_gt2' => $request->marketingtree_giangvien_gt2,
            'marketingtree_giangvien_you2'=> $request->marketingtree_giangvien_you2,
            'marketingtree_giangvien_name3'=>$request->marketingtree_giangvien_name3,
            'marketingtree_giangvien_des3'=>$request->marketingtree_giangvien_des3,
            'marketingtree_giangvien_anh3'=>$request->marketingtree_giangvien_anh3,
            'marketingtree_giangvien_fb3' => $request->marketingtree_giangvien_fb3,
            'marketingtree_giangvien_email3'=>$request->marketingtree_giangvien_email3,
            'marketingtree_giangvien_gt3' => $request->marketingtree_giangvien_gt3,
            'marketingtree_giangvien_you3'=> $request->marketingtree_giangvien_you3,
            'marketingtree_course_content'=>$request->marketingtree_course_content,
            'lytuong_sumenh'=>$request->lytuong_sumenh,
            'lytuong_giatri'=>$request->lytuong_giatri,
            'lytuong_ynghialogo'=>$request->lytuong_ynghialogo,
            'lytuong_ynghialogo2'=>$request->lytuong_ynghialogo2,
            'contact_form_title'=>$request->contact_form_title,
            'contact_form_address'=>$request->contact_form_address,
            'contact_form_phone_1'=>$request->contact_form_phone_1,
            'contact_form_phone_2'=>$request->contact_form_phone_2,
            'google_map_contact'=>$request->google_map_contact,
            'marketing_title_job8'=>$request->marketing_title_job8,
            'marketing_content_job8'=>$request->marketing_content_job8,
            'marketing_title_job7'=>$request->marketing_title_job7,
            'marketing_content_job7'=>$request->marketing_content_job7,
            'marketing_title_job6'=>$request->marketing_title_job6,
            'marketing_content_job6'=>$request->marketing_content_job6,
            'marketing_title_job5'=>$request->marketing_title_job5,
            'marketing_content_job5'=>$request->marketing_content_job5,
            'marketing_title_job4'=>$request->marketing_title_job4,
            'marketing_content_job4'=>$request->marketing_content_job4,
            'marketing_title_job3'=>$request->marketing_title_job3,
            'marketing_content_job3'=>$request->marketing_content_job3,
            'marketing_title_job2'=>$request->marketing_title_job2,
            'marketing_content_job2'=>$request->marketing_content_job2,
            'marketing_title_job1'=>$request->marketing_title_job1,
            'marketing_content_job1'=>$request->marketing_content_job1,
        ];
        $ids = [];

        $settingPage = [
            'about_title_1' => $request->about_title_1,
            'about_title_larger_1'  => $request->about_title_larger_1,
            'about_desc_1'  => $request->about_desc_1,
            'about_title_button_1'  => $request->about_title_button_1,
            'about_title_link_1'  => $request->about_title_link_1,
            'about_title_box_1' => $request->about_title_box_1,
            'about_title_box_2' => $request->about_title_box_2,
            'about_desc_box_1'=> $request->about_desc_box_1,
            'about_desc_box_2' => $request->about_desc_box_2,
            'about_title_box_3' => $request->about_title_box_3,
            'about_title_box_4' => $request->about_title_box_4,
            'about_desc_box_3' => $request->about_desc_box_3,
            'about_desc_box_4' => $request->about_desc_box_4,
            'about_title_main_form_2' => $request->about_title_main_form_2,
            'about_desc_main_form_2' => $request->about_desc_main_form_2,
            'about_title_main_button_2' => $request->about_title_main_button_2,
            'about_link_main_form_2' => $request->about_link_main_form_2,
            'contact_form_title' => $request->contact_form_title,
            'contact_form_address' => $request->contact_form_address,
            'contact_form_phone_1' => $request->contact_form_phone_1,
            'contact_form_phone_2' => $request->contact_form_phone_2,
            'google_map_contact' => $request->google_map_contact,
        ];

        try {

            $edit = $this->ta->update($input, $id);

            do_action('lito_before_edit_post',$edit->post_title,'Sửa','Bài viết');

            if(!empty($settingPage)){
                foreach($settingPage as $k=>$v){
                    $this->set->updateOrCreate(['setting_key'=>$k],['setting_value'=>$v]);
                }
            }

            $rating = new \willvincent\Rateable\Rating;
            if($request->rate > 0) {
                $rating->rating = $request->rate;
                $rating->user_id = auth()->user()->id;
                $rating->rateable_type = 'Post';
                $edit->ratings()->save($rating);
            }

            $this->meta->updateOrCreateMeta($id,$seosetting);
            if(!empty($request->taxonomy_id)){
                $ids = $request->taxonomy_id;
            }


            if(!empty($tagname) && count($tagname)>0){
                foreach ($tagname as $key => $val){
                    $slug = Str::slug($val,'-');
                    $data = ['name'=>$val, 'slug'=>$slug,'taxonomy_type'=>'tag','parent'=>0,'index'=>0];

                    $old_tag = $this->tax->findWhere(['slug'=>$slug,'taxonomy_type'=>'tag'])->all();
                    if(!empty($old_tag) && count($old_tag) > 0){
                        foreach($old_tag as $t){
                            $ids[] = $t->id;
                        }
                    }else{
                        $tagCreate =  $this->tax->create($data);
                        $ids[] = $tagCreate->id;
                    }
                }
            }

            $this->ta->sync($id,'taxonomy',$ids);



            return redirect()->route('lito::post.index.get',['post_type'=>$postype])->with(FlashMessage::returnMessage('edit'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getDelete($id)
    {
        $data = $this->ta->find($id);
        try{
            do_action('lito_before_edit_post',$data->post_title,'Xóa','Bài viết');
            $this->ta->delete($id);
            return redirect()->back()->with(FlashMessage::returnMessage('delete'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function ajaxgetTag()
    {
        $json = [];
        $tag_list = $this->tax->scopeQuery(function ($q){
            return $q->orderBy('id','desc')->select('id','name','slug','taxonomy_type')->where('taxonomy_type','tag')->get();
        })->all();
        foreach ($tag_list as $row){
            $json[] = $row->name;
        }
        return json_encode($json);
    }

    public function getStatus(Request $request){
        $status = $request->get('post_status');
        $id = $request->get('id');

        if ($status == 'draft') {
            $this->ta->update([
                'post_status' => 'publish'
            ], $id);
        }

        if ($status == 'publish') {
            $this->ta->update([
                'post_status' => 'draft'
            ], $id);
        }

        if($status=='inherit'){
            $this->ta->update([
               'post_status' => 'draft'
            ],$id);
        }

        return redirect()->back()->with(FlashMessage::returnMessage('edit'));
    }

}