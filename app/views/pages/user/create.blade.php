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
					{{ Form::submit(trans('user.create.submit'), ['class' => 'btn btn-default']) }}
				</div>
			</form>
		</div>
	</div>
</div>
@stop
