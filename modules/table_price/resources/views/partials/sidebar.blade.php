@php
    $listRoute = [
        'lito::tableprice.index.get', 'lito::tableprice.create.get', 'lito::tableprice.edit.get',
        'lito::tablepricegroup.index.get', 'lito::tablepricegroup.create.get', 'lito::tablepricegroup.edit.get'
    ];
@endphp
@if ($pers->contains('name','table_price_group_index'))
<li class="has-child {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('lito::tableprice.index.get')}}">
        <i class="fa fa-list-alt" aria-hidden="true"></i>
        Bảng giá
    </a>
    <i class="fa fa-caret-down has-child-arrow" aria-hidden="true"></i>
    <ul class="child-menu">
        <li><a href="{{route('lito::tableprice.index.get')}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Danh sách bảng giá</a></li>
        <li><a href="{{route('lito::tableprice.create.get')}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Thêm mới</a></li>
        <li><a href="{{route('lito::tablepricegroup.index.get')}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Nhóm bảng giá</a></li>
    </ul>
</li>
@endif