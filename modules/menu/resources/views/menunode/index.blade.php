@extends('lito-dashboard::master')

@section('title', 'Danh sách menu')

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
                    <a href="{{route('lito::node.create.get',['menu_id'=>$menu_id])}}" class="btn-outline text-uppercase component-table-bar-button">Thêm mới</a>
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
                        <th>Tiêu đề menu</th>
                        <th width="100">Thứ tự</th>
                        <th width="150">Trạng thái</th>
                        <th width="150"><b>Thao tác</b></th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($data as $d)
                        @if(!empty($d['sub']))
                        <tr style="font-weight: bold">
                            <td>{{$d['name']}}</td>
                            <td width="80">{{$d['index']}}</td>
                            <td width="150">{!! conver_status($d['status'], route('lito::node.status.get', ['status' =>$d['status'], 'id' => $d['id']])) !!}</td>
                            <td width="150" class="action">

                                <a href="{{route('lito::node.edit.get',['id'=>$d['id'],'menu_id'=>$d['menu_id']])}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                <a href="javascript:;" class="delete-record" data-href="{{route('lito::node.delete.get',$d['id'])}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                            @foreach($d['sub'] as $sub)
                                <tr style="padding-left: 10px">
                                    <td>--- {{$sub['name']}}</td>
                                    <td width="80">{{$sub['index']}}</td>
                                    <td width="150">{!! conver_status($sub['status'], route('lito::node.status.get', ['status' => $sub['status'], 'id' => $sub['id']])) !!}</td>
                                    <td width="150" class="action">

                                        <a href="{{route('lito::node.edit.get',['id'=>$sub['id'],'menu_id'=>$sub['menu_id']])}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                        <a href="javascript:;" class="delete-record" data-href="{{route('lito::node.delete.get',$sub['id'])}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr style="font-weight: bold">
                                <td>{{$d['name']}}</td>
                                <td width="80">{{$d['index']}}</td>
                                <td width="150">{!! conver_status($d['status'], route('lito::node.status.get', ['status' =>$d['status'], 'id' => $d['id']])) !!}</td>
                                <td width="150" class="action">

                                    <a href="{{route('lito::node.edit.get',['id'=>$d['id'],'menu_id'=>$d['menu_id']])}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                    <a href="javascript:;" class="delete-record" data-href="{{route('lito::node.delete.get',$d['id'])}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                         @endif
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
                            <div class="table-count"> bản ghi</div>



                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>

@endsection
