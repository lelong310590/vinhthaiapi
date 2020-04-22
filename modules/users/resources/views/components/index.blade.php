@extends('lito-dashboard::master')

@section('title', 'Danh sách tài khoản')

@section('content')

    @php
        $user = Auth::user();
        $roles = $user->load('roles.perms');
        $permissions = $roles->roles->first()->perms;
    @endphp

    <div class="component">
        <h4 class="component-title">Danh sách tài khoản</h4>
        <div class="component-table">
            <div class="component-table-bar">
                <a href="{{route('lito::users.create.get')}}" class="btn-outline text-uppercase component-table-bar-button">Tạo tài khoản</a>

                <div class="component-table-filter">
                    <div class="component-table-search">
                        <form action="" method="get" role="form">

                            <div class="form-group">
                                <input type="text" class="form-control" name="keyword" placeholder="Tìm kiếm.." value="{{Request::get('keyword')}}">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="component-table-content">

                @include('lito-dashboard::components.alert')

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="150">Ảnh đại diện</th>
                            <th>Tên đăng nhập</th>
                            <th>Họ và tên</th>
                            <th width="150">Vai trò</th>
                            <th width="150">Trạng thái</th>
                            <th width="150"><b>Thao tác</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $user)
                            <tr>
                                <td width="150">
                                    <a class="table-thumbnail" href="{{route('lito::users.edit.get', $user->id)}}">
                                        <img src="{{get_thumbnail($user->thumbnail)}}" alt="{{$user->full_name}}" class="img-responsive">
                                    </a>
                                </td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->full_name}}</td>
                                <td width="150">{{$user->getRole()}}</td>
                                <td width="150">{!! conver_status($user->status, route('lito::users.status.get', ['status' => $user->status, 'id' => $user->id])) !!}</td>
                                <td class="action" width="150">
                                    <a href="{{route('lito::users.edit.get', $user->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a href="javascript:;" class="delete-record" data-href="{{route('lito::users.delete.get', $user->id)}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">
                                    Chưa có bản ghi nào !
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="100%" class="table-footer">
                                <div class="table-count">{{$data->total()}} bản ghi</div>

                                {{$data->links('lito-dashboard::components.pagination')}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

@endsection