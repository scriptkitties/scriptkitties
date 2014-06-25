@extends('layout')

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
