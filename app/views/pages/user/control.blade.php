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
			@if(isset($showActions) && $showActions)
			<h2>Actions</h2>
			<ul>
				@if($user->hasPermission('user', 'a'))
				<li>{{ link_to('admin/user/list', 'List all current users') }}</li>
				@endif
				@if($user->hasPermission('user', 'w'))
				<li>{{ link_to('admin/user/create', 'Create a new user') }}</li>
				@endif
				@if($user->hasPermission('bbs', 'a'))
				<li>{{ link_to('admin/bbs/create', 'Create a new board') }}</li>
				<li>{{ link_to('admin/bbs/delete', 'Delete a board') }}</li>
				@endif
			</ul>
			@endif
		</div>
	</div>
</div>
@stop
