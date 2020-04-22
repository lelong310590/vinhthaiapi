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
                <div class="col-xs-12 col-md-3 setting-menu" style="position: -webkit-sticky; position: sticky; top: 50px;">
                    <div class="component-wrapper">
                    <ul class="tab-menu-setting">
                        {{--<li class="active"><a data-toggle="tab" href="#website"><i class="fa fa-adjust"></i> Page Website</a></li>--}}
                        {{--<li><a data-toggle="tab" href="#vps"><i class="fa fa-archive"></i> Page VPS</a></li>--}}
                        <li><a data-toggle="tab" href="#all"><i class="fa fa-arrows"></i> Cấu hình chung</a></li>
                        <li><a data-toggle="tab" href="#email"><i class="fa fa-envelope-square"></i> Cấu hình Email Smtp</a></li>
                    </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-md-9 setting-content">
                    <div class="component-wrapper">
                        <div class="tab-content">
                            @include('lito-setting::components.tab_3')
                            @include('lito-setting::components.email')
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
