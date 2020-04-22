@extends('lito-dashboard::master')

@section('title', 'Danh sách quyền')

@section('content')

	<div class="component">
		<h4 class="component-title">Danh sách quyền</h4>
		<div class="component-table">
			<div class="component-table-bar">
				<div class="component-table-filter">
					<div class="component-table-search">
						<form method="get" role="form">

							<div class="form-group">
								<input type="text" class="form-control" name="keyword" placeholder="Tìm kiếm.." value="{{Request::get('keyword')}}">
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
							<th>Quyền</th>
							<th>Miêu tả</th>
							<th>Module</th>
						</tr>
					</thead>
					<tbody>
					@forelse($data as $d)
						<tr>
							<td>{{$d->name}}</td>
							<td>{{$d->description}}</td>
							<td><b>{{$d->module}}</b></td>
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
							<div class="table-count">{{count($data)}} bản ghi</div>
						</td>
					</tr>
					</tfoot>
				</table>
			</div>
		</div>

	</div>

@endsection