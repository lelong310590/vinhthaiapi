@extends('lito-dashboard::master')

@section('title', 'Danh sách Ticket')

@section('content')

    @php
        $user = Auth::user();
        $roles = $user->load('roles.perms');
        $permissions = $roles->roles->first()->perms;
    @endphp

    <div class="component">
        <h4 class="component-title">Danh sách Ticket</h4>
        <div class="component-table">
            <div class="component-table-bar">
                @if ($permissions->contains('name','ticket_create'))
                    <a href="{{route('lito::ticket.create.get',['type'=>'admin'])}}" class="btn-outline text-uppercase component-table-bar-button">Thêm mới</a>
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
                        <th>Phòng ban</th>
                        <th>Mã Ticket</th>
                        <th>Tiêu đề</th>
                        <th>Trạng thái</th>
                        <th>Lần cuối</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if (isset($response->data))
                        @forelse($response->data as $d)
                            <tr>
                                <td>
                                    @if($d->support_name=='it') <span>Phòng kỹ thuật</span> @endif
                                    @if($d->support_name=='sale') <span>Phòng kinh doanh</span> @endif
                                    @if($d->support_name=='accountant') <span>Phòng kế toán</span> @endif
                                    @if($d->support_name=='cskh') <span>Chăm sóc khách hàng</span> @endif
                                </td>
                                <td><a href="{{route('lito::ticket.view.get',['id'=>$d->id,'type'=>'admin'])}}">#TIC{{$d->id}}</a></td>
                                <td>{{$d->title}}</td>
                                <td>
                                    @if($d->status=='read')
                                        <span class="status-read"><i class="fa fa-commenting-o"></i> Đang xử lý</span>
                                    @endif
                                    @if($d->status=='unread')
                                        <span class="status-unread"><i class="fa fa-coffee"></i> Đang chờ...</span>
                                    @endif
                                    @if($d->status=='resolve')
                                        <span class="status-resolve"><i class="fa fa-check-circle"></i> Đã hoàn thành</span>
                                    @endif
                                </td>
                                <td>{{datetoformat_full($d->updated_at)}}</td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    Chưa có bản ghi nào !
                                </td>
                            </tr>
                        @endforelse
                    @else
                        <tr>
                            <td colspan="5">
                                Chưa có bản ghi nào !
                            </td>
                        </tr>
                    @endif

                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="100%" class="table-footer">
                            {{--<div class="table-count">{{$response->total()}} bản ghi</div>--}}

                            {{--{{$response->links('lito-dashboard::components.pagination')}}--}}

                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>

@endsection
