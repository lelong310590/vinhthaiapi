@php
    $listRoute = [
        'lito::media.index.get'
    ];

@endphp
@if ($pers->contains('name','media_index'))
<li class="has-child {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('lito::media.index.get')}}">
        <i class="fa fa-picture-o" aria-hidden="true"></i>
        Đa phương tiện
    </a>
</li>
@endif