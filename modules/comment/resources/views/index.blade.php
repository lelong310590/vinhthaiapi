@extends('lito-dashboard::master')

@section('title', 'Danh sách comment')

@section('content')

    @php
        $user = Auth::user();
        $roles = $user->load('roles.perms');
        $permissions = $roles->roles->first()->perms;
    @endphp

    <div class="component">
        <h4 class="component-title">Danh sách comment</h4>
        <div class="component-table">
            <div class="component-table-bar">

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
                        <th width="300">Người dùng</th>
                        <th>Comment</th>
                        <th>Bài viết</th>
                        <th width="150">Trạng thái</th>
                        <th width="150"><b>Thao tác</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data as $d)
                        <tr>
                            <td width="300">
                                <div class="c-left">
                                <img src="{{$d->thumbnail}}" width="50" height="50">
                                </div>
                                <div class="c-right">
                                <span class="cname">{{$d->name}}</span>
                                <span class="cemail">{{$d->email}}</span>
                                </div>
                            </td>
                            <td>{!! $d->comment_content !!}</td>
                            <td><a href="#">{{!empty($d->postInfo) ? $d->postInfo->post_title : ''}}</a></td>
                            <td width="150">
                                {!! comment_status($d->approved,route('lito::comment.status.get',['approved'=>$d->approved,'id'=>$d->id])) !!}
                            </td>
                            <td width="150" class="action">
                                 <a href="{{route('lito::comment.edit.get',['id'=>$d->id])}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                <a href="javascript:;" class="delete-record" data-href="{{route('lito::comment.delete.get',$d->id)}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
