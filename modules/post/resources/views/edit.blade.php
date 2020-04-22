@extends('lito-dashboard::master')

@section('title', 'Sửa bài viết')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
    <link rel="stylesheet" href="{{asset('ui/css/star-rating.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('ui/vendor/ckeditor4.8/ckeditor.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>
    <script type="text/javascript" src="{{asset('ui/vendor/moment/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('ui/vendor/moment/moment-with-locales.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="{{asset('ui/js/star-rating.js')}}"></script>
@endsection
@section('js-init')
    <script type="text/javascript" src="{{asset('ui/vendor/ckeditor4.8/init.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('#datetimepicker').datetimepicker({
                locale: 'vi',
                useCurrent: true
            });
        })

        $('#tokenfield').tokenfield({
            autocomplete: {
                source: function (request, response) {
                    jQuery.get("{{route('lito::post.ajaxtag.get')}}", {
                        query: request.term
                    }, function (data) {
                        data = $.parseJSON(data);
                        response(data);
                    });
                },
                delay: 100
            },
            showAutocompleteOnFocus: true
        });
    </script>
    <script type="text/javascript">
        $("#input-id").rating();
    </script>
@endsection

@section('content')
    @inject('settingseo', 'Post\Repositories\PostmetaRepositories')
    @inject('setting', 'Setting\Repositories\SettingRepositories')
    <div class="component">
        <h4 class="component-title">Sửa bài viết <span style="text-transform: none; color:#2b91af">"{{$data->post_title}}"</span> </h4>

        <form action="" method="post" role="form">

            {{csrf_field()}}

            @include('lito-dashboard::components.alert')

            <input type="hidden" name="edited_by" value="{{Auth::id()}}">
            <input type="hidden" name="post_type" value="{{$posttype}}">
            @if($posttype!='video')
            <div class="row">
                <div class="col-xs-12 col-md-9">
                    <div class="component-wrapper">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="post_title">Tiêu đề</label>
                                    <input type="text"
                                           class="form-control"
                                           required
                                           data-parsley-minlength="3"
                                           parsley-trigger="change"
                                           name="post_title"
                                           id="input_name"
                                           placeholder="Nhập tiêu đề"
                                           onkeyup="changeSlug();"
                                           value="{{$data->post_title}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="slug">Đường dẫn tĩnh</label>
                                    <input type="text"
                                           class="form-control"
                                           parsley-trigger="change"
                                           required
                                           name="post_slug"
                                           id="input_slug"
                                           value="{{$data->post_slug}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Nội dung</label>
                                    <textarea id="ckeditor"
                                              class="form-control"
                                              name="post_content"
                                              required
                                              parsley-trigger="change"
                                    >{{$data->post_content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Mô tả ngắn</label>
                                    <textarea
                                            class="form-control"
                                            name="post_excerpt"
                                            id="post_excerpt"
                                            rows="4"
                                            parsley-trigger="change"
                                            onkeyup="metaDescritionChange();"
                                    >{{$data->post_excerpt}}</textarea>
                                </div>
                            </div>
                            <!-- Begin: Cau hinh trang dao tao -->
                            @if($data->post_type=='page' && $data->post_template=='daotao')
                                @include('lito-post::partials.daotao')
                            @endif
                            <!-- End: Cau hinh trang dao tao -->
                            <!-- Begin: Cau hinh trang dich vu-->
                            @if($data->post_type=='page' && $data->post_template=='dichvu')
                                @include('lito-post::partials.dichvu')
                            @endif
                            <!-- End: Cau hinh trang dich vu -->
                            <!-- Begin: Cau hinh trang google ads-->
                            @if($data->post_type=='page' && $data->post_template=='googleads')
                                @include('lito-post::partials.googleads')
                            @endif
                            <!-- End: Cau hinh trang google ads -->
                            <!-- Begin: Cau hinh trang marketing tree-->
                            @if($data->post_type=='page' && $data->post_template=='marketingtree')
                                @include('lito-post::partials.marketingtree')
                            @endif
                            <!-- End: Cau hinh trang marketing tree -->
                            <!-- Begin: Cau hinh trang marketing-->
                            @if($data->post_type=='page' && $data->post_template=='marketing')
                                @include('lito-post::partials.marketing')
                            @endif
                            <!-- End: Cau hinh trang marketing -->
                            <!-- Begin: Cau hinh trang ly tuong-->
                            @if($data->post_type=='page' && $data->post_template=='lytuong')
                                @include('lito-post::partials.lytuong')
                            @endif
                            <!-- End: Cau hinh trang ly tuong -->
                            @if($data->post_type=='page' && $data->post_template=='about')
                            <div class="col-md-12 col-xs-12">
                                <div class="setting-page" id="settingpage">
                                    <h3>CẤU HÌNH THÔNG TIN TRANG GIỚI THIỆU</h3>
                                    <h4>Thông tin form 1</h4>
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Tiêu đề nhỏ</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="about_title_1"
                                                   id="about_title_1"
                                                   value="{{$setting->getSettingMeta('about_title_1')}}"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Tiêu đề lớn</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="about_title_larger_1"
                                                   id="about_title_larger_1"
                                                   value="{{$setting->getSettingMeta('about_title_larger_1')}}"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Mô tả form 1</label>
                                            <textarea
                                                    class="form-control"
                                                    name="about_desc_1"
                                                    id="about_desc_1"
                                                    rows="4"
                                            >{{$setting->getSettingMeta('about_desc_1')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Tên Button</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="about_title_button_1"
                                                   id="about_title_button_1"
                                                   value="{{$setting->getSettingMeta('about_title_button_1')}}"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Link button</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="about_title_link_1"
                                                   id="about_title_link_1"
                                                   value="{{$setting->getSettingMeta('about_title_link_1')}}"
                                            >
                                        </div>
                                    </div>

                                    <h4>Thông tin form 2</h4>
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Tiêu đề box 1</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="about_title_box_1"
                                                   id="about_title_box_1"
                                                   value="{{$setting->getSettingMeta('about_title_box_1')}}"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Tiêu đề box 2</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="about_title_box_2"
                                                   id="about_title_box_2"
                                                   value="{{$setting->getSettingMeta('about_title_box_2')}}"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Nội dung box 1</label>
                                            <textarea
                                                    class="form-control"
                                                    name="about_desc_box_1"
                                                    id="about_desc_box_1"
                                                    rows="4"
                                            >{{$setting->getSettingMeta('about_desc_box_1')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Nội dung box 2</label>
                                            <textarea
                                                    class="form-control"
                                                    name="about_desc_box_2"
                                                    id="about_desc_box_2"
                                                    rows="4"
                                            >{{$setting->getSettingMeta('about_desc_box_2')}}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Tiêu đề box 3</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="about_title_box_3"
                                                   id="about_title_box_3"
                                                   value="{{$setting->getSettingMeta('about_title_box_3')}}"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Tiêu đề box 4</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="about_title_box_4"
                                                   id="about_title_box_4"
                                                   value="{{$setting->getSettingMeta('about_title_box_4')}}"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Nội dung box 3</label>
                                            <textarea
                                                    class="form-control"
                                                    name="about_desc_box_3"
                                                    id="about_desc_box_3"
                                                    rows="4"
                                            >{{$setting->getSettingMeta('about_desc_box_3')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Nội dung box 4</label>
                                            <textarea
                                                    class="form-control"
                                                    name="about_desc_box_4"
                                                    id="about_desc_box_4"
                                                    rows="4"
                                            >{{$setting->getSettingMeta('about_desc_box_4')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Tiêu đề chính</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="about_title_main_form_2"
                                                   id="about_title_main_form_2"
                                                   value="{{$setting->getSettingMeta('about_title_main_form_2')}}"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Nội dung chính </label>
                                            <textarea
                                                    class="form-control ckeditor"
                                                    name="about_desc_main_form_2"
                                                    id="about_desc_main_form_2"
                                                    rows="4"
                                            >{{$setting->getSettingMeta('about_desc_main_form_2')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Tiêu đề nút form 2</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="about_title_main_button_2"
                                                   id="about_title_main_button_2"
                                                   value="{{$setting->getSettingMeta('about_title_main_button_2')}}"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Link button</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="about_link_main_form_2"
                                                   id="about_link_main_form_2"
                                                   value="{{$setting->getSettingMeta('about_link_main_form_2')}}"
                                            >
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @endif
                            <!-- cấu hình thông tin trang contact -->
                            @if($data->post_type=='page' && $data->post_template=='contact')
                            <div class="setting-contact" id="setting-contact">
                                <h3>CẤU HÌNH THÔNG TIN TRANG LIÊN HỆ</h3>
                                <h4>Thông tin form </h4>
                                <div class="col-lg-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Tiêu đề form</label>
                                        <input type="text"
                                               class="form-control"
                                               name="contact_form_title"
                                               id="contact_form_title"
                                               value="{{$settingseo->getSeoMetaText('contact_form_title',$data->id)}}"
                                        >
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <input type="text"
                                               class="form-control"
                                               name="contact_form_address"
                                               id="contact_form_address"
                                               value="{{$settingseo->getSeoMetaText('contact_form_address',$data->id)}}"
                                        >
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Điện thoại 1</label>
                                        <input type="text"
                                               class="form-control"
                                               name="contact_form_phone_1"
                                               id="contact_form_phone_1"
                                               value="{{$settingseo->getSeoMetaText('contact_form_phone_1',$data->id)}}"
                                        >
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Điện thoại 2</label>
                                        <input type="text"
                                               class="form-control"
                                               name="contact_form_phone_2"
                                               id="contact_form_phone_2"
                                               value="{{$settingseo->getSeoMetaText('contact_form_phone_2',$data->id)}}"
                                        >
                                    </div>
                                </div>

                                <div class="col-lg-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Google map iframe</label>
                                        <textarea
                                                class="form-control"
                                                name="google_map_contact"
                                                id="google_map_contact"
                                                rows="4"
                                        >{{$settingseo->getSeoMetaText('google_map_contact',$data->id)}}</textarea>
                                    </div>
                                </div>
                            </div>
                            @endif
                        <!-- kết thúc cấu hình thông tin trang contact -->

                            <div class="col-xs-12">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home">Rich Snippet</a></li>
                                    <li><a data-toggle="tab" href="#menu1">Mạng xã hội</a></li>
                                    <li><a data-toggle="tab" href="#menu2">Nâng cao</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">
                                        <h3>Rich snippet setting</h3>

                                        <div class="snippet_preview">
                                            <label>Snippet Preview</label>
                                            <div class="border-snip">
                                                <h4 class="seo_title" id="seo_title_value">{{$data->post_title}}</h4>
                                                <a class="seo_url" href="#">{{website_url()}} > <span id="slug_value">{{$data->post_slug}}</span></a>
                                                <p class="seo_description" id="seo_description_value">{{$settingseo->getSeoMeta('seo_description',$data->id)}} </p>

                                            </div>
                                        </div>

                                        <div class="snippet_edit">
                                            <div class="form-group">
                                                <label for="seo_title">Seo title</label>
                                                <input type="text"
                                                       name="seo_title"
                                                       id="seo_title"
                                                       onkeyup="SnippetTitle();"
                                                       parsley-trigger="change"
                                                       class="form-control"
                                                       value="{{$settingseo->getSeoMeta('seo_title',$data->id)}}" />
                                            </div>
                                            <div class="form-group">
                                                <label for="seo_slug">Slug</label>
                                                <input type="text" name="seo_slug"
                                                       id="seo_slug"
                                                       class="form-control"
                                                       value="{{$data->post_slug}}"
                                                       onkeyup="seoSlug();"
                                                       parsley-trigger="change"
                                                >
                                            </div>
                                            <div class="form-group">
                                                <label for="seo_keyword">Meta keyword</label>
                                                <input type="text" name="seo_keyword"
                                                       id="seo_keyword"
                                                       class="form-control"
                                                       value=""
                                                       parsley-trigger="change"
                                                >
                                            </div>
                                            <div class="form-group">
                                                <label for="seo_description">Meta description</label>
                                                <textarea
                                                        class="form-control"
                                                        name="seo_description"
                                                        id="seo_description"
                                                        rows="4"
                                                        parsley-trigger="change"
                                                        onkeyup="richSnippetChange();"
                                                >{{$settingseo->getSeoMeta('seo_description',$data->id)}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="menu1" class="tab-pane fade">
                                        <h3>Facebook setting</h3>
                                        <div class="snippet_edit">
                                            <div class="form-group">
                                                <label for="facebook_title">Facebook title</label>
                                                <input type="text"
                                                       name="facebook_title"
                                                       id="facebook_title"
                                                       class="form-control"
                                                       value="{{$settingseo->getSeoMeta('facebook_title',$data->id)}}" />
                                            </div>
                                            <div class="form-group">
                                                <label for="facebook_description">Facebook description</label>
                                                <textarea
                                                        class="form-control"
                                                        name="facebook_description"
                                                        id="facebook_description"
                                                        rows="4"
                                                        parsley-trigger="change"
                                                >{{$settingseo->getSeoMeta('facebook_description',$data->id)}}</textarea>
                                            </div>

                                            @include('lito-dashboard::components.upload',[
                                            'name' => 'facebook_image',
                                            'image' => $settingseo->getSeoMeta('facebook_image',$data->id)
                                            ])

                                        </div>
                                    </div>
                                    <div id="menu2" class="tab-pane fade">
                                        <h3>Cấu hình nâng cao</h3>
                                        <div class="snippet_edit">
                                            <div class="form-group">
                                                <label for="canonical_url" style="width: 100%">Cho phép máy tìm kiếm index link</label>
                                                <input type="radio"
                                                       name="index_link"
                                                       value="index"
                                                        {{ ($settingseo->getSeoMeta('index_link',$data->id) == 'index' ) ? 'checked' : ''  }}
                                                > <span>Có</span>
                                                <input type="radio"
                                                       name="index_link"
                                                       value="noindex"
                                                        {{ ($settingseo->getSeoMeta('index_link',$data->id) == 'noindex' ) ? 'checked' : ''  }}
                                                > <span>Không</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="canonical_url" style="width: 100%">Cho phép máy tìm kiếm theo dõi</label>
                                                <input type="radio"
                                                       name="follow_link"
                                                       value="dofollow"
                                                       {{ ($settingseo->getSeoMeta('follow_link',$data->id) == 'follow' ) ? 'checked' : ''  }}
                                                > <span>Có</span>
                                                <input type="radio"
                                                       name="follow_link"
                                                       value="nofollow"
                                                        {{ ($settingseo->getSeoMeta('follow_link',$data->id) == 'nofollow' ) ? 'checked' : ''  }}
                                                > <span>Không</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="breadcrumb_title">Breadcrumb title</label>
                                                <input type="text"
                                                       name="breadcrumb_title"
                                                       id="breadcrumb_title"
                                                       class="form-control"
                                                       value="{{$settingseo->getSeoMeta('breadcrumb_title',$data->id)}}" />
                                            </div>
                                            <div class="form-group">
                                                <label for="canonical_url">Canonical Url</label>
                                                <input type="text"
                                                       name="canonical_url"
                                                       id="canonical_url"
                                                       class="form-control"
                                                       value="{{$settingseo->getSeoMeta('canonical_url',$data->id)}}" />
                                            </div>
                                            <div class="form-group">
                                                <label for="breadcrumb_title">Rating</label>
                                                <div class="rating">
                                                    <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $data->userAverageRating }}" data-size="xs">
                                                    <input type="hidden" name="id" required="" value="{{ $data->id }}">
                                                    <span class="review-no">{{$data->userSumRating}} Reviews</span>
                                                    <br/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-3">
                    @if($posttype == 'post')
                    <div class="component-wrapper">
                        <div class="component-category">
                            <div class="form-group" style="margin-bottom: 0; width: 100%">
                                <label for="status">Chuyên mục</label>
                                @foreach($taxonomy as $t)
                                    <div class="col-lg-12 pdt10">
                                        <input type="checkbox"
                                               name="taxonomy_id[]"
                                               value="{{$t->id}}"
                                                {{(in_array($t->id, $selected)) ? 'checked' : ''}}
                                        >
                                        <span>{{$t->name}}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <a href="{{route('lito::taxonomy.index.get',['type'=>'category'])}}" target="_blank" style="margin-top: 15px; display: block; color: #4d5ab7">Tạo chuyên mục mới</a>
                    </div>
                    @endif
                    @if($posttype=='post')
                    <div class="component-wrapper ">
                        <div class="form-group pdbt10">
                            <label for="status">Tags</label>
                            <div class="pdt10">
                                <input type="text" class="form-control" name="tag_name" value="{{$cat}}" id="tokenfield" />
                            </div>
                        </div>
                    </div>
                    @endif

                        @if($posttype=='page')
                            <div class="component-wrapper">
                                <div class="form-group" style="margin: 0">
                                    <label for="post_template">Page template</label>
                                    <select name="post_template" class="form-control">
                                        <option value="default" {{ ($data->post_template=='default') ? 'selected' : '' }} >Mặc định</option>
                                        <option value="daotao" {{ ($data->post_template=='daotao') ? 'selected' : '' }} >Page Đào Tạo</option>
                                        <option value="dichvu" {{ ($data->post_template=='dichvu') ? 'selected' : '' }} >Page Dịch Vụ</option>
                                        <option value="marketing" {{ ($data->post_template=='marketing') ? 'selected' : '' }} >Page Marketing</option>
                                        <option value="googleads" {{ ($data->post_template=='googleads') ? 'selected' : '' }} >Page Google Ads</option>
                                        <option value="marketingtree" {{ ($data->post_template=='marketingtree') ? 'selected' : '' }} >Page Marketing Tree</option>
                                        <option value="lytuong" {{ ($data->post_template=='lytuong') ? 'selected' : '' }} >Page lý tưởng</option>
                                        <option value="home" {{ ($data->post_template=='home') ? 'selected' : '' }} >Trang chủ</option>
                                        <option value="gallery" {{ ($data->post_template=='gallery') ? 'selected' : '' }} >Gallery</option>
                                        <option value="contact" {{ ($data->post_template=='contact') ? 'selected' : '' }} >Trang Liên hệ</option>
                                        <option value="about" {{ ($data->post_template=='about') ? 'selected' : '' }} >Trang Giới thiệu</option>
                                    </select>
                                </div>
                            </div>
                        @endif

                    <div class="component-wrapper">
                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select name="post_status" class="form-control">
                                <option value="publish" {{ ($data->post_status == 'publish') ? 'selected' : '' }}>Kích hoạt</option>
                                <option value="draft" {{ ($data->post_status == 'draft') ? 'selected' : '' }}>Tạm khóa</option>
                            </select>
                        </div>
                    </div>

                        <div class="component-wrapper">
                            <div class="form-group" style="margin-bottom: 0">
                                <label for="display">Loại hiển thị</label>
                                <select name="display" class="form-control">
                                    <option value="">---Không chọn---</option>
                                    <option value="hot" {{ ($data->display == 'hot') ? 'selected' : ''
                                    }}>Nổi bật</option>
                                    <option value="home" {{ ($data->display == 'home') ? 'selected' : ''
                                    }}>Trang chủ</option>
                                </select>
                            </div>
                        </div>

                        <div class="component-wrapper">
                            <div class="form-group">
                                <label for="status">Ngày xuất bản</label>
                                <div class="input-group date" >
                                    <input
                                            type="text"
                                            name="publish_at"
                                            class="form-control"
                                            id="datetimepicker"
                                            autocomplete="off"
                                            placeholder="Click để chọn ngày"
                                            value="{{date('d/m/Y H:i', strtotime($data->publish_at)) }}"
                                    >
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="component-wrapper">

                        @include('lito-dashboard::components.thumbnail', ['data' => $data])

                        <button type="submit" class="btn btn-default btn-full">Lưu lại</button>

                    </div>
                </div>
            </div>
            @else
                <div class="row">
                    <div class="col-xs-12 col-md-9">
                        <div class="component-wrapper">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="post_title">Tiêu đề</label>
                                        <input type="text"
                                               class="form-control"
                                               required
                                               data-parsley-minlength="3"
                                               parsley-trigger="change"
                                               name="post_title"
                                               id="input_name"
                                               placeholder="Nhập tiêu đề"
                                               onkeyup="changeSlug();"
                                               value="{{$data->post_title}}"
                                        >
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Đường dẫn tĩnh</label>
                                        <input type="text"
                                               class="form-control"
                                               parsley-trigger="change"
                                               required
                                               name="post_slug"
                                               id="input_slug"
                                               value="{{$data->post_slug}}"
                                        >
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Đường dẫn tĩnh</label>
                                        <input type="text"
                                               class="form-control"
                                               parsley-trigger="change"
                                               required
                                               name="post_video"
                                               id="input_video"
                                               value="{{$data->post_video}}"
                                        >
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-3">


                        <div class="component-wrapper">
                            <div class="form-group">
                                <label for="status">Trạng thái</label>
                                <select name="post_status" class="form-control">
                                    <option value="publish" {{ ($data->post_status == 'publish') ? 'selected' : '' }}>Kích hoạt</option>
                                    <option value="draft" {{ ($data->post_status == 'draft') ? 'selected' : '' }}>Tạm khóa</option>
                                </select>
                            </div>
                        </div>

                        <div class="component-wrapper">
                            <div class="form-group" style="margin-bottom: 0">
                                <label for="display">Loại hiển thị</label>
                                <select name="display" class="form-control">
                                    <option value="">---Không chọn---</option>
                                    <option value="hot" {{ ($data->display == 'hot') ? 'selected' : ''
                                    }}>Nổi bật</option>
                                    <option value="home" {{ ($data->display == 'home') ? 'selected' : ''
                                    }}>Trang chủ</option>
                                </select>
                            </div>
                        </div>

                        <div class="component-wrapper">
                            <div class="form-group">
                                <label for="status">Ngày xuất bản</label>
                                <div class="input-group date" >
                                    <input
                                            type="text"
                                            name="publish_at"
                                            class="form-control"
                                            id="datetimepicker"
                                            autocomplete="off"
                                            placeholder="Click để chọn ngày"
                                            value="{{date('d/m/Y H:i', strtotime($data->publish_at)) }}"
                                    >
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="component-wrapper">

                            @include('lito-dashboard::components.thumbnail', ['data' => $data])

                            <button type="submit" class="btn btn-default btn-full">Lưu lại</button>

                        </div>
                    </div>
                </div>
            @endif
        </form>
    </div>


@endsection

@push('js')
    <script type="text/javascript">
        var templateType = $('select[name="post_template"]');
        var nodePage = $('.setting-page');
        var nodeContact = $('.setting-contact');
        var nodeDaotao = $('#daotao');
        var nodeDichvu = $('#dichvu');
        var nodeGoogleads = $('#googleads');
        var nodeMarketingtree = $('#marketingtree');
        var nodeMarketing = $('#marketing');
        var nodeLytuong = $('#lytuong');
        if(templateType.val() === 'about'){
            nodePage.show();
            nodeContact.hide();
            nodeDaotao.hide();
            nodeDichvu.hide();
            nodeMarketingtree.hide();
            nodeMarketing.hide();
            nodeLytuong.hide();
        }
        else if(templateType.val() == 'contact'){
            nodeContact.show();
            nodePage.hide();
            nodeDaotao.hide();
            nodeDichvu.hide();
            nodeGoogleads.hide();
            nodeMarketingtree.hide();
            nodeMarketing.hide();
            nodeLytuong.hide();
        }
        else if(templateType.val() == 'daotao'){
            nodeContact.hide();
            nodePage.hide();
            nodeDichvu.hide();
            nodeGoogleads.hide();
            nodeMarketingtree.hide();
            nodeMarketing.hide();
            nodeLytuong.hide();
            nodeDaotao.show();
        }
        else if(templateType.val() == 'dichvu'){
            nodeContact.hide();
            nodePage.hide();
            nodeDaotao.hide();
            nodeGoogleads.hide();
            nodeMarketingtree.hide();
            nodeMarketing.hide();
            nodeLytuong.hide();
            nodeDichvu.show();
        }
        else if(templateType.val() == 'googleads'){
            nodeContact.hide();
            nodePage.hide();
            nodeDaotao.hide();
            nodeDichvu.hide();
            nodeMarketingtree.hide();
            nodeMarketing.hide();
            nodeLytuong.hide();
            nodeGoogleads.show();
        }
        else if(templateType.val() == 'marketingtree'){
            nodeContact.hide();
            nodePage.hide();
            nodeDaotao.hide();
            nodeDichvu.hide();
            nodeGoogleads.hide();
            nodeMarketing.hide();
            nodeLytuong.hide();
            nodeMarketingtree.show();
        }
        else if(templateType.val() == 'marketing'){
            nodeContact.hide();
            nodePage.hide();
            nodeDaotao.hide();
            nodeDichvu.hide();
            nodeGoogleads.hide();
            nodeMarketingtree.hide();
            nodeLytuong.hide();
            nodeMarketing.show();
        }

        else if(templateType.val() == 'lytuong'){
            nodeContact.hide();
            nodePage.hide();
            nodeDaotao.hide();
            nodeDichvu.hide();
            nodeGoogleads.hide();
            nodeMarketingtree.hide();
            nodeMarketing.hide();
            nodeLytuong.show();
        }

        templateType.on('change', function (e) {
            var _this = $(e.currentTarget);
            var value = _this.val();
            if (value == 'about') {
                nodePage.show();
                nodeContact.hide();
                nodeDaotao.hide();
                nodeDichvu.hide();
                nodeGoogleads.hide();
                nodeMarketingtree.hide();
                nodeMarketing.hide();
                nodeLytuong.hide();
            }else if(value == 'contact'){
                nodeContact.show();
                nodePage.hide();
                nodeDaotao.hide();
                nodeDichvu.hide();
                nodeGoogleads.hide();
                nodeMarketingtree.hide();
                nodeMarketing.hide();
                nodeLytuong.hide();
            }else if(value == 'daotao'){
                nodeContact.hide();
                nodePage.hide();
                nodeDichvu.hide();
                nodeGoogleads.hide();
                nodeMarketingtree.hide();
                nodeMarketing.hide();
                nodeLytuong.hide();
                nodeDaotao.show();
            }else if(value == 'dichvu'){
                nodeContact.hide();
                nodePage.hide();
                nodeDaotao.hide();
                nodeGoogleads.hide();
                nodeMarketingtree.hide();
                nodeMarketing.hide();
                nodeLytuong.hide();
                nodeDichvu.show();
            }else if(value == 'googleads'){
                nodeContact.hide();
                nodePage.hide();
                nodeDaotao.hide();
                nodeDichvu.hide();
                nodeMarketingtree.hide();
                nodeMarketing.hide();
                nodeLytuong.hide();
                nodeGoogleads.show();
            }else if(value == 'marketingtree'){
                nodeContact.hide();
                nodePage.hide();
                nodeDaotao.hide();
                nodeDichvu.hide();
                nodeGoogleads.hide();
                nodeMarketing.hide();
                nodeLytuong.hide();
                nodeMarketingtree.show();
            }else if(value == 'marketingtree'){
                nodeContact.hide();
                nodePage.hide();
                nodeDaotao.hide();
                nodeDichvu.hide();
                nodeGoogleads.hide();
                nodeMarketingtree.hide();
                nodeLytuong.hide();
                nodeMarketing.show();
            }else if(value == 'lutuong'){
                nodeContact.hide();
                nodePage.hide();
                nodeDaotao.hide();
                nodeDichvu.hide();
                nodeGoogleads.hide();
                nodeMarketingtree.hide();
                nodeMarketing.hide();
                nodeLytuong.show();
            }

            else {
                nodePage.hide();
                nodeContact.hide();
                nodeDaotao.hide();
                nodeDichvu.hide();
                nodeGoogleads.hide();
                nodeMarketingtree.hide();
                nodeMarketing.hide();
                nodeLytuong.hide();
            }
        });

    </script>
@endpush