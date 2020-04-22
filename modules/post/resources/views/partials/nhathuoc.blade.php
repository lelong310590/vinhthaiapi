@php
    $listRoute = [
       'lito::post.index.get', 'lito::post.create.get', 'lito::post.edit.get'
    ];
@endphp

<li class="has-child {{(in_array(Route::currentRouteName(), $listRoute) && Request::get('post_type') == 'nhathuoc') ?
'active' : '' }}">
    <a href="{{route('lito::post.index.get',['post_type' => 'nhathuoc'])}}">
        <i class="fa fa-newspaper-o" aria-hidden="true"></i>
        Quản lý nhà thuốc
    </a>

    <i class="fa fa-caret-down has-child-arrow" aria-hidden="true"></i>

    <ul class="child-menu">
        <li><a href="{{route('lito::post.index.get',['post_type' => 'nhathuoc'])}}">
                <i class="fa fa-caret-right" aria-hidden="true"></i> Danh sách nhà thuốc</a></li>
        <li><a href="{{route('lito::post.create.get', ['post_type' => 'nhathuoc'])}}">
                <i class="fa fa-caret-right" aria-hidden="true"></i> Thêm mới</a></li>
        <li><a href="{{route('lito::taxonomy.index.get', ['type' => 'nhathuoc'])}}">
                <i class="fa fa-caret-right" aria-hidden="true"></i> Khu vực</a></li>
    </ul>
</li>
