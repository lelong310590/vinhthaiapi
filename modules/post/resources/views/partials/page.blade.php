@php
    $listRoute = [
       'lito::post.index.get', 'lito::post.create.get', 'lito::post.edit.get'
    ];
@endphp

<li class="has-child {{(in_array(Route::currentRouteName(), $listRoute) && Request::get('post_type') == 'page') ? 'active' : '' }}">
    <a href="{{route('lito::post.index.get',['post_type'=>'page'])}}">
        <i class="fa fa-file-text-o" aria-hidden="true"></i>
        Trang tĩnh
    </a>
</li>
<li class="has-child {{(in_array(Route::currentRouteName(), $listRoute) && Request::get('post_type') == 'video') ? 'active' : '' }}">
    <a href="{{route('lito::post.index.get',['post_type'=>'video'])}}">
        <i class="fa fa-video-camera" aria-hidden="true"></i>
        Video
    </a>
</li>