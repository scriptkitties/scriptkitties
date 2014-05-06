@extends('layout')

@section('script')
@parent
<script>
	$('#page-select').change(function() {
		window.location = "{{ URL::to('/') }}/admin/pages/edit/"+$('#page-select').val();
		console.log($('#page-select').val());
	});
</script>
@stop

@section('main')
{{ Form::open() }}
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="form-group">
					Select a page to edit:
					{{ Form::select('page', $pages, isset($page) ? $page->id : null, ['id' => 'page-select']) }}
				</div>
			</div>
		</div>
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
