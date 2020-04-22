@extends('lito-dashboard::master')

@section('title', 'Thêm mới bài viết')

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
            <input type="hidden" name="edited_by" value="{{Auth::id()}}">

            <div class="row">
                <div class="col-xs-12 col-md-9">
                    <div class="component-wrapper">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="post_title">Tiêu đề slide</label>
                                    <input type="text"
                                           class="form-control"
                                           data-parsley-minlength="3"
                                           name="name"
                                           required
                                           placeholder="Nhập tiêu đề"
                                           value="{{$data->name}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="slug">Tên button</label>
                                    <input type="text"
                                           class="form-control"
                                           name="button_name"
                                           value="{{$data->button_name}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="url">Link button</label>
                                    <input type="text"
                                           class="form-control"
                                           name="url"
                                           value="{{$data->url}}"
                                           placeholder="Liên kết link với slide"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Mô tả ngắn</label>
                                    <textarea
                                            class="form-control"
                                            name="description"
                                            rows="4"
                                    >{{$data->description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Nội dung</label>
                                    <textarea
                                            class="form-control"
                                            name="content"
                                            rows="4"
                                            parsley-trigger="change"
                                    >{{$data->content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Iframe video</label>
                                    <textarea
                                            class="form-control"
                                            name="videoframe"
                                            rows="4"
                                    >{{$data->videoframe}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="slug">Thứ tự</label>
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
                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ ($data->status == 'active') ? 'selected' : '' }}>Kích hoạt</option>
                                <option value="disable" {{ ($data->status == 'disable') ? 'selected' : '' }}>Tạm khóa</option>
                            </select>
                        </div>
                    </div>
                    <div class="component-wrapper">

                        @include('lito-dashboard::components.thumbnail',['data' => $data])

                        <button type="submit" class="btn btn-default btn-full">Lưu lại</button>

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

