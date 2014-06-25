@extends('layout')

@section('main')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-hover">
				<thead>
					<tr>
						<td>Nickname</td>
						<td>Epeen</td>
						<td>Member since</td>
				</thead>
				<tbody>
					@foreach($members as $user)
					<tr>
						<td>{{link_to('member/'.$user->id, $user->nickname)}}</td>
						<td>{{$user->stats->epeen}}px</td>
						<td>{{$user->created_at->format(Config::get('app.formats.date'))}}
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
