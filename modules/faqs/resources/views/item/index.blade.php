@extends('lito-dashboard::master')

@section('title', 'Danh sách FAQs')

@section('content')

    @php
        $user = Auth::user();
        $roles = $user->load('roles.perms');
        $permissions = $roles->roles->first()->perms;
    @endphp

    <div class="component">
        <h4 class="component-title">Danh sách FAQs</h4>
        <div class="component-table">
            <div class="component-table-bar">
                <a href="{{route('lito::faqsitem.create.get')}}" class="btn-outline text-uppercase component-table-bar-button">Thêm mới</a>

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
                            <th>Câu hỏi</th>
                            {{--<th>Câu trả lời</th>--}}
                            <th>Nhóm FAQs</th>
                            <th width="100">Thứ tự</th>
                            <th width="200">Trạng thái</th>
                            <th width="200">Ngày khởi tạo</th>
                            <th width="150"><b>Thao tác</b></th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($data as $d)
                        <tr>
                            <td>{{ $d->question }}</td>
{{--                            <td>{!! str_limit($d->answer, 200, '..') !!}</td>--}}
                            <td>{{ empty($d->getFaqs) ? '' : $d->getFaqs->name }}</td>
                            <td width="100">{{$d->sort}}</td>
                            <td width="200">{!! conver_status($d->status, route('lito::faqsitem.status.get', ['status' => $d->status, 'id' => $d->id])) !!}</td>
                            <td width="200">{!! $d->created_at !!}</td>
                            <td class="action" width="150">
                                <a href="{{route('lito::faqsitem.edit.get',['id'=>$d->id])}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                <a href="javascript:;" class="delete-record" data-href="{{route('lito::faqsitem.delete.get',$d->id)}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
