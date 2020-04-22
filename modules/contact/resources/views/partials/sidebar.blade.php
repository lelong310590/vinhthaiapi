@php
    $listRoute = [
        'lito::contact.index.get', 'lito::contactgroup.index.get', 'lito::contactgroup.create.get',
        'lito::contactgroup.edit.get'
    ];

@endphp
@if ($pers->contains('name','contact_view'))
<li class="has-child {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('lito::contactgroup.index.get')}}">
        <i class="fa fa-address-card" aria-hidden="true"></i>
        Liên hệ
    </a>
</li>
@endif