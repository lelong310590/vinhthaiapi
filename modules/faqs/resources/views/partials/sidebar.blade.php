@php
    $listRoute = [
        'lito::faqs.list.get',
        'lito::faqs.index.get', 'lito::faqs.create.get', 'lito::faqs.edit.get',
        'lito::faqsitem.index.get', 'lito::faqsitem.create.get', 'lito::faqsitem.edit.get'
    ];

@endphp
@if ($pers->contains('name','faqs_index'))
<li class="has-child {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
    <a href="{{route('lito::faqs.index.get')}}">
        <i class="fa fa-bullhorn" aria-hidden="true"></i>
        FAQs
    </a>
    <i class="fa fa-caret-down has-child-arrow" aria-hidden="true"></i>
    <ul class="child-menu">
        <li><a href="{{route('lito::faqs.index.get')}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Nhóm FAQs</a></li>
        <li><a href="{{route('lito::faqsitem.index.get')}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Danh sách FAQs</a></li>
        <li><a href="{{route('lito::faqsitem.create.get')}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Thêm mới</a></li>
    </ul>
</li>
@endif