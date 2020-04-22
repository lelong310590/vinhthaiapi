@extends('lito-dashboard::master')

@section('title', 'Sửa loại menu')

@section('content')

    <div class="component">
        <h4 class="component-title">Sửa loại menu</h4>

        <form action="" method="post" role="form">

            {{csrf_field()}}

            @include('lito-dashboard::components.alert')

            <input type="hidden" name="edited_by" value="{{Auth::id()}}">

            <div class="row">
                <div class="col-xs-12 col-md-9">
                    <div class="component-wrapper">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="name">Tên loại menu</label>
                                    <input type="text"
                                           class="form-control"
                                           required
                                           data-parsley-minlength="3"
                                           parsley-trigger="change"
                                           name="name"
                                           id="input_name"
                                           onkeyup="menuSlug();"
                                           value="{{$data->name}}"
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
                                           value="{{$data->slug}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="position">Thuộc tính</label>
                                    <input type="text"
                                           class="form-control"
                                           name="position"
                                           value="{{$data->position}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="status">Trạng thái</label>
                                    <select name="status" class="form-control">
                                        <option value="active" {{ ($data->status == 'active') ? 'selected' : '' }}>Kích hoạt</option>
                                        <option value="disable" {{ ($data->status == 'disable') ? 'selected' : '' }}>Tạm khóa</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-3">
                    <div class="component-wrapper">
                        <button type="submit" class="btn btn-default btn-full">Lưu lại</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection
