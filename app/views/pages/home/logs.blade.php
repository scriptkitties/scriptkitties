@extends('layout')

@section('main')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<p>{{ $page->getParsed() }}</p>
			<table class="table">
				<thead>
					<tr>
						<th>Datetime</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>
					@if(count($logs) > 0)
					@foreach($logs as $log)
					<tr>
						<td class="col-md-2">{{ $log->created_at }}</td>
						<td class="col-md-10">{{ $log->getDescription() }}</td>
					</tr>
					@endforeach
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
