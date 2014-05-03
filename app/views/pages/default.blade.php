@extends('layout')

@section('main')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			{{ $page->getParsed() }}
		</div>
	</div>
</div>
@stop
