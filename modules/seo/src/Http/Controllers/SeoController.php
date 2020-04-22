<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 01/04/2019
 * Time: 09:28
 */

namespace Seo\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Analytics;
use Illuminate\Http\Request;
use Spatie\Analytics\Period;

class SeoController extends BaseController
{
    public function getIndex(Request $request)
    {
        $day = $request->has('day') ? $request->get('day') : 0;
        try {
            //Analytic Query
            $totalVisitorsAndPageviews = Analytics::performQuery(Period::days($day),
                'ga:sessions',
                [
                    'metrics' => 'ga:visitors, ga:pageviews, ga:sessions, ga:bounceRate, ga:percentNewSessions, ga:pageviewsPerSession, ga:avgSessionDuration, ga:newUsers',
                    'dimensions' => 'ga:hour'
                ]);

            $country = Analytics::performQuery(Period::days($day),
                'ga:visitors',
                [
                    'dimensions'=>'ga:country',
                    'sort'=>'-ga:visitors'
                ]);

            $mostvisitedPage = Analytics::fetchMostVisitedPages(Period::days($day), 10);

            $topBrowser = Analytics::fetchTopBrowsers(Period::days($day), 10);

            $topReferrers = Analytics::fetchTopReferrers(Period::days($day), 10);

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


            return view('lito-seo::index', [
                'chartData' => json_encode($chartData),
                'country' => json_encode($tmp),
                'info' => $totalVisitorsAndPageviews->totalsForAllResults,
                'mostvisitedPage' => $mostvisitedPage,
                'topBrowser' => $topBrowser,
                'topReferrers' => $topReferrers,
            ]);
        } catch (\Exception $e) {
            return view('lito-seo::index', [
                'messsage' => $e->getMessage()
            ]);
        }
    }
}