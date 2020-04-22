@extends('lito-dashboard::master')

@section('title', 'Sửa vai trò')

@php
	$user = Auth::user();
	$roles = $user->load('roles.perms');
	$permissions = $roles->roles->first()->perms;
@endphp

@section('content')

	<form action="" method="post" role="form">

		{{csrf_field()}}

		@include('lito-dashboard::components.alert')

		<input type="hidden" name="edited_by" value="{{Auth::id()}}">

		<div class="component">
			<h4 class="component-title">Sửa vai trò</h4>

			<div class="row">
				<div class="col-xs-12">
					<div class="component-wrapper">
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label class="form-control-label">Role</label>
									<input type="text"
										   required
										   parsley-trigger="change"
										   class="form-control"
										   autocomplete="off"
										   name="display_name"
										   value="{{$data->display_name}}"
										   id="input_name"
										   onkeyup="ChangeToSlug();"
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
											   value="{{$data->name}}"
											   disabled
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
											  value="{{$data->description}}"
											  rows="8"
									>{{$data->description}}</textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="component">
			<h4 class="component-title">Thiết lập các quyền cho vai trò này</h4>

			<div class="component-table">
				<div class="component-table-bar">
					<div class="component-table-content">
						<table class="table table-hover">
							<thead>
							<tr>
								<th>Tên quyền</th>
								<th>Slug</th>
								<th>Miêu tả</th>
								<th>Module</th>
								<th width="100"></th>
							</tr>
							</thead>
							<tbody>
							@forelse($perms as $p)
								<tr>
									<td>{{ $p->display_name }}</td>
									<td>{{ $p->name }}</td>
									<td>{{ $p->description }}</td>
									<td><b>{{$p->module}}</b></td>
									<td class="center" width="100">
										<label class="custom-control custom-checkbox">
											<input
													type="checkbox"
													class="custom-control-input"
													name="permission[]"
													value="{!! $p->id !!}"
													{!! (in_array($p->id, $currentPermision)) ? 'checked' : '' !!}
											>
											<span class="custom-control-indicator"></span>
										</label>
									</td>
								</tr>
							@empty
								<tr>
									<td colspan="7">
										Chưa có bản ghi nào !
									</td>
								</tr>
							@endforelse
							</tbody>
							<tfoot>
							<tr>
								<td colspan="100%" class="table-footer">
									<div class="table-count">{{count($perms)}} bản ghi</div>
								</td>
							</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>

		<button type="submit" class="btn btn-default btn-full">Lưu lại</button>

	</form>

@endsection