@extends('lito-dashboard::master')

@section('title', 'Sửa comment')

@section('js')
    <script type="text/javascript" src="{{asset('ui/vendor/ckeditor4.8/ckeditor.js')}}"></script>
@endsection

@section('js-init')
    <script type="text/javascript" src="{{asset('ui/vendor/ckeditor4.8/init.js')}}"></script>
@endsection

@section('content')
    @inject('settingseo', 'Taxonomy\Repositories\TaxonomyMetaRepository')
    <div class="component">
        <h4 class="component-title">Sửa comment</h4>

        <form action="" method="post" role="form">
            {{csrf_field()}}
            @include('lito-dashboard::components.alert')

            <div class="row">
                <div class="col-xs-12 col-md-9">
                    <div class="component-wrapper">
                        <div class="row">
                            <div class="col-xs-12">

                                <div class="form-group">
                                    <label for="name">Họ tên</label>
                                    <input type="text"
                                           class="form-control"
                                           required
                                           data-parsley-minlength="3"
                                           name="name"
                                           value="{{$data->name}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text"
                                           class="form-control"
                                           required
                                           name="email"
                                           value="{{$data->email}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="text"
                                           class="form-control"
                                           name="phone"
                                           value="{{$data->phone}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Nội dung</label>
                                    <textarea id="ckeditor"
                                              class="form-control"
                                              name="comment_content"
                                              parsley-trigger="change"
                                    >{{$data->comment_content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Website</label>
                                    <input type="text"
                                           class="form-control"
                                           name="website"
                                           value="{{$data->website}}"
                                    >
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-3">
                    <div class="component-wrapper">
                        <div class="form-group">
                            <label for="approved">Duyệt comment</label>
                            <select name="approved" class="form-control">
                                <option value="accept" {{ ($data->approved == 'accept') ? 'selected' : '' }}>Chấp nhận</option>
                                <option value="cancel" {{ ($data->approved == 'cancel') ? 'selected' : '' }}>Tạm khóa</option>
                            </select>
                        </div>
                    </div>
                    <div class="component-wrapper">

                        <button type="submit" class="btn btn-default btn-full">Xác nhận thêm</button>

                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection
