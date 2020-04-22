@extends('lito-dashboard::master')

@section('title', 'Danh sách loại menu')

@section('content')

    @php
        $user = Auth::user();
        $roles = $user->load('roles.perms');
        $permissions = $roles->roles->first()->perms;
    @endphp

    <div class="component">
        <h4 class="component-title">Danh sách loại menu</h4>
        <div class="component-table">
            <div class="component-table-bar">
                @if ($permissions->contains('name','menu_create'))
                    <a href="{{route('lito::menu.create.get')}}" class="btn-outline text-uppercase component-table-bar-button">Thêm mới</a>
                @endif


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

            @include('lito-dashboard::components.alert')

            <div class="component-table-content">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Tên loại menu</th>
                        <th width="150">Thuộc tính</th>
                        <th width="150">Ngày khởi tạo</th>
                        <th width="150"><b>Thao tác</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data as $d)
                        <tr>
                            <td>{{$d->name}}</td>
                            <td width="150">{{$d->position}}</td>
                            <td width="150">{{datetoformat($d->created_at)}}</td>
                            <td width="150" class="action">
                                <a href="{{route('lito::node.create.get',['menu_id'=>$d->id])}}" title="Xem danh sách menu"><i class="fa fa-cogs" aria-hidden="true"></i></a>
                                <a href="{{route('lito::menu.edit.get',$d->id)}}" title="Sửa menu"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                {{--<a href="javascript:;" class="delete-record" data-href="{{route('lito::menu.delete.get',$d->id)}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>--}}
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
