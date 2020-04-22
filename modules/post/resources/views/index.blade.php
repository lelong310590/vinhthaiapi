@php
    $title = 'bài viết';

    if (Request::get('post_type') == 'page') {
        $title = 'trang tĩnh';
    }
@endphp

@extends('lito-dashboard::master')

@section('title', 'Danh sách '.$title)

@section('css')
    <link rel="stylesheet" href="{{asset('ui/css/star-rating.css')}}">
@endsection
@section('js')
    <script type="text/javascript" src="{{asset('ui/js/star-rating.js')}}"></script>
@endsection
@section('js-init')
    <script type="text/javascript">
        $("#input-id").rating();
    </script>
@endsection

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
                @if ($permissions->contains('name','post_create'))
                    <a href="{{route('lito::post.create.get',['post_type'=>$post_type])}}" class="btn-outline text-uppercase component-table-bar-button">Thêm mới</a>
                @endif


                <div class="component-table-filter">
                    <div class="component-table-search">
                        <form method="get" role="form">
                            <input type="hidden" name="post_type" value="post" />
                            <div class="form-group">
                                <select name="taxonomy" class="form-control" id="select2">
                                    <option value="">Danh mục</option>
                                </select>
                            </div>
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
                        <th width="120">Hình ảnh</th>
                        <th>Tiêu đề</th>
                        {{--<th>Rating</th>--}}
                        <th width="150">Ngày tạo</th>
                        <th width="150">Trạng thái</th>
                        <th width="150"><b>Thao tác</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($data as $d)
                        <tr>
                            <td width="120"><img width="80" src="{{get_thumbnail($d->thumbnail)}}"></td>
                            <td>{{$d->post_title}}
                                @if($d->display=='hot')
                                <span class="dpl-nb">Nổi bật</span>
                                @endif
                                @if($d->display=='home')
                                    <span class="dpl-tt">Trang chủ</span>
                                @endif
                            </td>

                            {{--<td>--}}
                                {{--<input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $d->averageRating }}" data-size="xs" disabled="">--}}
                            {{--</td>--}}
                            <td width="150">{{datetoformat($d->created_at)}}</td>
                            <td width="150">{!! getStatusPost($d->post_status,route('lito::post.status.get', ['post_status' => $d->post_status, 'id' => $d->id])) !!}</td>
                            <td width="150" class="action">

                                <a href="{{route('lito::post.edit.get',['id'=>$d->id,'post_type'=>$post_type])}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                <a href="javascript:;" class="delete-record" data-href="{{route('lito::post.delete.get',$d->id)}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
