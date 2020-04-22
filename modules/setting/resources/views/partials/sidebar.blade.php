@php
    $listRoute = [
        'lito::setting.index.get'
    ];

@endphp
@if ($pers->contains('name','setting_index'))
<li class="has-child {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('lito:setting.index.get')}}">
        <i class="fa fa-cogs" aria-hidden="true"></i>
        Cấu hình
    </a>
    <ul class="child-menu">
        @php do_action('lito-register-setting-menu') @endphp
    </ul>
</li>
@endif