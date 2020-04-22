@extends('lito-dashboard::master')

@section('title', 'Sửa cấu hình chung')

@section('js')
    <script type="text/javascript" src="{{asset('ui/vendor/ckeditor4.8/ckeditor.js')}}"></script>
@endsection
@section('js-init')
    <script type="text/javascript" src="{{asset('ui/vendor/ckeditor4.8/init.js')}}"></script>
@endsection

@section('content')
    @inject('setting', 'Setting\Repositories\SettingRepositories')
    <div class="component">
        <h4 class="component-title">Sửa cấu hình chung</h4>

        <form action="" method="post" role="form">

            {{csrf_field()}}

            @include('lito-dashboard::components.alert')

            <div class="row">
                <div class="col-xs-12 col-md-9">
                    <div class="component-wrapper">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="site_title">Tiêu đề trang chủ</label>
                                    <input type="text"
                                           class="form-control"
                                           required
                                           name="site_title"
                                           placeholder="Nhập tiêu đề cho trang chủ"
                                           value="{{$setting->getSettingMeta('site_title')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="site_keyword">Thẻ Meta keyword </label>
                                    <input type="text"
                                           class="form-control"
                                           required
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
                                           required
                                           name="site_email"
                                           value="{{$setting->getSettingMeta('site_email')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="site_hotline">Hotline</label>
                                    <input type="text"
                                           class="form-control"
                                           required
                                           name="site_hotline"
                                           value="{{$setting->getSettingMeta('site_hotline')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Nội dung chân trang</label>
                                    <textarea id="ckeditor"
                                              class="form-control"
                                              name="site_footer"
                                              required
                                              parsley-trigger="change"
                                    >{{$setting->getSettingMeta('site_footer')}}</textarea>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-3">

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
        </form>
    </div>


@endsection
