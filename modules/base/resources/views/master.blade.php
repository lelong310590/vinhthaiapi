<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="csrf-token" content="{{csrf_token()}}">

	<meta name="robots" content="noindex">
	<meta name="googlebot" content="noindex">

	<title>@yield('title') | LITO CMS</title>
	<link rel="icon" href="{{ asset('favicon.jpg') }}">

	<!-- Load CSS -->
	<link rel="stylesheet" href="{{asset('ui/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('ui/css/bootstrap-datepicker.min.css')}}">
	<link rel="stylesheet" href="{{asset('ui/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('ui/css/style.min.css')}}">
	<link rel="stylesheet" href="{{asset('ui/css/fix.css')}}">
	<link rel="stylesheet" href="{{asset('ui/css/sidebar.css')}}">
	<link rel="stylesheet" href="{{asset('ui/vendor/perfect-scrollbar-master/css/perfect-scrollbar.css')}}">


	@yield('css')
	@stack('css')

</head>

<body>

@include('lito-dashboard::partials.header')

<div class="main" id="main">

	@include('lito-dashboard::partials.sidebar')

	<div class="main-wrapper">
		@yield('content')
	</div>
</div>

<!-- jQuery first, then Tether, then Bootstrap JS. -->
@stack('js-react')

<script type="text/javascript" src="{{asset('ui/vendor/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('ui/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('ui/js/bootstrap-datepicker.min.js')}}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@yield('js')
@yield('js-init')
@stack('js')
@stack('js-init')

<script type="text/javascript" src="{{asset('ui/vendor/parsleyjs/parsley.min.js')}}"></script>
<script type="text/javascript" src="{{asset('ui/vendor/parsleyjs/parsley-init.js')}}"></script>
<script type="text/javascript" src="{{asset('ui/vendor/perfect-scrollbar-master/dist/perfect-scrollbar.min.js')}}"></script>

<script type="text/javascript" src="{{asset('ui/js/script.min.js')}}"></script>
<script type="text/javascript" src="{{asset('ui/js/alladmin.js')}}"></script>

<script>
    $('#datepicker').datepicker({
        format: 'dd/mm/yyyy',
        startDate: '-30d',
        autoclose: true
    });
    $('#datepicker2').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    });
    const ps = new PerfectScrollbar('#sidebar', {
        wheelSpeed: 2,
        wheelPropagation: true,
        minScrollbarLength: 20
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>

</body>
</html>
