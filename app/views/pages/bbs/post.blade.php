@extends('layout')

@section('main')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12" style="text-align: center;">
			<h1>/{{ $board->name }}/ <small>{{ $board->description }}</small></h1>
		</div>
	</div>
</div>
<article class="container-fluid">
	<header>
		@if($post->author == null)
		{{ trans('bbs.post.header', [
			'name' => 'Anonymous',
			'id' => link_to('bbs/post/'.$post->id, $post->id),
			'date' => $post->created_at
		]) }}
		@else
		{{ trans('bbs.post.header', [
			'name' => link_to('user/profile/'.$post->author, User::find($post->author)->nickname),
			'id' => link_to('bbs/post/'.$post->id, $post->id),
			'date' => $post->created_at
		]) }}
		@endif
	</header>
	<div class="row">
		<div class="col-md-2">
		@if(isset($post->file))
			<a href="{{ $post->getUpload() }}">
				<img class="bbs-img" src="{{ $post->getUpload() }}" alt="">
			</a>
		@endif
		</div>
		<section class="col-md-10">
			<p>{{ $post->getParsed() }}</p>
		</div>
	</div>
</article>
@if(count($replies) > 0)
@foreach($replies as $reply)
<article class="container-fluid">
	<header>
		@if($reply->author == null)
		{{ trans('bbs.post.header', [
			'name' => 'anonymous',
			'id' => link_to('bbs/post/'.$reply->id, $reply->id),
			'date' => $reply->created_at
		]) }}
		@else
		{{ trans('bbs.post.header', [
			'name' => link_to('user/profile/'.$reply->author, user::find($reply->author)->nickname),
			'id' => link_to('bbs/post/'.$reply->id, $reply->id),
			'date' => $reply->created_at
		]) }}
		@endif
	</header>
	<div class="row">
		<div class="col-md-2">
			@if(isset($reply->file))
			<a href="{{ $reply->getUpload() }}">
				<img class="bbs-img" src="{{ $reply->getUpload() }}" alt="">
			</a>
			@endif
		</div>
		<section class="col-md-10">
			<p>{{ $reply->getParsed() }}</p>
		</div>
	</div>
</article>
@endforeach
@endif
@if(Auth::check())
<hr>
{{ Form::open(['files' => true]) }}
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
			<div class="col-sm-7">
				<div class="form-group">
					{{ Form::label('file', trans('bbs.reply.image')) }}
					{{ Form::file('file') }}
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<div class="checkbox">
						<label>
							{{ trans('bbs.anonify') }}
							{{ Form::checkbox('anonify', '1', Auth::user()->preferences->anonymize) }}
						</label>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					{{ Form::submit(trans('bbs.reply.submit'), ['class' => 'btn btn-default pull-right']) }}
				</div>
			</div>
		</div>
	</div>
{{ Form::close() }}
@endif
@stop
