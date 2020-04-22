@php
    $listRoute = [
        'lito::testimonial.index.get', 'lito::testimonial.create.get', 'lito::testimonial.edit.get'
    ];
@endphp
@if ($pers->contains('name','testimonial_index'))
<li class="has-child {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('lito::testimonial.index.get')}}">
        <i class="fa fa-universal-access" aria-hidden="true"></i>
        Review học viên
    </a>
    <i class="fa fa-caret-down has-child-arrow" aria-hidden="true"></i>
    <ul class="child-menu">
        <li><a href="{{route('lito::testimonial.index.get')}}"><i class="fa fa-caret-right" aria-hidden="true"></i>
                Danh sách review</a></li>
        <li><a href="{{route('lito::testimonial.create.get')}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Thêm mới</a></li>
    </ul>
</li>
@endif