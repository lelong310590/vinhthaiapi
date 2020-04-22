@extends('lito-dashboard::master')

@section('title', 'Tạo ý kiến')

@section('js')
    <script type="text/javascript" src="{{asset('ui/vendor/ckeditor4.8/ckeditor.js')}}"></script>
@endsection

@section('js-init')
    <script type="text/javascript" src="{{asset('ui/vendor/ckeditor4.8/init.js')}}"></script>
@endsection

@section('content')

    @php
        $user = Auth::user();
        $roles = $user->load('roles.perms');
        $permissions = $roles->roles->first()->perms;
    @endphp

    <div class="component">
        <h4 class="component-title">Tạo review</h4>

        <form action="" method="post" role="form">

            {{csrf_field()}}

            <div class="row">
                <div class="col-xs-12 col-md-9">
                    <div class="component-wrapper">

                        @include('lito-dashboard::components.alert')

                        <input type="hidden" name="created_by" value="{{Auth::id()}}">

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="name">Họ và tên</label>
                                    <input type="text"
                                           class="form-control"
                                           required
                                           data-parsley-minlength="3"
                                           name="name"
                                           value="{{old('name')}}"
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="price">Vai trò</label>
                                    <input type="text"
                                           required
                                           class="form-control"
                                           autocomplete="off"
                                           data-parsley-minlength="2"
                                           name="office"
                                           id="office"
                                           value="{{old('office')}}"
                                    >
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="sale_price">Link</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           data-parsley-minlength="2"
                                           name="company"
                                           value="{{old('company')}}"
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="fullname">Khóa học</label>
                                    <textarea type="text"
                                              class="form-control"
                                              autocomplete="off"
                                              name="content"
                                              value="{{old('content')}}"
                                              rows="5"
                                    >{{old('content')}}</textarea>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="index">Thứ tự</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="index"
                                           value="{{old('index')}}"
                                    >
                                </div>
                            </div>

                        </div>



                    </div>
                </div>





                <div class="col-xs-12 col-md-3">
                    <div class="component-wrapper">

                        @include('lito-dashboard::components.thumbnail')

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="status">Trạng thái</label>
                                    <select name="status" class="form-control">
                                        <option value="active" {{ (old('status') == 'active') ? 'selected' : '' }}>Kích hoạt</option>
                                        <option value="disable" {{ (old('status') == 'disable') ? 'selected' : '' }}>Tạm khóa</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-default btn-full">Tạo mới</button>

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