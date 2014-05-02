@extends('layout')

@section('main')
@if(count($posts) > 0)
	@foreach($posts as $post)
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
		<footer>
			{{ Lang::choice('bbs.post.footer', $post->replyCount(), ['count' => $post->replyCount()]) }}
		</footer>
	</article>
	@endforeach
@else
{{ trans('bbs.board.empty') }}
@endif
<hr>
{{ Form::open() }}
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('content', trans('bbs.new.title')) }}
					{{ Form::textarea('content', null, ['class' => 'form-control']) }}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-7">
				<div class="form-group">
					{{ Form::label('file', trans('bbs.new.image')) }}
					{{ Form::file('file') }}
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<div class="checkbox">
						<label>
							{{ trans('bbs.anonify') }}
							{{ Form::checkbox('anonify', '1', false) }}
						</label>
					</div>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					{{ Form::submit(trans('bbs.new.submit'), ['class' => 'btn btn-default pull-right']) }}
				</div>
			</div>
		</div>
	</div>
{{ Form::close() }}
@stop
