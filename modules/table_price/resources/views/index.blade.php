@extends('lito-dashboard::master')

@section('title', 'Danh sách bảng giá')

@section('content')

    @php
        $user = Auth::user();
        $roles = $user->load('roles.perms');
        $permissions = $roles->roles->first()->perms;
    @endphp

    <div class="component">
        <h4 class="component-title">Danh sách bảng giá</h4>
        <div class="component-table">
            <div class="component-table-bar">
                <a href="{{route('lito::tableprice.create.get')}}" class="btn-outline text-uppercase component-table-bar-button">Tạo gói giá</a>

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
                            <th>Tên gói</th>
                            <th>Thứ tự</th>
                            <th>Nhóm</th>
                            <th>Giá bán</th>
                            <th width="200">Gói chính</th>
                            <th width="200">Trạng thái</th>
                            <th width="200">Ngày khởi tạo</th>
                            <th width="150"><b>Thao tác</b></th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($data as $p)
                        <tr>
                            <td>{{$p->name}}</td>
                            <td>{{$p->index}}</td>
                            <td>{{!empty($p->getGroup) ? $p->getGroup->name : ''}}</td>
                            <td>{{$p->price}} {{$p->price_type}}</td>
                            <td width="200" class="text-center">
                                <a href="{{route('lito::tableprice.main.get', ['main' => ($p->main == 1) ? 0 : 1, 'id' => $p->id])}}" style="color: yellow; font-size: 21px">
                                    @if ($p->main == 1)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @endif
                                </a>
                            </td>
                            <td width="200">{!! conver_status($p->status, route('lito::tableprice.status.get', ['status' => $p->status, 'id' => $p->id])) !!}</td>
                            <td width="200">{{$p->created_at}}</td>
                            <td class="action" width="150">
                                <a href="{{route('lito::tableprice.edit.get', $p->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a href="javascript:;" class="delete-record" data-href="{{route('lito::tableprice.delete.get', $p->id)}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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