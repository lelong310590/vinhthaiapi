@php
	$listRoute = [
		'lito::users.setting.get', 'lito::users.index.get', 'lito::users.create.get', 'lito::users.edit.get',
	];
@endphp
@if ($pers->contains('name','user_index'))
<li class="has-child {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
	<a href="{{route('lito::users.index.get')}}">
		<i class="fa fa-users" aria-hidden="true"></i>
		Tài khoản
	</a>
	<i class="fa fa-caret-down has-child-arrow" aria-hidden="true"></i>
	<ul class="child-menu">
		<li><a href="{{route('lito::users.index.get')}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Danh sách tài khoản</a></li>
		<li><a href="{{route('lito::users.create.get')}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Tao tài khoản</a></li>
	</ul>
</li>
@endif