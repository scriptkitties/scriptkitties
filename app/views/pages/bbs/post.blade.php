@extends('layout')

@section('main')
<article class="container-fluid">
	<header>
			{{ trans('bbs.post.header', [
				'name' => link_to('user/profile/'.$post->author, User::find($post->author)->nickname),
				'id' => link_to('bbs/post/'.$post->id, $post->id),
				'date' => $post->created_at
			]) }}
	</header>
	<div class="row">
		<div class="col-md-3">
		@if(isset($post->file))
			<img src="{{ $post->file }}" alt="">
			<p>a</p>
		@endif
		</div>
		<section class="col-md-9">
			<p>{{ $post->getParsed() }}</p>
		</div>
	</div>
</article>
@if(count($replies) > 0)
@foreach($replies as $reply)
<article class="container-fluid">
	<header>
			{{ trans('bbs.post.header', [
				'name' => link_to('user/profile/'.$reply->author, User::find($reply->author)->nickname),
				'id' => link_to('bbs/post/'.$reply->id, $reply->id),
				'date' => $reply->created_at
			]) }}
	</header>
	<div class="row">
		<div class="col-md-3">
		@if(isset($reply->file))
			<img src="{{ $reply->file }}" alt="">
			<p>a</p>
		@endif
		</div>
		<section class="col-md-9">
			<p>{{ $reply->getParsed() }}</p>
		</div>
	</div>
</article>
@endforeach
@endif
<hr>
{{ Form::open() }}
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('content', trans('bbs.reply.title')) }}
					{{ Form::textarea('content', null, ['class' => 'form-control']) }}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-9">
				<div class="form-group">
					{{ Form::label('file', trans('bbs.reply.image')) }}
					{{ Form::file('file') }}
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					{{ Form::submit(trans('bbs.reply.submit'), ['class' => 'btn btn-default pull-right']) }}
				</div>
			</div>
		</div>
	</div>
{{ Form::close() }}
@stop