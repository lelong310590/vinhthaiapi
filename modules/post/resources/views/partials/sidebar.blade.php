@php
    $listRoute = [
        'lito::taxonomy.index.get', 'lito::post.index.get', 'lito::taxonomy.create.get',
        'lito::post.create.get', 'lito::post.edit.get', 'lito::taxonomy.edit.get'
    ];
@endphp
@if ($pers->contains('name','post_index'))
<li class="has-child {{(in_array(Route::currentRouteName(), $listRoute) && Request::get('post_type') != 'page'&&Request::get('post_type') != 'video') ? 'active' : '' }}">
    <a href="{{route('lito::post.index.get',['post_type' => 'post'])}}">
        <i class="fa fa-newspaper-o" aria-hidden="true"></i>
        Bài viết
    </a>

    <i class="fa fa-caret-down has-child-arrow" aria-hidden="true"></i>

    <ul class="child-menu">
        <li><a href="{{route('lito::post.index.get',['post_type' => 'post'])}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Danh sách bài viết</a></li>
        <li><a href="{{route('lito::post.create.get', ['post_type' => 'post'])}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Thêm mới</a></li>
        @php do_action('lito-register-post-submenu') @endphp
    </ul>
</li>



@endif