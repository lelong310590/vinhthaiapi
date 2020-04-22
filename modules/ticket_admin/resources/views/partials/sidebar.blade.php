@php
    $listRoute = [
        'lito::ticket_admin.index.get', 'lito::ticket_admin.create.get', 'lito::ticket_admin.edit.get'
    ];
@endphp
@if(Auth::id()==1)
<li class="has-child {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('lito::ticket_admin.index.get')}}">
        <i class="fa fa-ticket" aria-hidden="true"></i>
        Quản lý Ticket
    </a>
    <i class="fa fa-caret-down has-child-arrow" aria-hidden="true"></i>
    <ul class="child-menu">
        <li><a href="{{route('lito::ticket_admin.index.get')}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Tất cả Ticket</a></li>
        <li><a href="{{route('lito::ticket_admin.index.get',['status'=>'read'])}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Đang xử lý  <span class="count-num">{{$readnum}}</span> </a></li>
        <li><a href="{{route('lito::ticket_admin.index.get',['status'=>'unread'])}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Đang đợi <span class="count-num"> {{$unreadnum}} </span></a></li>
        <li><a href="{{route('lito::ticket_admin.index.get',['status'=>'resolve'])}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Đã hoàn thành <span class="count-num"> {{$resolvenum}} </span></a></li>
    </ul>
</li>
@endif
