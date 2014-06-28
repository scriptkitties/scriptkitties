@extends('layout')

@section('script')
@if(!isset($nojs) || $nojs == false)
@parent
@endif
@if(isset($js))
{{ $js }}
@endif
@stop

@section('main')
<div class="container-fluid">
	@if(isset($title))
	<div class="row">
		<div class="col-md-12">
			<h1>{{ $title }}</h1>
		</div>
	</div>
	@endif
	<div class="row">
		<div class="col-md-12">
			{{ $content }}
		</div>
	</div>
</div>
@stop
