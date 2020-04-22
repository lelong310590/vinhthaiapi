@php
    $listRoute = [
        'lito::ticket.index.get', 'lito::ticket.create.get', 'lito::ticket.edit.get'
    ];
@endphp
@if ($pers->contains('name','ticket_index'))
<li class="has-child {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('lito::ticket.index.get',['type'=>'admin'])}}">
        <i class="fa fa-ticket" aria-hidden="true"></i>
        Gửi ticket hỗ trợ
    </a>
    <i class="fa fa-caret-down has-child-arrow" aria-hidden="true"></i>
    <ul class="child-menu">
        <li><a href="{{route('lito::ticket.index.get',['type'=>'admin'])}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Danh sách Ticket</a></li>
        <li><a href="{{route('lito::ticket.create.get',['type'=>'admin'])}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Thêm mới</a></li>
    </ul>
</li>
@endif