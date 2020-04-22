@extends('lito-dashboard::master')

@section('title', 'Sửa nhóm bảng giá')

@section('content')

    @php
        $user = Auth::user();
        $roles = $user->load('roles.perms');
        $permissions = $roles->roles->first()->perms;
    @endphp

    <div class="component">
        <h4 class="component-title">Sửa nhóm bảng giá</h4>

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
                                    <label for="name">Tên nhóm</label>
                                    <input type="text"
                                           class="form-control"
                                           required
                                           data-parsley-minlength="3"
                                           name="name"
                                           value="{{$data->name}}"
                                           id="input_name"
                                           onkeyup="changeSlug();"
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="slug">Đường dẫn tĩnh</label>
                                    <input type="text"
                                           class="form-control"
                                           parsley-trigger="change"
                                           name="slug"
                                           id="input_slug"
                                           value="{{$data->slug}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="index">Thứ tự</label>
                                    <input type="number"
                                           min="0"
                                           class="form-control"
                                           name="index"
                                           value="{{$data->index}}"
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
                                    <label for="status">Trạng thái nhóm bảng giá</label>
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

@push('js-react')
    <script src="{{asset('js/app.js')}}" type="text/javascript"></script>
@endpush