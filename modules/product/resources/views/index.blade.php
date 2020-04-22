@php
    $title = 'Sản phẩm';
@endphp

@extends('lito-dashboard::master')

@section('title', 'Danh sách '.$title)

@section('content')

    @php
        $user = Auth::user();
        $roles = $user->load('roles.perms');
        $permissions = $roles->roles->first()->perms;
    @endphp

    <div class="component">
        <h4 class="component-title">Danh sách {{$title}}</h4>
        <div class="component-table">
            <div class="component-table-bar">
                @if ($permissions->contains('name','product_create'))
                    <a href="{{route('lito::product.create.get')}}" class="btn-outline text-uppercase
                    component-table-bar-button">Thêm mới</a>
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
                        <th>Tên {{$title}}</th>
                        <th width="100">Hình ảnh</th>
                        <th width="200">Học viên</th>
                        <th width="150">Ngày tạo</th>
                        <th width="150">Trạng thái</th>
                        <th width="150"><b>Thao tác</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data as $d)
                        <tr>
                            <td>{{$d->name}}</td>
                            <td width="80"><img width="70" src="{{get_thumbnail($d->thumbnail)}}"></td>
                            <td width="200">{{$d->product_code}}</td>
                            <td width="150">{{datetoformat($d->cretead_at)}}</td>
                            <td width="150">
                                @if($d->status=='active')
                                    <span style="color: #0E9A00">Đang hiển thị</span>
                                @endif
                                @if($d->status=='disable')
                                        <span style="color: #9d0006">Tạm ẩn</span>
                                @endif
                                    @if($d->status=='new')
                                        <span style="color: #0e90d2">Sản phẩm mới</span>
                                    @endif
                            </td>
                            <td width="150" class="action">
                                <a href="{{route('lito::product.edit.get',['id'=>$d->id])
                                }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                <a href="javascript:;" class="delete-record" data-href="{{route('lito::product.delete.get',$d->id)}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
