@php
	$listRoute = [
		'lito::dashboard.index.get'
	];

	    $user = Auth::user();
        $roles = $user->load('roles.perms');
        $permissions_sidebar = $roles->roles->first()->perms;
		View::share('pers', $permissions_sidebar); // <= Truyền dữ liệu
@endphp

<div class="sidebar">
	<ul class="main-menu" id="sidebar">
		<li class="{{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">
			<a href="{{route('lito::dashboard.index.get')}}">
				<i class="fa fa-tachometer" aria-hidden="true"></i>
				Bảng điều khiển
			</a>
		</li>

		@php do_action('lito-register-menu') @endphp
	</ul>

	{{--<nav id="sidebar">--}}

		{{--<ul class="list-unstyled components">--}}
			{{--<li class="{{in_array(Route::currentRouteName(), $listRoute) ? 'active' : '' }}">--}}
				{{--<a href="{{route('lito::dashboard.index.get')}}">--}}
					{{--<i class="fa fa-tachometer" aria-hidden="true"></i>--}}
					{{--Bảng điều khiển--}}
				{{--</a>--}}
			{{--</li>--}}
			{{--@php do_action('lito-register-menu') @endphp--}}

		{{--</ul>--}}

	{{--</nav>--}}

</div>