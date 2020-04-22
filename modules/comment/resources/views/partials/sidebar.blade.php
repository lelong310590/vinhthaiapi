@php
    $listRoute = [
        'lito::comment.index.get','lito::comment.create.get','lito::comment.edit.get'
    ];

@endphp
@if ($pers->contains('name','comment_index'))
<li class="has-child {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('lito::comment.index.get')}}">
        <i class="fa fa-comments-o" aria-hidden="true"></i>
        Bình luận <span class="count-num">{{$comment_num}}</span>
    </a>
</li>
@endif