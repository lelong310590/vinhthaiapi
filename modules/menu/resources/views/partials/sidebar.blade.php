@php
    $listRoute = [
        'lito::menu.index.get', 'lito::menu.create.get', 'lito::menu.edit.get',
        'lito::node.index.get', 'lito::node.create.get', 'lito::node.edit.get'
    ];
@endphp
@if ($pers->contains('name','menu_index'))
<li class="{{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('lito::menu.index.get')}}">
        <i class="fa fa-bars" aria-hidden="true"></i>
        Quản lý menu
    </a>
</li>
@endif