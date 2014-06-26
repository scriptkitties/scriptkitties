@extends('layout')

@section('main')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<section class="content">
				<h1>
					Members
					@if(Auth::check() && Auth::user()->hasPermission('user', 'a'))
					<small>
						[{{link_to('admin/user/create', 'register')}}]
					</small>
					@endif
				</h1>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Nickname</th>
							<th>Epeen</th>
							<th>Member since</th>
							@if(Auth::check() && Auth::user()->hasPermission('user', 'a'))
							<th></th>
							@endif
						</tr>
					</thead>
					<tbody>
						@foreach($members as $user)
						<tr>
							<td>{{link_to('member/'.$user->id, $user->nickname)}}</td>
							<td>{{$user->stats->epeen}}px</td>
							<td>{{$user->created_at->format(Config::get('app.formats.date'))}}
							@if(Auth::check() && Auth::user()->hasPermission('user', 'a'))
							<td style="text-align: right">
								{{ link_to('admin/user/edit/'.$user->id, 'Edit', ['class' => 'btn btn-default btn-xs']) }}
								{{ link_to('admin/user/permissions/'.$user->id, 'Permissions', ['class' => 'btn btn-default btn-xs']) }}
								{{ link_to('admin/user/delete/'.$user->id, 'Delete', ['class' => 'btn btn-default btn-xs']) }}
							</td>
							@endif
						</tr>
						@endforeach
					</tbody>
				</table>
			</section>
		</div>
	</div>
</div>
@stop
