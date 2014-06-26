@extends('layout')

@section('main')
<div class="row">
	<div class="col-md-12">
		<section class="content">
			<h1>
				Logs
				@if(Auth::check() && Auth::user()->hasPermission('pages', 'a'))
				<small>
					[{{ link_to('admin/pages/edit/'.$page->id, 'edit') }}]
				</small>
				@endif
			</h1>
			{{ $page->getParsed() }}
		</section>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<section class="content">
			<table class="table table-hover">
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
		</section>
	</div>
</div>
@stop
