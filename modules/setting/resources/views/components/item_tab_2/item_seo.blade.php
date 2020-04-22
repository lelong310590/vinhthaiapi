<div class="col-xs-12">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#tab1">Rich Snippet</a></li>
        <li><a data-toggle="tab" href="#tab2">Mạng xã hội</a></li>
        <li><a data-toggle="tab" href="#tab3">Nâng cao</a></li>
    </ul>

    <div class="tab-content">
        <div id="tab1" class="tab-pane fade in active">
            <h3>Cấu hình Rich snippet</h3>

            <div class="snippet_preview">
                <label>Xem trước kết quả hiển thị tìm kiếm</label>
                <div class="border-snip">
                    <h4 class="seo_title" id="seo_title_vps_value">{{$setting->getSettingMeta('seo_title_page_vps')}}</h4>
                    <a class="seo_url" href="#">{{website_url()}} > <span id="slug_vps_value">{{$setting->getSettingMeta('seo_slug_page_vps')}}</span></a>
                    <p class="seo_description" id="seo_description_value">{{$setting->getSettingMeta('seo_description_page_vps')}}</p>
                </div>
            </div>

            <div class="snippet_edit">
                <div class="form-group">
                    <label for="seo_title_page_vps">Meta title</label>
                    <input type="text"
                           name="seo_title_page_vps"
                           id="seo_title_vps"
                           onkeyup=""
                           parsley-trigger="change"
                           class="form-control"
                           value="{{$setting->getSettingMeta('seo_title_page_vps')}}" />
                </div>
                <div class="form-group">
                    <label for="seo_slug_page_vps">Slug</label>
                    <input type="text" name="seo_slug_page_vps"
                           id="seo_slug_vps"
                           class="form-control"
                           value="{{$setting->getSettingMeta('seo_slug_page_vps')}}"
                           onkeyup=""
                           parsley-trigger="change"
                    >
                </div>
                <div class="form-group">
                    <label for="seo_keyword_page_website">Meta keywords</label>
                    <input type="text" name="seo_keyword_page_vps"
                           id="seo_keyword_vps"
                           class="form-control inputag"
                           value="{{$setting->getSettingMeta('seo_keyword_page_vps')}}"
                           parsley-trigger="change"
                    >
                </div>
                <div class="form-group">
                    <label for="seo_description_page_vps">Meta description</label>
                    <textarea
                            class="form-control"
                            name="seo_description_page_vps"
                            id="seo_description_vps"
                            rows="4"
                            parsley-trigger="change"
                            onkeyup=""
                    >{{$setting->getSettingMeta('seo_description_page_vps')}}</textarea>
                </div>
            </div>
        </div>
        <div id="tab2" class="tab-pane fade">
            <h3>Cấu hình Facebook</h3>
            <div class="snippet_edit">
                <div class="form-group">
                    <label for="facebook_title_page_vps">Facebook title</label>
                    <input type="text"
                           name="facebook_title_page_vps"
                           id="facebook_title_vps"
                           class="form-control"
                           value="{{$setting->getSettingMeta('facebook_title_page_vps')}}" />
                </div>
                <div class="form-group">
                    <label for="facebook_description_page_vps">Facebook description</label>
                    <textarea
                            class="form-control"
                            name="facebook_description_page_vps"
                            id="facebook_description_vps"
                            rows="4"
                            parsley-trigger="change"
                    >{{$setting->getSettingMeta('facebook_description_page_vps')}}</textarea>
                </div>

                @include('lito-dashboard::components.upload',[
                   'name' => 'facebook_image_page_vps',
                   'data' => $setting
                ])
            </div>
        </div>
        <div id="tab3" class="tab-pane fade">
            <h3>Cấu hình nâng cao</h3>
            <div class="snippet_edit">
                <div class="form-group">
                    <label for="follow_link_page_website" style="width: 100%">Cho phép máy tìm kiếm theo dõi</label>
                    <label class="checkbox-inline">
                        <input type="radio"
                               name="follow_link_page_vps"
                               value="dofollow"
                                {{ ($setting->getSettingMeta('follow_link_page_vps') == 'dofollow') ? 'checked' : '' }}
                        >Có</label>
                    <label class="checkbox-inline">
                        <input type="radio"
                               name="follow_link_page_vps"
                               value="nofollow"
                                {{ ($setting->getSettingMeta('follow_link_page_vps') == 'nofollow') ? 'checked' : '' }}
                        >Không</label>
                </div>
                <div class="form-group">
                    <label for="breadcrumb_title_page_vps">Tiêu đề breadcrumb</label>
                    <input type="text"
                           name="breadcrumb_title_page_vps"
                           id="breadcrumb_title_vps"
                           class="form-control"
                           value="{{$setting->getSettingMeta('breadcrumb_title_page_vps')}}" />
                </div>
                <div class="form-group">
                    <label for="canonical_url_page_vps">Canonical Url</label>
                    <input type="text"
                           name="canonical_url_page_vps"
                           id="canonical_url_vps"
                           class="form-control"
                           value="{{$setting->getSettingMeta('canonical_url_page_vps')}}" />
                </div>
            </div>
        </div>
    </div>
</div>