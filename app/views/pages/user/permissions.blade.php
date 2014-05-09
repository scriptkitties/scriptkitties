@extends('layout')

@section('main')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<p>Editing permissions of <strong>{{ $user->nickname }}</strong>.</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			{{ Form::open() }}
				<div class="form-group">
					<table class="table">
						<thead>
							<tr>
								<th>Permissionlist</th>
								<th>Read</th>
								<th>Write</th>
								<th>Admin</th>
							</tr>
						</thead>
						<tbody>
							@foreach($permlist as $perm => $desc)
							<tr>
								{{ Form::hidden('perms[]', $perm) }}
								<td>{{ $desc }}</td>
								<td>
									<div class="checkbox">
										{{ Form::checkbox($perm.'_read', '1', $user->hasPermission($perm, 'r')) }}
									</div>
								</td>
								<td>
									<div class="checkbox">
										{{ Form::checkbox($perm.'_write', '1', $user->hasPermission($perm, 'w')) }}
									</div>
								</td>
								<td>
									<div class="checkbox">
										{{ Form::checkbox($perm.'_admin', '1', $user->hasPermission($perm, 'a')) }}
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="form-group">
					{{ Form::submit('Save permissions', ['class' => 'btn btn-default']) }}
				</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop
