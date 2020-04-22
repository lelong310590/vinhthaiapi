@php
    $listRoute = [
        'lito::history.index.get'
    ];

@endphp
@if ($pers->contains('name','history_index'))
<li class="{{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('lito::history.index.get')}}">
        <i class="fa fa-history" aria-hidden="true"></i>
        Lịch sử
    </a>

</li>
@endif