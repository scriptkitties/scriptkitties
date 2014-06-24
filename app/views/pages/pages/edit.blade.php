@extends('layout')

@section('main')
{{ Form::open() }}
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('content', 'Page contents') }}
					{{ Form::textarea('content', isset($page) ? $page->content : '', ['class' => 'form-control']) }}
				</div>
				<div class="form-group">
					{{ Form::submit('Update page contents', ['class' => 'btn btn-default']) }}
				</div>
			</div>
		</div>
	</div>
</div>
@stop
