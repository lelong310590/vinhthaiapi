@extends('lito-dashboard::master')

@section('title', 'Xem lịch sử')

@section('content')
    <div class="component">
        <h4 class="component-title">Danh sách lịch sử hệ thống</h4>
        <div class="component-table">
            <div class="component-table-bar">
                <div class="component-table-filter">
                    <div class="component-table-search">
                        <form method="get" role="form">
                            <div class="input-group date" >
                                <input type="text" name="find-date" class="form-control" id="datepicker" autocomplete="off" placeholder="Click để chọn ngày">
                                <div class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-default" value="Tìm kiếm" style="margin-left: 15px">
                        </form>
                    </div>
                </div>
            </div>

            <div class="component-table-content">

                @include('lito-dashboard::components.alert')

                @empty($data)
                    <div class="history-content">
                        Không có dữ liệu
                    </div>
                @else
                    <div class="history-content">
                        {!! $data !!}
                    </div>
                @endempty
            </div>
        </div>
    </div>
@endsection
