<div class="col-xs-12">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#menu">Rich Snippet</a></li>
        <li><a data-toggle="tab" href="#menu1">Mạng xã hội</a></li>
        <li><a data-toggle="tab" href="#menu2">Nâng cao</a></li>
    </ul>

    <div class="tab-content">
        <div id="menu" class="tab-pane fade in active">
            <h3>Cấu hình Rich snippet</h3>

            <div class="snippet_preview">
                <label>Xem trước kết quả hiển thị tìm kiếm</label>
                <div class="border-snip">
                    <h4 class="seo_title" id="seo_title_value">{{$setting->getSettingMeta('seo_title_page_website')}}</h4>
                    <a class="seo_url" href="#">{{website_url()}} > <span id="slug_value">{{$setting->getSettingMeta('seo_slug_page_website')}}</span></a>
                    <p class="seo_description" id="seo_description_value">{{$setting->getSettingMeta('seo_description_page_website')}}</p>
                </div>
            </div>

            <div class="snippet_edit">
                <div class="form-group">
                    <label for="seo_title_page_website">Meta title</label>
                    <input type="text"
                           name="seo_title_page_website"
                           id="seo_title"
                           onkeyup="SnippetTitle();"
                           parsley-trigger="change"
                           class="form-control"
                           value="{{$setting->getSettingMeta('seo_title_page_website')}}" />
                </div>
                <div class="form-group">
                    <label for="seo_slug_page_website">Slug</label>
                    <input type="text" name="seo_slug_page_website"
                           id="seo_slug"
                           class="form-control"
                           value="{{$setting->getSettingMeta('seo_slug_page_website')}}"
                           onkeyup="seoSlug();"
                           parsley-trigger="change"
                    >
                </div>
                <div class="form-group">
                    <label for="seo_keyword_page_website">Meta keywords</label>
                    <input type="text" name="seo_keyword_page_website"
                           id="seo_keyword"
                           class="form-control inputag"
                           value="{{$setting->getSettingMeta('seo_keyword_page_website')}}"
                           parsley-trigger="change"
                    >
                </div>
                <div class="form-group">
                    <label for="seo_description">Meta description</label>
                    <textarea
                            class="form-control"
                            name="seo_description_page_website"
                            id="seo_description"
                            rows="4"
                            parsley-trigger="change"
                            onkeyup="richSnippetChange();"
                    >{{$setting->getSettingMeta('seo_description_page_website')}}</textarea>
                </div>
            </div>
        </div>
        <div id="menu1" class="tab-pane fade">
            <h3>Cấu hình Facebook</h3>
            <div class="snippet_edit">
                <div class="form-group">
                    <label for="facebook_title_page_website">Facebook title</label>
                    <input type="text"
                           name="facebook_title_page_website"
                           id="facebook_title"
                           class="form-control"
                           value="{{$setting->getSettingMeta('facebook_title_page_website')}}" />
                </div>
                <div class="form-group">
                    <label for="facebook_description_page_website">Facebook description</label>
                    <textarea
                            class="form-control"
                            name="facebook_description_page_website"
                            id="facebook_description"
                            rows="4"
                            parsley-trigger="change"
                    >{{$setting->getSettingMeta('facebook_description_page_website')}}</textarea>
                </div>

                @include('lito-dashboard::components.upload',[
                   'name' => 'facebook_image_page_website',
                   'data' => $setting
                ])
            </div>
        </div>
        <div id="menu2" class="tab-pane fade">
            <h3>Cấu hình nâng cao</h3>
            <div class="snippet_edit">
                <div class="form-group">
                    <label for="follow_link_page_website" style="width: 100%">Cho phép máy tìm kiếm theo dõi</label>
                    <label class="checkbox-inline">
                        <input type="radio"
                               name="follow_link_page_website"
                               value="dofollow"
                               {{ ($setting->getSettingMeta('follow_link_page_website') == 'dofollow') ? 'checked' : '' }}
                        >Có</label>
                    <label class="checkbox-inline">
                        <input type="radio"
                               name="follow_link_page_website"
                               value="nofollow"
                                {{ ($setting->getSettingMeta('follow_link_page_website') == 'nofollow') ? 'checked' : '' }}
                        >Không</label>
                </div>
                <div class="form-group">
                    <label for="breadcrumb_title_page_website">Tiêu đề breadcrumb</label>
                    <input type="text"
                           name="breadcrumb_title_page_website"
                           id="breadcrumb_title"
                           class="form-control"
                           value="{{$setting->getSettingMeta('breadcrumb_title_page_website')}}" />
                </div>
                <div class="form-group">
                    <label for="canonical_url_page_website">Canonical Url</label>
                    <input type="text"
                           name="canonical_url_page_website"
                           id="canonical_url"
                           class="form-control"
                           value="{{$setting->getSettingMeta('canonical_url_page_website')}}" />
                </div>
            </div>
        </div>
    </div>
</div>