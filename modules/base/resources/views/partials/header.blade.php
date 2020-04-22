<div class="header" id="header">
	<div class="logo">
		<a href="{{route('lito::dashboard.index.get')}}" class="home-link"><img src="{{asset('ui/images/logo-light.png')}}" alt="" class="img-responsive"></a>
		<h1 class="logo-title"></h1>
		<div class="quick-menu">
			<a href="javascript:;">
				<i class="fa fa-plus" aria-hidden="true"></i> Thêm nhanh
			</a>
			<div class="quick-menu-wrapper">
				<ul>
					@php do_action('lito-quick-create-menu') @endphp
				</ul>
			</div>
		</div>

		<div class="header-nav">
			@php do_action('lito-register-header-nav') @endphp
		</div>

	</div>

	<div class="notification-bar">
		@inject('ticket', 'Ticket\Repositories\TicketRepository')
		<div class="dropdown">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Thông báo
				<i class="fa fa-bell-o" aria-hidden="true"></i></button>
			<span class="badge">{{$ticket->TicketNotification()->count()}}</span>
			<ul class="dropdown-menu noti">
				@php do_action('lito-register-header-notification') @endphp
			</ul>
		</div>

		<div href="javascript:;" id="user-panel">
			<div class="user">
				@if (Auth::user()->thumbnail != null)
					<img src="{{asset(Auth::user()->thumbnail)}}" alt="" class="img-responsive">
				@else
					<img src="{{asset('ui/images/avatar.jpeg')}}" alt="" class="img-responsive">
				@endif

			</div>
			<div class="user-panel-menu hidden">
				<p><i class="fa fa-user-o" aria-hidden="true"></i> {{Auth::user()->username}}</p>
				<ul>
					<li><a href="{{route('lito::users.edit.get', Auth::id())}}">Quản trị tài khoản</a></li>
					<li><a href="{{route('lito::auth.logout.get')}}">Đăng xuất</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>

@push('js')
	@if (\Session::has('cache'))
		@if (\Session::get('cache'))
			<script type="text/javascript">
                swal("Thành công!", "Xóa Cache thành công!", "success");
			</script>
		@endif

		@if (!\Session::get('cache'))
			<script type="text/javascript">
                swal("Lỗi!", "Không thể xóa Cache!", "error");
			</script>
		@endif
	@endif
@endpush