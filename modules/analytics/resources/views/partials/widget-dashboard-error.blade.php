<div class="col-xs-12">
    <div class="analytics-wrapper dashboard-widget-item">
        <h4 class="analytic-header"><i class="fa fa-line-chart" aria-hidden="true"></i> Site Analytics</h4>
        <div class="analytics-inner">

            <div class="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Lỗi !</strong> {{$messsage}}
            </div>

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
                                <span class="info-box-number" id="sessions_total">0</span>
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
                                <span class="info-box-number" id="sessions_total">0</span>
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
                                <span class="info-box-number" id="sessions_total">0</span>
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
                                <span class="info-box-number" id="sessions_total">0 %</span>
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
                                <span class="info-box-number" id="sessions_total">0</span>
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
                                <span class="info-box-number" id="sessions_total">0</span>
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
                                <span class="info-box-number" id="sessions_total">0</span>
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
                                <span class="info-box-number" id="sessions_total">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
