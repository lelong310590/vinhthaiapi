<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Quên mật khẩu</title>

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

            <form action="{{ route('lito::auth.forget.post') }}" method="post" role="form">

                {{csrf_field()}}

                <legend class="text-uppercase">Quên mật khẩu</legend>

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Lỗi !</strong>
                        @foreach ($errors->all() as $e)
                            <div>{{$e}}</div>
                        @endforeach
                    </div>
                @endif
                @if(Session::has('message'))
                    <div class="alert alert-danger">
                        <strong>{{Session::get('message')}}</strong>
                    </div>
                @endif
                <div class="form-group">
                    <label for="email">Địa chỉ email</label>
                    <input type="text" class="form-control" required name="email" placeholder="Nhập email của bạn">
                </div>

                <button type="submit" class="btn btn-default">Lấy lại mật khẩu</button>

                <a href="{{route('lito::auth.login.get')}}" class="sign-in-forget-password pull-right">Quay lại trang đăng nhập</a>
            </form>

        </div>

        <div class="sign-in-image hidden-xs hidden-sm"></div>
    </div>
</div>

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="{{asset('ui/js/bootstrap.min.js')}}"></script>

</body>
</html>