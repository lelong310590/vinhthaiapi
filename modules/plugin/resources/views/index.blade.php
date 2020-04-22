@extends('lito-dashboard::master')

@section('title', 'Danh sách Module')

@section('content')

    @php
        $user = Auth::user();
        $roles = $user->load('roles.perms');
        $permissions = $roles->roles->first()->perms;
    @endphp

    <div class="component">
        <h4 class="component-title">Danh sách Module</h4>
        <div class="component-table">
            <div class="component-table-bar">
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
                        <th>Tên Module</th>
                        <th>Miêu tả</th>
                        <th width="200">Trạng thái</th>
                        <th width="200">Ngày khởi tạo</th>
                        <th width="150"><b>Thao tác</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data as $p)
                        <tr>
                            <td>{{$p->name}}</td>
                            <td>{{$p->description}}</td>
                            <td width="200">{!! conver_status($p->status, route('lito::plugin.status.get', ['status' => $p->status, 'id' => $p->id])) !!}</td>
                            <td width="200">{{$p->created_at}}</td>
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
                            <div class="table-count">{{count($data)}} bản ghi</div>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

@endsection