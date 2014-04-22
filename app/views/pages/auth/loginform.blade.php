@extends('layout')

@section('main')
{{ Form::open() }}
	{{ Form::text('username', null) }}
	{{ Form::password('password') }}
	{{ Form::submit('Log in') }}
</form>
@stop
