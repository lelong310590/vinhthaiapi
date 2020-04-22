@extends('lito-dashboard::master')

@section('title', 'Thêm mới Ticket')

@section('css')

@endsection

@section('js')

@endsection

@section('js-init')

@endsection

@section('content')

    <div class="component">
        <h4 class="component-title">Thêm Ticket mới</h4>

        <form action="" method="post" role="form">

            {{csrf_field()}}

            @include('lito-dashboard::components.alert')

            <input type="hidden" name="owner" value="{{Auth::id()}}">
            <input type="hidden" name="domain" value="{{website_url()}}">
            <input type="hidden" name="name" value="{{Auth::user()->full_name}}">
            <input type="hidden" name="email" value="{{Auth::user()->email}}">
            <input type="hidden" name="type" value="{{$type}}">

            <div class="row">
                <div class="col-xs-12 col-md-9">
                    <div class="component-wrapper">
                        <div class="row">
                            <div class="col-xs-12">

                                <div class="form-group">
                                    <label for="title">Phòng</label>
                                    <select name="support_name" class="form-control">
                                        <option value="it" {{(old('support_name') == 'it') ? 'selected' : '' }} >Phòng kỹ thuật</option>
                                        <option value="sale" {{(old('support_name') == 'sale') ? 'selected' : '' }} >Phòng kinh doanh</option>
                                        <option value="accountant" {{(old('support_name') == 'accountant') ? 'selected' : '' }} >Phòng kế toán</option>
                                        <option value="cskh" {{(old('support_name') == 'cskh') ? 'selected' : '' }} >CSKH</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="title">Tiêu đề ticket</label>
                                    <input type="text"
                                           class="form-control"
                                           data-parsley-minlength="3"
                                           name="title"
                                           required
                                           placeholder="Nhập tiêu đề cho ticket"
                                           value="{{old('title')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">Nội dung</label>
                                    <textarea
                                            class="form-control"
                                            name="content"
                                            rows="6"
                                            parsley-trigger="change"
                                    >{{old('content')}}</textarea>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-3">

                    <div class="component-wrapper">
                        @include('lito-dashboard::components.thumbnail',['title'=>'Ảnh đính kèm'])
                    </div>
                    <div class="component-wrapper">

                        <button type="submit" class="btn btn-default btn-full">Thêm mới</button>

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

