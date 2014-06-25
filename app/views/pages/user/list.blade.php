@extends('layout')

@section('main')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th>Nickname</th>
						<th>Email address</th>
						<th>Homepage</th>
						<th>Registered since</th>
						<th>Banned</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
					<tr>
						<td>{{ link_to('admin/user/edit/'.$user->id, $user->nickname) }}</td>
						<td>{{ link_to('mailto:'.$user->email, $user->email) }}</td>
						<td>{{ link_to($user->website) }}</td>
						<td>{{ $user->created_at->format(Config::get('app.formats.date')) }}</td>
						<td>{{ $user->deleted_at != null ? 'Yes' : 'No' }}</td>
						<td style="text-align: right">
							{{ link_to('admin/user/edit/'.$user->id, 'Edit', ['class' => 'btn btn-default btn-xs']) }}
							{{ link_to('admin/user/permissions/'.$user->id, 'Permissions', ['class' => 'btn btn-default btn-xs']) }}
							{{ link_to('admin/user/delete/'.$user->id, 'Delete', ['class' => 'btn btn-default btn-xs']) }}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
