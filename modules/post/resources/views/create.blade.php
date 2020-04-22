@extends('lito-dashboard::master')

@section('title', 'Thêm mới bài viết')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('ui/vendor/ckeditor4.8/ckeditor.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>
    <script type="text/javascript" src="{{asset('ui/vendor/moment/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('ui/vendor/moment/moment-with-locales.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
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
@endsection

@section('content')
    @inject('setting', 'Setting\Repositories\SettingRepositories')
    <div class="component">
        <h4 class="component-title">Thêm bài viết mới</h4>
        @if(Session::has('message'))
            <div class="alert alert-danger">
                <strong>{{Session::get('message')}}</strong>
            </div>
        @endif
        <form action="" method="post" role="form">

            {{csrf_field()}}

            @include('lito-dashboard::components.alert')

            <input type="hidden" name="post_author" value="{{Auth::id()}}">
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
                                           value="{{old('post_title')}}"
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
                                           value="{{old('post_slug')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Nội dung</label>
                                    <textarea id="ckeditor"
                                              class="form-control"
                                              name="post_content"
                                              required
                                              parsley-trigger="change"
                                    >{{old('post_content')}}</textarea>
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
                                    >{{old('post_excerpt')}}</textarea>
                                </div>
                            </div>
                            <!-- cấu hình thông tin trang -->
                            <div class="col-md-12 col-xs-12">

                                <div class="setting-page" id="settingpage">
                                    @include('lito-post::components.pagesetting')
                                </div>

                                <div class="setting-contact" id="setting-contact">
                                    @include('lito-post::components.contactsetting')
                                </div>

                            </div>
                           <!-- kết thúc -->
                            <div class="col-xs-12">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home">Rich Snippet</a></li>
                                    <li><a data-toggle="tab" href="#menu1">Mạng xã hội</a></li>
                                    <li><a data-toggle="tab" href="#menu2">Nâng cao</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">
                                        <h3>Cấu hình Rich snippet</h3>

                                        <div class="snippet_preview">
                                            <label>Xem trước kết quả hiển thị tìm kiếm</label>
                                            <div class="border-snip">
                                                <h4 class="seo_title" id="seo_title_value"></h4>
                                                <a class="seo_url" href="#">{{website_url()}} > <span id="slug_value"></span></a>
                                                <p class="seo_description" id="seo_description_value"></p>
                                            </div>
                                        </div>

                                        <div class="snippet_edit">
                                            <div class="form-group">
                                                <label for="seo_title">Meta title</label>
                                                <input type="text"
                                                       name="seo_title"
                                                       id="seo_title"
                                                       onkeyup="SnippetTitle();"
                                                       parsley-trigger="change"
                                                       class="form-control"
                                                       value="{{old('seo_title')}}" />
                                            </div>
                                            <div class="form-group">
                                                <label for="seo_slug">Slug</label>
                                                <input type="text" name=""
                                                       id="seo_slug"
                                                       class="form-control"
                                                       value="{{old('seo_slug')}}"
                                                       onkeyup="seoSlug();"
                                                       parsley-trigger="change"
                                                >
                                            </div>
                                            <div class="form-group">
                                                <label for="seo_keyword">Meta keywords</label>
                                                <input type="text" name="seo_keyword"
                                                       id="seo_keyword"
                                                       class="form-control inputag"
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
                                                >{{old('seo_description')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="menu1" class="tab-pane fade">
                                        <h3>Cấu hình Facebook</h3>
                                        <div class="snippet_edit">
                                            <div class="form-group">
                                                <label for="facebook_title">Facebook title</label>
                                                <input type="text"
                                                       name="facebook_title"
                                                       id="facebook_title"
                                                       class="form-control"
                                                       value="{{old('facebook_title')}}" />
                                            </div>
                                            <div class="form-group">
                                                <label for="facebook_description">Facebook description</label>
                                                <textarea
                                                        class="form-control"
                                                        name="facebook_description"
                                                        id="facebook_description"
                                                        rows="4"
                                                        parsley-trigger="change"
                                                >{{old('facebook_description')}}</textarea>
                                            </div>

                                            @include('lito-dashboard::components.upload',[
                                               'name' => 'facebook_image'
                                            ])
                                        </div>
                                    </div>
                                    <div id="menu2" class="tab-pane fade">
                                        <h3>Cấu hình nâng cao</h3>
                                        <div class="snippet_edit">
                                            <div class="form-group">
                                                <label for="follow_link" style="width: 100%">Cho phép máy tìm kiếm index link</label>
                                                <label class="checkbox-inline"><input type="radio" name="index_link" value="index" checked="checked">Có</label>
                                                <label class="checkbox-inline"><input type="radio" name="index_link" value="noindex">Không</label>
                                            </div>
                                            <div class="form-group">
                                                <label for="follow_link" style="width: 100%">Cho phép máy tìm kiếm theo dõi</label>
                                                <label class="checkbox-inline"><input type="radio" name="follow_link" value="follow" checked="checked">Có</label>
                                                <label class="checkbox-inline"><input type="radio" name="follow_link" value="nofollow">Không</label>
                                            </div>
                                            <div class="form-group">
                                                <label for="breadcrumb_title">Tiêu đề breadcrumb</label>
                                                <input type="text"
                                                       name="breadcrumb_title"
                                                       id="breadcrumb_title"
                                                       class="form-control"
                                                       value="{{old('breadcrumb_title')}}" />
                                            </div>
                                            <div class="form-group">
                                                <label for="canonical_url">Canonical Url</label>
                                                <input type="text"
                                                       name="canonical_url"
                                                       id="canonical_url"
                                                       class="form-control"
                                                       value="{{old('canonical_url')}}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-3">
                    @if($posttype=='post')
                    <div class="component-wrapper">
                        <div class="component-category">
                            <div class="form-group" style="margin-bottom: 0; width: 100%">
                                <label for="status">Chuyên mục</label>
                                <div class="post-select-category">
                                    @foreach($taxonomy as $t)
                                        <div class="col-lg-12 pdt10">
                                            <input type="checkbox" name="taxonomy_id[]" value="{{$t->id}}">
                                            <span>{{$t->name}}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <a href="{{route('lito::taxonomy.index.get',['type'=>'category'])}}" target="_blank" style="margin-top: 15px; display: block; color: #4d5ab7">Tạo chuyên mục mới</a>
                    </div>
                    @endif
                    @if($posttype=='post')
                    <div class="component-wrapper">
                        <div class="form-group" style="margin: 0">
                            <label for="status">Tags</label>
                            <input type="text" class="form-control" value="" name="tag_name" id="tokenfield" />
                        </div>
                    </div>
                    @endif
                        @if($posttype=='page')
                        <div class="component-wrapper">
                            <div class="form-group" style="margin: 0">
                                <label for="post_template">Page template</label>
                                <select name="post_template" class="form-control">
                                    <option value="default">Mặc định</option>
                                    <option value="web">Page Web</option>
                                    <option value="vps">Page Vps</option>
                                    <option value="home">Trang chủ</option>
                                    <option value="contact">Trang Liên hệ</option>
                                    <option value="about">Trang giới thiệu</option>
                                </select>
                            </div>
                        </div>
                        @endif

                    <div class="component-wrapper">
                        <div class="form-group" style="margin-bottom: 0">
                            <label for="status">Trạng thái</label>
                            <select name="post_status" class="form-control">
                                <option value="publish" {{ (old('post_status') == 'publish') ? 'selected' : '' }}>Kích hoạt</option>
                                <option value="draft" {{ (old('post_status') == 'draft') ? 'selected' : '' }}>Tạm khóa</option>
                            </select>
                        </div>
                    </div>

                        <div class="component-wrapper">
                            <div class="form-group" style="margin-bottom: 0">
                                <label for="display">Loại hiển thị</label>
                                <select name="display" class="form-control">
                                    <option value="">---Không chọn---</option>
                                    <option value="hot" {{ (old('display') == 'hot') ? 'selected' : ''
                                    }}>Nổi bật</option>
                                    <option value="home" {{ (old('display') == 'home') ? 'selected' : ''
                                    }}>Trang chủ</option>
                                </select>
                            </div>
                        </div>

                        <div class="component-wrapper">
                            <div class="form-group" style="margin-bottom: 0">
                                <label for="status">Ngày xuất bản</label>
                                <div class="input-group date" >
                                    <input
                                            type="text"
                                            name="publish_at"
                                            class="form-control"
                                            id="datetimepicker"
                                            autocomplete="off"
                                            placeholder="Click để chọn ngày"
                                            value="{!! (old('publish_at')) ? old('publish_at') : date('d/m/Y H:i', strtotime('now')) !!}"
                                    >
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="component-wrapper">
                        @include('lito-dashboard::components.thumbnail')
                        <button type="submit" class="btn btn-default btn-full">Lưu lại</button>
                        <button class="btn btn-outline btn-full"
                                type="submit"
                                name="continue_edit"
                                value="1"
                                style="margin-top: 20px"
                        >
                            Lưu và tạo mới
                        </button>
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
                                               value="{{old('post_title')}}"
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
                                               value="{{old('post_slug')}}"
                                        >
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Nhúng video</label>
                                        <input type="text"
                                               class="form-control"
                                               parsley-trigger="change"
                                               required
                                               name="post_video"
                                               id="input_slug"
                                               value="{{old('post_video')}}"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-3">

                        <div class="component-wrapper">
                            <div class="form-group" style="margin-bottom: 0">
                                <label for="status">Trạng thái</label>
                                <select name="post_status" class="form-control">
                                    <option value="publish" {{ (old('post_status') == 'publish') ? 'selected' : '' }}>Kích hoạt</option>
                                    <option value="draft" {{ (old('post_status') == 'draft') ? 'selected' : '' }}>Tạm khóa</option>
                                </select>
                            </div>
                        </div>


                        <div class="component-wrapper">
                            <div class="form-group" style="margin-bottom: 0">
                                <label for="status">Ngày xuất bản</label>
                                <div class="input-group date" >
                                    <input
                                            type="text"
                                            name="publish_at"
                                            class="form-control"
                                            id="datetimepicker"
                                            autocomplete="off"
                                            placeholder="Click để chọn ngày"
                                            value="{!! (old('publish_at')) ? old('publish_at') : date('d/m/Y H:i', strtotime('now')) !!}"
                                    >
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="component-wrapper">
                            @include('lito-dashboard::components.thumbnail')
                            <button type="submit" class="btn btn-default btn-full">Lưu lại</button>
                            <button class="btn btn-outline btn-full"
                                    type="submit"
                                    name="continue_edit"
                                    value="1"
                                    style="margin-top: 20px"
                            >
                                Lưu và tạo mới
                            </button>
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
        nodePage.hide();
        nodeContact.hide();
        templateType.on('change', function (e) {
            var _this = $(e.currentTarget);
            var value = _this.val();
            if (value == 'about') {
                nodePage.show();
            }
            else if(value == 'contact'){
                nodeContact.show();
                nodePage.hide();
            }
            else {
                nodePage.hide();
                nodeContact.hide();
            }
        });

    </script>
@endpush

@push('js-react')
    <script src="{{asset('js/app.js')}}" type="text/javascript"></script>
@endpush

