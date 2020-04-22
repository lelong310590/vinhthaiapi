@extends('lito-dashboard::master')

@section('title', 'Thêm mới slide')

@section('css')

@endsection

@section('js')

@endsection

@section('js-init')

@endsection

@section('content')

    <div class="component">
        <h4 class="component-title">Thêm slide mới</h4>

        <form action="" method="post" role="form">

            {{csrf_field()}}

            @include('lito-dashboard::components.alert')

            <input type="hidden" name="created_by" value="{{Auth::id()}}">
            <input type="hidden" name="edited_by" value="{{Auth::id()}}">

            <div class="row">
                <div class="col-xs-12 col-md-9">
                    <div class="component-wrapper">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="post_title">Tên loại slide</label>
                                    <input type="text"
                                           class="form-control"
                                           data-parsley-minlength="3"
                                           name="name"
                                           required
                                           placeholder="Nhập tên"
                                           value="{{old('name')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Nội dung</label>
                                    <textarea
                                              class="form-control"
                                              name="content"
                                              rows="4"
                                              parsley-trigger="change"
                                    >{{old('content')}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="slug">Thứ tự</label>
                                    <input type="number"
                                           min="0"
                                           class="form-control"
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
                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ (old('status') == 'active') ? 'selected' : '' }}>Kích hoạt</option>
                                <option value="disable" {{ (old('status') == 'disable') ? 'selected' : '' }}>Tạm khóa</option>
                            </select>
                        </div>
                    </div>
                    <div class="component-wrapper">

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

