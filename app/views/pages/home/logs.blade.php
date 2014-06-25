@extends('layout')

@section('main')
<h1>
	Logs
	@if(Auth::check() && Auth::user()->hasPermission('pages', 'a'))
	<small>
		[{{ link_to('admin/pages/edit/'.$page->id, 'edit') }}]
	</small>
	@endif
</h1>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<p>{{ $page->getParsed() }}</p>
			<table class="table">
				<thead>
					<tr>
						<th>Log ID</th>
						<th>Datetime</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>
					@if(count($logs) > 0)
					@foreach($logs as $log)
					<tr>
						<td class="col-md-1">{{ $log->id}}</td>
						<td class="col-md-2">{{ $log->created_at }}</td>
						<td class="col-md-9">{{ $log->getDescription() }}</td>
					</tr>
					@endforeach
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
