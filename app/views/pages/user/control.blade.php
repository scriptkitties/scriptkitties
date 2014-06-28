@extends('layout')

@section('main')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-9">
			<section class="content">
				<h1>
					{{$user->nickname}}
					@if(isset($showActions) && $showActions && $user->hasPermission('user', 'a'))
					<small>[{{link_to('user/edit', 'Edit')}}]</small>
					@endif
				</h1>
				<h2>Profile</h2>
			</section>
		</div>
		<div class="col-md-3">
			<section class="content">
				<h2>Stats</h2>
				<table class="table">
					<tbody>
						<tr>
							<td>Epeen length</td>
							<td style="text-align: right">{{$user->stats->epeen}}px</td>
						</tr>
						<tr>
							<td>Registered since</td>
							<td style="text-align: right">{{$user->created_at->format(Config::get('app.formats.date'))}}</td>
						</tr>
					</tbody>
				</table>
			</section>
		</div>
	</div>
</div>
@stop
