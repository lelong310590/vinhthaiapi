<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 25/03/2019
 * Time: 14:17
 */

namespace Analytics\Hook;

use Analytics;
use Post\Repositories\PostRepositories;
use Spatie\Analytics\Period;

class AnalyticsWidgetHook
{
    protected $repository;

    public function __construct(PostRepositories $postRepositories)
    {
        $this->repository = $postRepositories;
    }

    public function handle()
    {
        try {
            //Analytic Query
            $totalVisitorsAndPageviews = Analytics::performQuery(Period::days(0),
                'ga:sessions',
                [
                    'metrics' => 'ga:visitors, ga:pageviews, ga:sessions, ga:bounceRate, ga:percentNewSessions, ga:pageviewsPerSession, ga:avgSessionDuration, ga:newUsers',
                    'dimensions' => 'ga:hour'
                ]);

            $country = Analytics::performQuery(Period::days(0),
                'ga:visitors',
                [
                    'dimensions'=>'ga:country',
                    'sort'=>'-ga:visitors'
                ]);

            $mostvisitedPage = Analytics::fetchMostVisitedPages(Period::days(7), 10);

            $topBrowser = Analytics::fetchTopBrowsers(Period::days(7), 10);

            $topReferrers = Analytics::fetchTopReferrers(Period::days(7), 10);

            $newPost = $this->repository->scopeQuery(function ($q) {
                return $q->where('post_status', 'publish')->select('id', 'post_title', 'created_at')->orderBy('created_at' , 'desc')->take(10);
            })->all();

            //End query

            $chartData = collect($totalVisitorsAndPageviews['rows'] ?? [])->map(function (array $dateRow) {
                return [
                    'hours' => $dateRow[0],
                    'visitors' => $dateRow[1],
                    'pageViews' => $dateRow[2],
                ];
            });

            $result= collect($country['rows'] ?? [])->map(function (array $dateRow) {
                return [
                    $dateRow[0] => (int) $dateRow[1]
                ];
            });

            $tmp = [];

            foreach ($result as $k=>$v){
                $codeCountry = convertISOCountry(array_keys($v)[0]);
                $tmp[$codeCountry] = $v[array_keys($v)[0]];
            }

            echo view('lito-analytics::partials.widget-dashboard', [
                'chartData' => json_encode($chartData),
                'country' => json_encode($tmp),
                'info' => $totalVisitorsAndPageviews->totalsForAllResults,
                'mostvisitedPage' => $mostvisitedPage,
                'topBrowser' => $topBrowser,
                'topReferrers' => $topReferrers,
                'newPost' => $newPost
            ]);
        } catch (\Exception $e) {
            return view('lito-analytics::partials.widget-dashboard-error', [
                'messsage' => $e->getMessage()
            ]);
        }
    }
}