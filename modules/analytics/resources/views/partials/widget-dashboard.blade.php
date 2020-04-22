@push('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- jvectormap CSS -->
    <link href="{{asset('ui/vendor/jquery-jvectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet">
@endpush

<div class="col-xs-12" style="margin-bottom: 20px">
    <div class="analytics-wrapper dashboard-widget-item">
        <h4 class="analytic-header"><i class="fa fa-line-chart" aria-hidden="true"></i> Site Analytics</h4>
        <div class="analytics-inner">
            <div class="row">
                <div class="col-xs-12 col-md-7">
                    <div class="chart-wrapper">
                        <div id="totalVisitedAndPageView" style="height: 400px;"></div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-5">
                    <div class="chart-wrapper">
                        <div class="worldmap" id="mapwrap" style="width: 100%; height: 400px; padding: 15px"></div>
                    </div>
                </div>

                <div class="clearfix" style="margin-bottom: 25px"></div>

                <div class="col-xs-12">
                    <div class="col-xs-12 col-md-3">
                        <div class="info-box">
                            <div class="info-box-icon bg-yellow-casablanca font-white">
                                <i class="fa fa-eye"></i>
                            </div>
                            <div class="info-box-content">
                                <span class="info-box-text">Sessions</span>
                                <span class="info-box-number" id="sessions_total">{{$info['ga:sessions']}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-3">
                        <div class="info-box">
                            <div class="info-box-icon bg-blue font-white">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </div>
                            <div class="info-box-content">
                                <span class="info-box-text">Visitors</span>
                                <span class="info-box-number" id="sessions_total">{{$info['ga:visitors']}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-3">
                        <div class="info-box">
                            <div class="info-box-icon bg-green-haze font-white">
                                <i class="fa fa-file-text" aria-hidden="true"></i>
                            </div>
                            <div class="info-box-content">
                                <span class="info-box-text">Pageviews</span>
                                <span class="info-box-number" id="sessions_total">{{$info['ga:pageviews']}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-3">
                        <div class="info-box">
                            <div class="info-box-icon bg-yellow font-white">
                                <i class="fa fa-bolt" aria-hidden="true"></i>
                            </div>
                            <div class="info-box-content">
                                <span class="info-box-text">Bounce Rate</span>
                                <span class="info-box-number" id="sessions_total">{{round($info['ga:bounceRate'], 2)}} %</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-3">
                        <div class="info-box">
                            <div class="info-box-icon bg-purple font-white">
                                <i class="fa fa-pie-chart" aria-hidden="true"></i>
                            </div>
                            <div class="info-box-content">
                                <span class="info-box-text">Percent new session</span>
                                <span class="info-box-number" id="sessions_total">{{round($info['ga:percentNewSessions'], 2)}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-3">
                        <div class="info-box">
                            <div class="info-box-icon bg-yellow-crusta font-white">
                                <i class="fa fa-line-chart" aria-hidden="true"></i>
                            </div>
                            <div class="info-box-content">
                                <span class="info-box-text">Pages/Session</span>
                                <span class="info-box-number" id="sessions_total">{{round($info['ga:pageviewsPerSession'], 2)}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-3">
                        <div class="info-box">
                            <div class="info-box-icon bg-red font-white">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                            </div>
                            <div class="info-box-content">
                                <span class="info-box-text">Avg. Duration</span>
                                <span class="info-box-number" id="sessions_total">{{formatSeconds(round($info['ga:avgSessionDuration']))}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-3">
                        <div class="info-box">
                            <div class="info-box-icon bg-yellow-casablanca font-white">
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                            </div>
                            <div class="info-box-content">
                                <span class="info-box-text">New visitors</span>
                                <span class="info-box-number" id="sessions_total">{{$info['ga:newUsers']}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xs-12 col-md-6">
    <div class="portlet light bordered portlet-no-padding ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                <span class="caption-subject font-dark">Top Most Visit Pages (7 days)</span>
            </div>
        </div>

        <div class="portlet-body  widget-content scroll-table">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>URL</th>
                        <th>Views</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($mostvisitedPage as $page)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>
                                <a href="{{config('base.frontend_url') . $page['url']}}" target="_blank">
                                    {{$page['pageTitle']}}
                                </a>
                            </td>
                            <td>{{$page['pageViews']}} (views)</td>
                        </tr>
                    @empty
                        <tr>
                            <td></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-xs-12 col-md-6">
    <div class="portlet light bordered portlet-no-padding ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-chrome" aria-hidden="true"></i>
                <span class="caption-subject font-dark">Top Browsers (7 days)</span>
            </div>
        </div>

        <div class="portlet-body  widget-content scroll-table">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>URL</th>
                        <th>Views</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($topBrowser as $browser)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>
                                {{$browser['browser']}}
                            </td>
                            <td>{{$browser['sessions']}} (views)</td>
                        </tr>
                    @empty
                        <tr>
                            <td></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-xs-12 col-md-6" style="margin-top: 30px">
    <div class="portlet light bordered portlet-no-padding ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-users" aria-hidden="true"></i>
                <span class="caption-subject font-dark">Top Referrers (7 days)</span>
            </div>
        </div>

        <div class="portlet-body  widget-content scroll-table">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>URL</th>
                        <th>Views</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($topReferrers as $ref)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>
                                {{$ref['url']}}
                            </td>
                            <td>{{$ref['pageViews']}} (views)</td>
                        </tr>
                    @empty
                        <tr>
                            <td></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-xs-12 col-md-6" style="margin-top: 30px">
    <div class="portlet light bordered portlet-no-padding ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                <span class="caption-subject font-dark">Bài viết mới nhất</span>
            </div>
        </div>

        <div class="portlet-body  widget-content scroll-table">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tiêu đề</th>
                        <th width="200">Ngày tạo</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($newPost as $post)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>
                                {{$post->post_title}}
                            </td>
                            <td width="200">{{$post->created_at}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3"></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('js')
    <!-- jvectormap JavaScript -->
    <script src="{{asset('ui/vendor/jquery-jvectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
    <script src="{{asset('ui/vendor/jquery-jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            new Morris.Area({
                // ID of the element in which to draw the chart.
                element: 'totalVisitedAndPageView',
                // Chart data records -- each entry in this array corresponds to a point on
                // the chart.
                data: {!! $chartData !!},
                xkey: 'hours',
                ykeys: ['visitors', 'pageViews'],
                labels: ['Visitors', 'Page Views'],
                pointSize: 5,
                hideHover: 'auto',
                resize: true,
                lineColors: ["#dd4d37", "#3c8dbc"],
                pointFillColors: [ "#d88c80", "#74a5c1"],
                fillOpacity: 1.0,
                parseTime:false
            });

            var gdpData = {!! $country !!};

            $('#mapwrap').vectorMap({
                map: 'world_mill_en',
                backgroundColor: '#f1f1f1',
                series: {
                    regions: [{
                        values: gdpData,
                        scale: ['#d88c80', '#dd4d37'],
                        normalizeFunction: 'polynomial'
                    }]
                },
                onRegionTipShow: function(e, el, code){
                    el.html(el.html()+' ('+gdpData[code]+' visitors');
                }
            });
        });
    </script>
@endpush