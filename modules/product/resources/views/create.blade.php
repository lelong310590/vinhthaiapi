@extends('lito-dashboard::master')

@section('title', 'Thêm mới bài viết')

@section('css')

@endsection

@section('js')
    <script type="text/javascript" src="{{asset('ui/vendor/ckeditor4.8/ckeditor.js')}}"></script>
@endsection

@section('js-init')
    <script type="text/javascript" src="{{asset('ui/vendor/ckeditor4.8/init.js')}}"></script>
@endsection

@section('content')
    @inject('setting', 'Setting\Repositories\SettingRepositories')
    <div class="component">
        <h4 class="component-title">Thêm sản phẩm mới</h4>

        <form action="" method="post" role="form">
            {{csrf_field()}}
            @include('lito-dashboard::components.alert')

            <div class="row">
                <div class="col-xs-12 col-md-9">
                    <div class="component-wrapper">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="post_title">Tên sản phẩm</label>
                                    <input type="text"
                                           class="form-control"
                                           required
                                           data-parsley-minlength="3"
                                           parsley-trigger="change"
                                           name="name"
                                           id="input_name"
                                           placeholder="Nhập tên sản phẩm"
                                           onkeyup="changeSlug();"
                                           value="{{old('name')}}"
                                    >
                                </div>
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
                                    <label for="product_code">Học viên</label>
                                    <input type="text"
                                           class="form-control"
                                           required
                                           name="product_code"
                                           id="product_code"
                                           value="{{old('product_code')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="class_name">Lớp</label>
                                    <input type="text"
                                           class="form-control"
                                           name="class_name"
                                           id="class_name"
                                           value="{{old('class_name')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Nội dung</label>
                                    <textarea id="ckeditor"
                                              class="form-control"
                                              name="content"
                                              required
                                              parsley-trigger="change"
                                    >{{old('content')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Mô tả ngắn</label>
                                    <textarea
                                            class="form-control"
                                            name="excerpt"
                                            id="post_excerpt"
                                            rows="4"
                                            parsley-trigger="change"
                                            onkeyup="metaDescritionChange();"
                                    >{{old('excerpt')}}</textarea>
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

                        <div class="component-wrapper">
                            <div class="component-category">
                                <div class="form-group" style="margin-bottom: 0; width: 100%">
                                    <label for="status">Danh mục</label>
                                    <div class="post-select-category">
                                        @foreach($category as $t)
                                            <div class="col-lg-12 pdt10">
                                                <input type="checkbox" name="category[]" value="{{$t->id}}">
                                                <span>{{$t->name}}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <a href="{{route('lito::taxonomy.index.get',['type'=>'category'])}}" target="_blank" style="margin-top: 15px; display: block; color: #4d5ab7">Tạo chuyên mục mới</a>
                        </div>

                    <div class="component-wrapper">
                        <div class="form-group" style="margin-bottom: 0">
                            <label for="status">Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ (old('status') == 'active') ? 'selected' : '' }}>Kích
                                    hoạt</option>
                                <option value="disable" {{ (old('status') == 'disable') ? 'selected' : '' }}>Tạm
                                    khóa</option>
                                <option value="new" {{ (old('status') == 'new') ? 'selected' : '' }}>Sản phẩm
                                    mới</option>
                            </select>
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
        </form>
    </div>
@endsection

@push('js')

@endpush


