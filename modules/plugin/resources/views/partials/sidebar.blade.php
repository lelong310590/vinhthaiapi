@php
    $listRoute = [
        'lito::plugin.index.get'
    ];
@endphp
@if ($pers->contains('name','plugin_index'))
<li class="{{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('lito::plugin.index.get')}}">
        <i class="fa fa-plug" aria-hidden="true"></i>
        Modules
    </a>
</li>
@endif