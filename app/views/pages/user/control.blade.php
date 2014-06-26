@extends('layout')

@section('main')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h1>
				{{$user->nickname}}
				@if(isset($showActions) && $showActions && $user->hasPermission('user', 'a'))
				<small>[{{link_to('user/edit', 'Edit')}}]</small>
				@endif
			</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-9">
			<h2>Profile</h2>
		</div>
		<div class="col-md-3">
			<h2>Stats</h2>
			<table class="table">
				<tbody>
					<tr>
						<td>Epeen length</td>
						<td>{{$user->stats->epeen}}px</td>
					</tr>
					<tr>
						<td>Registered since</td>
						<td>{{$user->created_at->format(Config::get('app.formats.date'))}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
