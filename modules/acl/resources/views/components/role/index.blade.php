@extends('lito-dashboard::master')

@section('title', 'Danh sách vai trò')

@section('content')

@php
	$user = Auth::user();
	$roles = $user->load('roles.perms');
	$permissions = $roles->roles->first()->perms;
@endphp

<div class="component">
	<h4 class="component-title">Danh sách vai trò</h4>
	<div class="component-table">
		<div class="component-table-bar">
			<a href="{{route('lito::role.create.get')}}" class="btn-outline text-uppercase component-table-bar-button">Tạo vai trò</a>

			<div class="component-table-filter">
				<div class="component-table-search">
					<form action="" method="get" role="form">

						<div class="form-group">
							<input type="text" class="form-control" name="username" placeholder="Tìm kiếm.." value="{{Request::get('keyword')}}">
							<button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
						</div>

					</form>
				</div>
			</div>
		</div>

		<div class="component-table-content">

			@include('lito-dashboard::components.alert')

			<table class="table table-hover">
				<thead>
				<tr>
					<th>Vai trò</th>
					<th>Slug</th>
					<th>Mô tả</th>
					<th width="200"><b>Thao tác</b></th>
				</tr>
				</thead>
				<tbody>
					@forelse($data as $d)
						<tr>
							<td>{{ $d->display_name }}</td>
							<td>{{ $d->name }}</td>
							<td>{{ $d->description }}</td>
							<td class="action" width="200">
								@if ($permissions->contains('name','role_edit'))
									<a href="{{route('lito::role.edit.get', $d->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
								@endif

								@if ($roles->roles->first()->id != $d->id && $permissions->contains('name','role_delete'))
									<a href="javascript:;" class="delete-record" data-href="{{route('lito::role.delete.get', $d->id)}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
								@endif
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="4">
								Chưa có bản ghi nào !
							</td>
						</tr>
					@endforelse
				</tbody>
				<tfoot>
				<tr>
					<td colspan="100%" class="table-footer">
						<div class="table-count">{{$data->total()}} bản ghi</div>

						{{$data->links('lito-dashboard::components.pagination')}}

					</td>
				</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>

@endsection