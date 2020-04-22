@extends('lito-dashboard::master')

@section('title', 'Tạo nhóm FAQs')

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
        <h4 class="component-title">Tạo nhóm FAQs</h4>

        <form action="" method="post" role="form">

            {{csrf_field()}}

            <div class="row">
                <div class="col-xs-12 col-md-9">
                    <div class="component-wrapper">

                        @include('lito-dashboard::components.alert')

                        <input type="hidden" name="edited_by" value="{{Auth::id()}}">

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="name">Tên nhóm FAQs</label>
                                    <input type="text"
                                           required
                                           class="form-control"
                                           autocomplete="off"
                                           name="name"
                                           value="{{$data->name}}"
                                    >
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label">Miêu tả nhóm</label>
                                    <textarea class="form-control"
                                              name="content"
                                              parsley-trigger="change"
                                    >{{$data->content}}</textarea>
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label">Thứ tự</label>
                                    <small></small>
                                    <input type="number"
                                           min="0"
                                           class="form-control"
                                           autocomplete="off"
                                           name="sort"
                                           value="{{$data->sort}}"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-3">
                    <div class="component-wrapper">

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="status">Trạng thái</label>
                                    <select name="status" class="form-control">
                                        <option value="active" {{ ($data->status == 'active') ? 'selected' : '' }}>Kích hoạt</option>
                                        <option value="disable" {{ ($data->status == 'disable') ? 'selected' : '' }}>Tạm khóa</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-default btn-full">Lưu lại</button>

                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
