@php
    $title = 'danh mục';

    if (Request::get('type') == 'tag') {
        $title = 'tag';
    }
@endphp

@extends('lito-dashboard::master')

@section('title', 'Thêm '.$title)

@section('js')
    <script type="text/javascript" src="{{asset('ui/vendor/ckeditor4.8/ckeditor.js')}}"></script>
@endsection
@section('js-init')
    <script type="text/javascript" src="{{asset('ui/vendor/ckeditor4.8/init.js')}}"></script>
@endsection

@section('content')

    <div class="component">
        <h4 class="component-title">Thêm {{$title}}</h4>
        @if(Session::has('message'))
            <div class="alert alert-danger">
                <strong>{{Session::get('message')}}</strong>
            </div>
        @endif
        <form action="" method="post" role="form">

            {{csrf_field()}}

            @include('lito-dashboard::components.alert')

            <input type="hidden" name="created_by" value="{{Auth::id()}}">
            <input type="hidden" name="edited_by" value="{{Auth::id()}}">
            <input type="hidden" name="taxonomy_type" value="{{$type}}">
            <div class="row">
                <div class="col-xs-12 col-md-9">
                    <div class="component-wrapper">
                        <div class="row">
                            <div class="col-xs-12">

                                <div class="form-group">
                                    <label for="name">Tên {{$title}}</label>
                                    <input type="text"
                                           class="form-control"
                                           required
                                           data-parsley-minlength="3"
                                           parsley-trigger="change"
                                           name="name"
                                           id="input_name"
                                           onkeyup="changeSlug();"
                                           value="{{old('name')}}"
                                    >
                                </div>
                                @if($type=='category')
                                <div class="form-group">
                                    <label for="name">Danh mục cha</label>
                                    <select name="parent" id="inputID" class="form-control">
                                        <option value="0"> -- Là danh mục cha -- </option>
                                        @php
                                            MultiMenu($data);
                                        @endphp
                                    </select>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="slug">Đường dẫn tĩnh</label>
                                    <input type="text"
                                           class="form-control"
                                           parsley-trigger="change"
                                           required
                                           name="slug"
                                           id="input_slug"
                                           value="{{old('slug')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Mô tả</label>
                                    <textarea id="ckeditor"
                                              class="form-control"
                                              name="excerpt"
                                              required
                                              parsley-trigger="change"
                                    >{{old('excerpt')}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="index">Thứ tự</label>
                                    <input type="number"
                                           min="1"
                                           class="form-control"
                                           name="index"
                                           id="index"
                                           value="{{old('index')}}"
                                    >
                                </div>
                            </div>


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
                                                <h4 class="seo_title" id="seo_title_value">Thiết kế website Lito</h4>
                                                <a class="seo_url" href="#">{{ website_url() }} > <span id="slug_value"></span></a>
                                                <p class="seo_description" id="seo_description_value">Công ty thiết kế website sử dụng công nghệ mới nhất,không cần thời gian load trang, trải nghiệm tức thì. </p>

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
                                                <label for="seo_keyword">Meta keyword</label>
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
                                                        onkeyup="taxonomyMetaChange();"
                                                        parsley-trigger="change"
                                                >{{old('seo_description')}}</textarea>
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
                                                <label for="" style="width: 100%">Cho phép máy tìm kiếm index</label>
                                                <input type="radio" name="index_link" value="index" checked="checked"> <span>Có</span>
                                                <input type="radio" name="index_link" value="noindex"> <span>Không</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="" style="width: 100%">Cho phép máy tìm kiếm theo dõi</label>
                                                <input type="radio" name="follow_link" value="follow" checked="checked"> <span>Có</span>
                                                <input type="radio" name="follow_link" value="nofollow"> <span>Không</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="breadcrumb_title">Breadcrumb title</label>
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
                    <div class="component-wrapper">
                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ (old('status') == 'active') ? 'selected' : '' }}>Kích hoạt</option>
                                <option value="disable" {{ (old('status') == 'disable') ? 'selected' : '' }}>Tạm khóa</option>
                            </select>
                        </div>
                    </div>
                    <div class="component-wrapper">
                        <div class="form-group">
                            <label for="display">Loại hiển thị</label>
                            <select name="display" class="form-control">
                                <option value="">---Không chọn---</option>
                                <option value="home" {{ (old('display') == 'home') ? 'selected' : '' }}>Danh mục trang
                                    chủ 1</option>
                                <option value="bottom" {{ (old('display') == 'bottom') ? 'selected' : ''
                                }}>Danh mục trang chủ 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="component-wrapper">
                        {{--@include('lito-dashboard::components.thumbnail')--}}
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
        </form>
    </div>


@endsection
@push('js')
    <script type="text/javascript">
        var nodeType = $('select[name="taxonomy_type"]');
        var nodeParent = $('.node-parent');
        nodeParent.hide();

        nodeType.on('change', function (e) {
            var _this = $(e.currentTarget);
            var value = _this.val();
            if (value == 'newscategory') {
                nodeParent.show();
                $('input[name="url"]').attr('readonly', true)
            }else if (value == 'tag') {
                nodeParent.hide();
                $('input[name="url"]').attr('readonly', true)
            }
            else {
                nodeParent.hide();
            }
        })
    </script>
@endpush