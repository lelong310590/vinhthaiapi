@extends('lito-dashboard::master')

@section('title', 'Danh sách ý kiến')

@section('content')

    @php
        $user = Auth::user();
        $roles = $user->load('roles.perms');
        $permissions = $roles->roles->first()->perms;
    @endphp

    <div class="component">
        <h4 class="component-title">Danh sách ý kiến</h4>
        <div class="component-table">
            <div class="component-table-bar">
                <a href="{{route('lito::testimonial.create.get')}}" class="btn-outline text-uppercase component-table-bar-button">Tạo ý kiến</a>

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
                        <th>Họ và tên</th>
                        <th>Công ty</th>
                        <th width="200">Trạng thái</th>
                        <th width="100">Thứ tự</th>
                        <th width="150"><b>Thao tác</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data as $p)
                        <tr>
                            <td>{{$p->name}}</td>
                            <td>{{$p->office}}</td>
                            <td width="200">{!! conver_status($p->status, route('lito::testimonial.status.get', ['status' => $p->status, 'id' => $p->id])) !!}</td>
                            <td width="200">{{$p->index}}</td>
                            <td class="action" width="150">
                                <a href="{{route('lito::testimonial.edit.get', $p->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a href="javascript:;" class="delete-record" data-href="{{route('lito::testimonial.delete.get', $p->id)}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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