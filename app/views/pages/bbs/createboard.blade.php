@extends('layout')

@section('main')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			{{ Form::open() }}
				<div class="form-group">
					{{ Form::label('name', 'Board name') }}
					{{ Form::text('name', null, ['class' => 'form-control']) }}
				</div>
				<div class="form-group">
					{{ Form::label('description', 'Board description') }}
					{{ Form::text('description', null, ['class' => 'form-control']) }}
				</div>
				<div class="form-group">
					{{ Form::submit('Create new board', ['class' => 'btn btn-default']) }}
				</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop
