@extends('layout')

@section('main')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			{{ Form::open() }}
				<div class="form-group">
					{{ Form::label('username') }}
					{{ Form::text('username', null, ['class' => 'form-control']) }}
				</div>
				<div class="form-group">
					{{ Form::label('password') }}
					{{ Form::password('password', ['class' => 'form-control']) }}
				</div>
				<div class="form-group">
					{{ Form::submit('Log in', ['class' => 'btn btn-default']) }}
				</div>
			</form>
		</div>
	</div>
</div>
@stop
