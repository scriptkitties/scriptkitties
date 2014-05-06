@extends('layout')

@section('main')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			@if(count($boards) > 0)
			<table class="table">
				<thead>
					<tr>
						<th>Board name</th>
						<th>Description</th>
						<th>Posts</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					@foreach($boards as $board)
					<tr>
						<td>{{ $board->name }}</td>
						<td>{{ $board->description }}</td>
						<td>{{ $board->getPostcount() }}</td>
						<td>{{ link_to('admin/bbs/delete/'.$board->id, 'Delete') }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@else
			<p>There are no boards to delete.</p>
			@endif
		</div>
	</div>
</div>
@stop
