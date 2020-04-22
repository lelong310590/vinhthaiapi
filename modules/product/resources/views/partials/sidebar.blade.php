@php
    $listRoute = [
        'lito::product.index.get','lito::product.create.get', 'lito::product.edit.get','lito::category.index.get',
        'lito::category.edit.get','lito::category.create.get'
    ];

@endphp

<li class="has-child {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-qrcode" aria-hidden="true"></i>
        Sản phẩm
    </a>
    <i class="fa fa-caret-down has-child-arrow" aria-hidden="true"></i>
    <ul class="child-menu">
        <li><a href="{{route('lito::product.index.get')}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Danh sách sản phẩm</a></li>
        <li><a href="{{route('lito::product.create.get')}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Thêm
                mới</a></li>
        <li><a href="{{route('lito::category.index.get')}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Danh mục sản phẩm</a></li>

    </ul>
</li>
