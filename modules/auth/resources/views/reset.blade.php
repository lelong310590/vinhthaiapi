<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Reset mật khẩu</title>

    <!-- Load CSS -->
    <link rel="stylesheet" href="{{asset('ui/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('ui/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('ui/css/style.min.css')}}">

</head>

<body>

<div class="module-sign-in">
    <div class="sign-in-wrapper">
        <div class="sign-in-form">
            <img src="{{asset('ui/images/logo.png')}}" alt="" class="img-responsive">

            <form action="{{route('lito::auth.reset.post')}}" method="post" role="form">

                {{csrf_field()}}

                <legend class="text-uppercase">Tạo mật khẩu mới</legend>

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
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" class="form-control" required name="username" value="{{$user_change->username}}" disabled>
                    <input type="hidden" name="id" value="{{$user_change->id}}">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu mới</label>
                    <input type="password" class="form-control" required name="password" placeholder="Nhập mật khẩu mới">
                </div>
                <div class="form-group">
                    <label for="repassword">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control" required name="repassword" placeholder="Xác nhận lại mật khẩu">
                </div>


                <button type="submit" class="btn btn-default">Đổi mật khẩu</button>
            </form>

        </div>

        <div class="sign-in-image hidden-xs hidden-sm"></div>
    </div>
</div>

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="{{asset('ui/js/bootstrap.min.js')}}"></script>

</body>
</html>