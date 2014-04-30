@extends('layout')

@section('main')
OP: {{ $post->id }}
@if(count($replies) > 0)
@foreach($replies as $reply)
@endforeach
@endif
@stop
