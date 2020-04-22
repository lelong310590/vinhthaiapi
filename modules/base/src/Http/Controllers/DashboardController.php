<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/31/2017
 * Time: 11:56 PM
 */
namespace Base\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Models\ScumarPost;
use Base\Models\ScumarTaxonomy;
use Illuminate\Support\Facades\Artisan;
use Post\Repositories\PostRepositories;
use Symfony\Component\DomCrawler\Crawler;
use Taxonomy\Repositories\TaxonomyRepositories;
use Sheets;

//use Spatie\Sitemap\Sitemap;
//use Spatie\Sitemap\Tags\Url;

class DashboardController extends BaseController
{
    protected $po;
    protected $ta;

    public function __construct(PostRepositories $postRepositories, TaxonomyRepositories $taxonomyRepositories)
    {
        $this->po = $postRepositories;
        $this->ta = $taxonomyRepositories;
    }

    public function getIndex()
    {
//        $path = public_path().'\sitemap.xml';
//
//        $sitemap = Sitemap::create()
//            ->add(Url::create('/'))
//            ->add(Url::create('/lien-he'));
//
//        $post = $this->po->scopeQuery(function ($e){
//            return $e->orderBy('created_at','desc')->select('id','post_slug','post_status')->where('post_status','publish')->get();
//        })->all();
//        foreach ($post as $row){
//            $sitemap->add(Url::create("/{$row->post_slug}"));
//        }
//        $sitemap->writeToFile($path);

        return view('lito-dashboard::dashboard');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearCache()
    {
        try {
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            Artisan::call('route:clear');

            return redirect()->back()->with(['cache' => true]);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function getBaiviet(){
        $html = file_get_contents('https://scurmafizzy.com/category/tin-tuc-tong-hop/page/10/');
        $arr = [];
        $crawler = new Crawler($html);
        $filter = $crawler->filter('div.article-post-single');
        foreach($filter as $i => $DOMElement){
            $crawler = new Crawler($DOMElement);
            $filter1 = $crawler->filter('div.article-post-detail');
            if(count($crawler->filter('div.article-post-single-thumbnail')->filter('img'))>0){
                $img = $crawler->filter('div.article-post-single-thumbnail')->filter('img')->attr('src');
            }else{
                $img = '';
            }


            foreach($filter1 as $ii => $dom){
                $crawcon = new Crawler($dom);
                $url = $crawcon->filter('a')->attr('href');
                $htmlCon = file_get_contents($url);
                $crawlercon = new Crawler($htmlCon);
                $filtercon = $crawlercon->filter('div.article-post-excerpt')->html();

                $data =[
                    'post_title' => $crawcon->filter('a')->text(),
                    'post_slug' => str_replace(['https://scurmafizzy.com/','/'],'', $crawcon->filter('a')->attr('href')),
                    'post_excerpt' => $crawcon->filter('div.article-post-excerpt')->text(),
                    'post_content'=>$filtercon,
                    'thumbnail'=> str_replace('https://scurmafizzy.com/wp-content','',$img),
                    'post_type'=>'post',
                    'post_status' => 'publish',
                    'post_author' => 1
                ];
                $post = $this->po->create($data);
                $this->po->sync($post->id,'taxonomy',6);

//                $arr[$i][] = [
//                    'post_title' => $crawcon->filter('a')->text(),
//                    'url' => $crawcon->filter('a')->attr('href'),
//                    'post_excerpt' => $crawcon->filter('div.article-post-excerpt')->text(),
//                    'content'=>$filtercon,
//                    'thumbnail'=> $img
//                ];
            }
        }
        return 'ok';
    }

    public function getPostScuma()
    {
        $sheet = Sheets::spreadsheet('15CxlAu4eyZ9FJNqOMfBPUH9xA8K6wryLkpZo7JG-rgU')->sheet('LadiPage');
        $sheet->range('')->append([['3', 'name3', 'mail3']]);
        $values = $sheet->all();
        dd($values);
        die;
        $html = file_get_contents('https://scurmafizzy.com/danh-sach-he-thong-nha-thuoc/');
        $arr = [];
        $crawler = new Crawler($html);
        $filter = $crawler->filter('table.tablepress');
        foreach ($filter as $i => $domElement) {
            if($i==5) {
                $_crawler = new Crawler($domElement);
                $filterr = $_crawler->filter('td > a');

                foreach ($filterr as $ii => $domElementt) {


                    $_crawlerr = new Crawler($domElementt);
                    $url = $_crawlerr->filter('a')->attr('href');
                    $htmlCon = file_get_contents($url);
                    $crawlercon = new Crawler($htmlCon);
                    $filtercon = $crawlercon->filter('div.article-post-excerpt')->html();

                    try{
                        $data = [
                            'post_title' => $_crawlerr->filter('a')->text(),
                            'post_slug' => str_replace(['https://scurmafizzy.com/','/'],'',$_crawlerr->filter('a')->attr('href')),
                            'post_content' => $filtercon,
                            'post_type' => 'nhathuoc',
                            'post_status' => 'publish',
                            'post_author' => 1
                        ];
                        $post = $this->po->create($data);
                        $this->po->sync($post->id,'taxonomy',53);
                    }catch (\Exception $e){
                        dd($e->getMessage());
                    }


                    $arr[$i][] = [
                        'post_title' => $_crawlerr->filter('a')->text(),
                        'url' => $_crawlerr->filter('a')->attr('href'),
                        'content'=>$filtercon
                    ];

                }
            }



        }

//        foreach($arr[0] as $row){
//            $data = [
//                'post_title' => $row['post_title'],
//                'post_slug' => str_replace(['https://scurmafizzy.com/','/'],'',$row['url']),
//                'post_content' => $row['content'],
//                'post_type' => 'nhathuoc',
//                'post_status' => 'publish',
//                'post_author' => 1
//            ];
//            $post = $this->po->create($data);
//            $this->ta->sync($post->id,'taxonomy',48);
//        }
    }

}
