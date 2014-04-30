@extends('layout')

@section('main')
{{ $nav }}
@if(count($posts) > 0)
	@foreach($posts as $post)
		{{ $post->author }}
	@endforeach
@else
{{ trans('bbs.board.empty') }}
@endif
@stop
