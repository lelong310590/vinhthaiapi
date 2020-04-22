@extends('lito-dashboard::master')

@section('title', 'Danh sách liên hệ')

@section('content')

    @php
        $user = Auth::user();
        $roles = $user->load('roles.perms');
        $permissions = $roles->roles->first()->perms;
    @endphp

    <div class="component">

        <h4 class="component-title">Sửa Form liên hệ</h4>

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
                                    <label for="name">Tên Form liên hệ</label>
                                    <input type="text"
                                           required
                                           class="form-control"
                                           autocomplete="off"
                                           name="name"
                                           value="{{$data->name}}"
                                    >
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

    <div class="component">
        <h4 class="component-title">Danh sách liên hệ trong form</h4>
        <div class="component-table">
            <div class="component-table-bar">
                <div class="component-table-filter">
                    <div class="component-table-search">
                        <form method="get" role="form">
                            <div class="form-group">
                                <input type="text" class="form-control" name="keyword" placeholder="Tìm kiếm.." value="{{Request::get('keyword')}}">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="component-table-content">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="150">Ngày nhận</th>
                        <th width="200">Người liên hệ</th>
                        <th width="200">Email</th>
                        <th>
                            @if($group!=1)
                            Tiêu đề
                            @else
                            Số lượng
                            @endif
                        </th>
                        <th>
                            @if($group!=1)
                                Nội dung
                            @else
                                Địa chỉ
                            @endif
                        </th>
                        <th width="150">Trạng thái</th>
                        <th width="150"><b>Thao tác</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($contacts as $d)
                        <tr>
                            <td width="150">{{datetoformat($d->created_at)}}</td>
                            <td width="200">{{$d->contact_name}}</td>
                            <td width="200">{{$d->email}}</td>
                            <td>{{$d->contact_title}}</td>
                            <td>{{$d->content}}</td>
                            <td width="150">
                                @if($d->status=='active')
                                    <span class="btn btn-success btn-xs"><i class="fa fa-envelope-open"></i> Đã đọc</span>
                                @endif
                                @if($d->status=='disable')
                                    <span class="btn btn-danger btn-xs"><i class="fa fa-envelope"></i> Chưa đọc</span>
                                @endif
                            </td>
                            <td width="150" class="action">
                                <a href="{{route('lito::contact.detail.get',$d->id)}}" title="Xem tin nhắn"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                <a href="javascript:;" class="delete-record" data-href="{{route('lito::contact.delete.get',$d->id)}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                Chưa có bản ghi nào !
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="100%" class="table-footer">
                            <div class="table-count">{{$contacts->total()}} bản ghi</div>

                            {{$contacts->links('lito-dashboard::components.pagination')}}

                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>

@endsection
