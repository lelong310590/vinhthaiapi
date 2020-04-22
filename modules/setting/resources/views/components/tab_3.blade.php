<div id="all" class="tab-pane fade in active">
    <div class="header-set">
        <h3 class="tab-setting-header">Cấu hình chung</h3>
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="component-wrapper">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="site_title">Tiêu đề trang chủ</label>
                                <input type="text"
                                       class="form-control"
                                       name="site_title"
                                       placeholder="Nhập tiêu đề cho trang chủ"
                                       value="{{$setting->getSettingMeta('site_title')}}"
                                >
                            </div>
                            <div class="form-group">
                                <label for="site_title_header">Tiêu đề header</label>
                                <input type="text"
                                       class="form-control"
                                       name="site_title_header"
                                       placeholder="Nhập tiêu đề cho header"
                                       value="{{$setting->getSettingMeta('site_title_header')}}"
                                >
                            </div>
                            <div class="form-group">
                                <label for="site_keyword">Thẻ Meta keyword </label>
                                <input type="text"
                                       class="form-control"
                                       name="site_keyword"
                                       placeholder="Cách nhau bởi dấu ,"
                                       value="{{$setting->getSettingMeta('site_keyword')}}"
                                >
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Thẻ Meta description </label>
                                <textarea
                                        class="form-control"
                                        name="site_description"
                                        rows="4"
                                        parsley-trigger="change"
                                >{{$setting->getSettingMeta('site_description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="site_email">Địa chỉ email</label>
                                <input type="text"
                                       class="form-control"
                                       name="site_email"
                                       value="{{$setting->getSettingMeta('site_email')}}"
                                >
                            </div>
                            <div class="form-group">
                                <label for="site_hotline">Hotline</label>
                                <input type="text"
                                       class="form-control"
                                       name="site_hotline"
                                       value="{{$setting->getSettingMeta('site_hotline')}}"
                                >
                            </div>
                            <div class="form-group">
                                <label for="site_hotline_1">Hotline 1</label>
                                <input type="text"
                                       class="form-control"
                                       name="site_hotline_1"
                                       value="{{$setting->getSettingMeta('site_hotline_1')}}"
                                >
                            </div>
                            <div class="form-group">
                                <label for="site_hotline_2">Hotline 2</label>
                                <input type="text"
                                       class="form-control"
                                       name="site_hotline_2"
                                       value="{{$setting->getSettingMeta('site_hotline_2')}}"
                                >
                            </div>
                            <div class="form-group">
                                <label for="site_company_address">Địa chỉ</label>
                                <input type="text"
                                       class="form-control"
                                       name="site_company_address"
                                       value="{{$setting->getSettingMeta('site_company_address')}}"
                                >
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Nội dung chân trang</label>
                                <textarea id="ckeditor"
                                          class="form-control"
                                          name="site_footer"
                                          parsley-trigger="change"
                                >{{$setting->getSettingMeta('site_footer')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Nội dung trang chủ</label>
                                <textarea id="ckeditor"
                                          class="form-control ckeditor"
                                          name="home_content"
                                          parsley-trigger="change"
                                >{{$setting->getSettingMeta('home_content')}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="box_bottom_content_index_2">GA Code</label>
                                <input type="text"
                                       class="form-control"
                                       name="google_analytics_code"
                                       placeholder="Code Google Analytics"
                                       value="{{$setting->getSettingMeta('google_analytics_code')}}"
                                >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="box_bottom_content_index_2">Facebook</label>
                                <input type="text"
                                       class="form-control"
                                       name="facebook"
                                       placeholder="Facebook"
                                       value="{{$setting->getSettingMeta('facebook')}}"
                                >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="box_bottom_content_index_2">Linkedin</label>
                                <input type="text"
                                       class="form-control"
                                       name="linkedin"
                                       placeholder="Linkedin"
                                       value="{{$setting->getSettingMeta('linkedin')}}"
                                >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="box_bottom_content_index_2">Youtube</label>
                                <input type="text"
                                       class="form-control"
                                       name="youtube"
                                       placeholder="Youtube"
                                       value="{{$setting->getSettingMeta('youtube')}}"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-12">

                <div class="component-wrapper">

                    @include('lito-dashboard::components.thumbnail',[
                                    'title' => 'Site Logo',
                                    'name' => 'site_logo',
                                    'image' => $setting->getSettingMeta('site_logo')
                                ])
                    <button type="submit" class="btn btn-default btn-full">Lưu lại</button>
                </div>
            </div>


        </div>
    </div>
</div>