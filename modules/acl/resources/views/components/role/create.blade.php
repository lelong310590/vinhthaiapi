@extends('lito-dashboard::master')

@section('title', 'Tạo vai trò')

@section('content')

<div class="component">
	<h4 class="component-title">Tạo vai trò</h4>

	<form action="" method="post" role="form">

		{{csrf_field()}}

		<div class="row">
			<div class="col-xs-12 col-md-9">
				<div class="component-wrapper">

					@include('lito-dashboard::components.alert')

					<input type="hidden" name="created_by" value="{{Auth::id()}}">

					<div class="row">
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<label class="form-control-label">Tên loại tài khoản</label>
								<input type="text"
									   required
									   parsley-trigger="change"
									   class="form-control"
									   autocomplete="off"
									   name="display_name"
									   value="{{old('display_name')}}"
									   id="input_name"
									   onkeyup="changeSlug();"
								>
							</div>
						</div>

						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<div class="form-group">
									<label class="form-control-label">Slug</label>
									<input type="text"
										   required
										   parsley-trigger="change"
										   class="form-control"
										   autocomplete="off"
										   name="name"
										   value="{{old('name')}}"
										   id="input_slug"
									>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label class="form-control-label">Mô tả</label>
								<textarea type="text"
									   class="form-control"
									   autocomplete="off"
									   name="description"
									   value="{{old('description')}}"
									   rows="8"
								></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xs-12 col-md-3">
				<div class="component-wrapper">

					<button type="submit" class="btn btn-default btn-full">Tạo mới</button>

					@permission('role_edit')
					<button class="btn btn-outline btn-full"
							type="submit"
							name="continue_edit"
							value="1"
							style="margin-top: 20px"
					>
						Lưu và phân quyền
					</button>
					@endpermission

				</div>
			</div>
		</div>
	</form>
</div>

@endsection