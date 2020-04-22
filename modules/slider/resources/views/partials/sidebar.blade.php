@php
    $listRoute = [
    'lito::slider.index.get', 'lito::slider.create.get', 'lito::slider.edit.get','lito::group.list.get'
    ];
@endphp
@if ($pers->contains('name','slider_index'))
<li class="has-child {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('lito::group.list.get')}}">
        <i class="fa fa-file-image-o" aria-hidden="true"></i>
        Slider
    </a>
</li>
@endif