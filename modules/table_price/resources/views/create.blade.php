@extends('lito-dashboard::master')

@section('title', 'Tạo bảng giá')

@section('content')

    @php
        $user = Auth::user();
        $roles = $user->load('roles.perms');
        $permissions = $roles->roles->first()->perms;
    @endphp

    <div class="component">
        <h4 class="component-title">Tạo bảng giá</h4>

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
                                    <label for="name">Tên gói giá</label>
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
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label for="price">Giá gốc</label>
                                    <input type="text"
                                           required
                                           class="form-control"
                                           autocomplete="off"
                                           data-parsley-minlength="2"
                                           name="price"
                                           id="price"
                                           value="{{old('price')}}"
                                    >
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label for="sale_price">Giá khuyến mại</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           data-parsley-minlength="2"
                                           name="sale_price"
                                           value="{{old('sale_price')}}"
                                    >
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label for="price_type">Kiểu giá</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           data-parsley-minlength="2"
                                           name="price_type"
                                           value="{{old('price_type')}}"
                                           placeholder="/ tháng, năm, ..."
                                    >
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="index">Thứ tự</label>
                                    <input type="text"
                                           class="form-control"
                                           autocomplete="off"
                                           name="index"
                                           value="0"
                                    >
                                </div>
                            </div>

                        </div>




                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="fullname">Miêu tả</label>
                                    <textarea type="text"
                                              class="form-control"
                                              autocomplete="off"
                                              name="description"
                                              value="{{old('description')}}"
                                              rows="5"
                                    ></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div id="TablePriceCreate"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-3">
                    <div class="component-wrapper">

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="status">Nhóm bảng giá</label>
                                    <select name="group" class="form-control">
                                        @foreach($group as $g)
                                            <option value="{{$g->id}}" {{ (old('group') == $g->id) ? 'selected' : '' }}>{{$g->name}}</option>
                                        @endforeach
                                    </select>
                                    <a href="{{route('lito::tablepricegroup.create.get')}}" target="_blank" style="margin-top: 15px; display: block; color: #4d5ab7">Tạo nhóm mới</a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="status">Trạng thái bảng giá</label>
                                    <select name="status" class="form-control">
                                        <option value="active" {{ (old('status') == 'active') ? 'selected' : '' }}>Kích hoạt</option>
                                        <option value="disable" {{ (old('status') == 'disable') ? 'selected' : '' }}>Tạm khóa</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="status">Gói nổi bật</label>
                                    <select name="main" class="form-control">
                                        <option value="1" {{ (old('main') == '1') ? 'selected' : '' }}>Kích hoạt</option>
                                        <option value="0" {{ (old('main') == '0') ? 'selected' : '' }}>Không kích hoạt</option>
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

@push('js-react')
    <script src="{{asset('js/app.js')}}" type="text/javascript"></script>
@endpush