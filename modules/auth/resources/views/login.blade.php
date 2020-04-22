<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Đăng nhập | Lito</title>

	<!-- Load CSS -->
	<meta name="robots" content="noindex">
	<meta name="googlebot" content="noindex">
	<link rel="stylesheet" href="{{asset('ui/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('ui/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('ui/css/style.min.css')}}">
	<link rel="icon" href="{{ asset('favicon.jpg') }}">

</head>

<body>

<div class="module-sign-in">
	<div class="sign-in-wrapper">
		<div class="sign-in-form">
			<img src="{{asset('ui/images/logo.png')}}" alt="" class="img-responsive">

			<form action="{{ route('lito::auth.login.post') }}" method="post" role="form">

				{{csrf_field()}}

				<legend class="text-uppercase">Đăng nhập</legend>

				@include('lito-dashboard::components.alert')
				@if(Session::has('message'))
					<div class="alert alert-success">
						<strong>{{Session::get('message')}}</strong>
					</div>
				@endif
				<div class="form-group">
					<label for="username">Tên đăng nhập</label>
					<input type="text" class="form-control" required name="username" id="username" placeholder="Nhập tên tài khoản">
				</div>

				<div class="form-group">
					<label for="password">Mật khẩu</label>
					<input type="password" class="form-control" required id="password" name="password" placeholder="Nhập mật khẩu">
				</div>


				<button type="submit" class="btn btn-default">Đăng nhập</button>
			</form>

			<a href="{{route('lito::auth.forget.get')}}" class="sign-in-forget-password pull-right">Quên mật khẩu ?</a>

		</div>

		<div class="sign-in-image hidden-xs hidden-sm"></div>
	</div>
</div>

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="{{asset('ui/js/bootstrap.min.js')}}"></script>

</body>
</html>