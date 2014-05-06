@extends('layout')

@section('main')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			{{ Form::open() }}
				<div class="form-group">
					{{ Form::label('nickname', trans('user.create.nickname')) }}
					{{ Form::text('nickname', null, ['class' => 'form-control']) }}
				</div>
				<div class="form-group">
					{{ Form::label('email', trans('user.create.email')) }}
					{{ Form::text('email', null, ['class' => 'form-control']) }}
				</div>
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
								<td><div class="checkbox">{{ Form::checkbox($perm.'_read', '1', true) }}</div></td>
								<td><div class="checkbox">{{ Form::checkbox($perm.'_write', '1', true) }}</div></td>
								<td><div class="checkbox">{{ Form::checkbox($perm.'_admin', '1') }}</div></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="form-group">
					{{ Form::submit(trans('user.create.submit'), ['class' => 'btn btn-default']) }}
				</div>
			</form>
		</div>
	</div>
</div>
@stop
