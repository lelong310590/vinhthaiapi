@extends('lito-dashboard::master')

@section('title', 'Danh sách nhóm FAQs')

@section('content')

    @php
        $user = Auth::user();
        $roles = $user->load('roles.perms');
        $permissions = $roles->roles->first()->perms;
    @endphp

    <div class="component">
        <h4 class="component-title">Danh sách nhóm FAQs</h4>
        <div class="component-table">
            <div class="component-table-bar">
                @if ($permissions->contains('name','faqs_create'))
                    <a href="{{route('lito::faqs.create.get')}}" class="btn-outline text-uppercase component-table-bar-button">Thêm mới</a>
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
                        <th>Tên nhóm FAQs</th>
                        <th width="100">Thứ tự</th>
                        <th width="200">Trạng thái</th>
                        <th width="200">Ngày khởi tạo</th>
                        <th width="150"><b>Thao tác</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data as $d)
                        <tr>
                            <td>{{$d->name}}</td>
                            <td width="100">{{$d->sort}}</td>
                            <td width="200">{!! conver_status($d->status, route('lito::faqs.status.get', ['status' => $d->status, 'id' => $d->id])) !!}</td>
                            <td width="200">{!! $d->created_at !!}</td>
                            <td class="action" width="150">
                                <a href="{{route('lito::faqs.edit.get',['id'=>$d->id,'type'=>$d->faqs_type])}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                <a href="javascript:;" class="delete-record" data-href="{{route('lito::faqs.delete.get',$d->id)}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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