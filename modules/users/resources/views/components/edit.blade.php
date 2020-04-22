@extends('lito-dashboard::master')

@section('title', 'Sửa tài khoản')

@section('js')
	<script type="text/javascript" src="{{asset('ui/vendor/ckeditor4.8/ckeditor.js')}}"></script>
@endsection

@section('js-init')
	<script type="text/javascript" src="{{asset('ui/vendor/ckeditor4.8/init.js')}}"></script>
@endsection

@section('content')

	@php
		$user = Auth::user();
        $roles = $user->load('roles.perms');
        $permissions = $roles->roles->first()->perms;
	@endphp

	<div class="component">
		<h4 class="component-title">Sửa tài khoản</h4>

		<form action="" method="post" role="form">

			{{csrf_field()}}

			<div class="row">
				<div class="col-xs-12 col-md-9">
					<div class="component-wrapper">

						@include('lito-dashboard::components.alert')

						<input type="hidden" value="{{$data->id}}" name="current_id">

						<input type="hidden" value="{{Auth::id()}}" name="edited_by">

						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="username">Tên đăng nhập</label>
									<input type="text"
										   class="form-control"
										   required
										   data-parsley-pattern="/^[a-z0-9]+$/"
										   data-parsley-minlength="5"
										   name="username"
										   value="{{$data->username}}"
									>
								</div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="email">Địa chỉ Email</label>
									<input type="email"
										   required
										   parsley-trigger="change"
										   class="form-control"
										   autocomplete="off"
										   name="email"
										   value="{{$data->email}}"
									>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="password">Mật khẩu</label>
									<input type="password"
										   class="form-control"
										   autocomplete="off"
										   data-parsley-minlength="6"
										   name="password"
										   id="password"
										   placeholder="******"
									>
								</div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="repassword">Xác nhận lại mật khẩu</label>
									<input data-parsley-equalto="#password"
										   type="password"
										   class="form-control"
										   id="re_password"
										   autocomplete="off"
										   data-parsley-minlength="6"
										   name="re_password"
										   placeholder="******"
									>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="fullname">Họ và tên</label>
									<input type="text"
										   required
										   class="form-control"
										   autocomplete="off"
										   data-parsley-minlength="6"
										   name="full_name"
										   value="{{$data->full_name}}"
									>
								</div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="phone">Số điện thoại</label>
									<input type="text"
										   class="form-control"
										   autocomplete="off"
										   data-parsley-minlength="10"
										   name="phone"
										   value="{{$data->phone}}"
									>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="status">Trạng thái tài khoản</label>
									<select name="status" class="form-control">
										<option value="active" {{ ($data->status == 'active') ? 'selected' : '' }}>Kích hoạt</option>
										<option value="disable" {{ ($data->status == 'disable') ? 'selected' : '' }}>Tạm khóa</option>
									</select>
								</div>
							</div>

							<div class="col-xs-12 col-md-6">
								@if (Auth::id() != $data->id)
									<div class="form-group">
										<label class="form-control-label">Loại tài khoản</label>
										<select class="custom-select form-control" name="role">
											@foreach($role as $r)
												<option value="{{$r->id}}" {{ (old('role') == $r->id) ? 'selected' : '' }}>{{$r->display_name}}</option>
											@endforeach
										</select>
									</div>
								@else
									<input type="hidden" value="{{$data->roles()->first()->id}}" name="role">
								@endif
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<label for="status">Giới thiệu</label>
									<textarea id="ckeditor"
											  class="form-control"
											  name="description"
											  required
											  parsley-trigger="change"
									>{{old('description')}}</textarea>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-md-3">
					<div class="component-wrapper">

						@include('lito-dashboard::components.thumbnail')

						<button type="submit" class="btn btn-default btn-full">Sửa tài khoản</button>

					</div>
				</div>
			</div>
		</form>


	</div>

@endsection
