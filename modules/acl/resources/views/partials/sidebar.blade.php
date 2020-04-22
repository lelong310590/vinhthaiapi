@php
	$currentUser = Auth::user();
	$currentRole = $currentUser->roles()->first();
	$perms = $currentRole->perms()->select('name')->get();
	$permsArray = [];
	foreach ($perms as $p) {
		$permsArray[] = $p['name'];
	}

	$listRoute = [
		'lito::role.index.get', 'lito::role.create.get', 'lito::role.edit.get', 'lito::permission.index.get'
	];

@endphp

@if (in_array('role_index', $permsArray) && in_array('role_create', $permsArray) && in_array('permission_index', $permsArray))
@inject('permRepository', 'Acl\Repositories\PermissionRepository')
@inject('roleRepository', 'Acl\Repositories\RoleRepository')


<li class="has-child {{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
	<a href="{{ route('lito::role.index.get') }}">
		<i class="fa fa-shield" aria-hidden="true"></i>
		Vai trò & Phân quyền
	</a>
	<i class="fa fa-caret-down has-child-arrow" aria-hidden="true"></i>
	<ul class="child-menu">
		@if (in_array('role_index', $permsArray) && in_array('role_create', $permsArray))
			<li><a href="{{ route('lito::role.index.get') }}"><i class="fa fa-caret-right" aria-hidden="true"></i> Danh sách vai trò</a></li>
			<li><a href="{{ route('lito::role.create.get') }}"><i class="fa fa-caret-right" aria-hidden="true"></i> Tạo vai trò</a></li>
		@endif

		@if (in_array('permission_index', $permsArray))
			<li><a href="{{route('lito::permission.index.get')}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Danh sách quyền</a></li>
		@endif
	</ul>
</li>

@endif

