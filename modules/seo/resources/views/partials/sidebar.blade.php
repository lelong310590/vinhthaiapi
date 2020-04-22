@php
    $listRoute = [
        'lito::seo.index.get'
    ];

@endphp

<li class="has-child {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('lito::seo.index.get')}}">
        <i class="fa fa-google" aria-hidden="true"></i>
        Thông tin SEO
    </a>
</li>
