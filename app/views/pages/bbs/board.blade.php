@extends('layout')

@section('main')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12" style="text-align: center;">
			<h1>/{{ $board->name }}/ <small>{{ $board->description }}</small></h1>
		</div>
	</div>
</div>
@if(count($posts) > 0)
	@foreach($posts as $post)
	<article class="container-fluid bbs-post">
		<header class="bbs-post-header">
			{{ $post->getHeader() }}
			[{{ link_to('bbs/post/'.$post->id, Lang::choice('bbs.post.footer', $post->replyCount(), [
				'count' => $post->replyCount()
			])) }}]
		</header>
		<div class="row bbs-post-content">
			<div class="col-sm-2 bbs-post-image">
				@if(isset($post->file))
				<a href="{{ URL::to('bbs/post/'.$post->id) }}">
				<img class="bbs-img" src="{{ $post->getImage() }}" alt="">
				</a>
				@endif
			</div>
			<section class="col-sm-10 bbs-post-text">
				<p>{{ $post->getParsed() }}</p>
			</section>
		</div>
	</article>
	@endforeach
@else
{{ trans('bbs.board.empty') }}
@endif
@if(Auth::check())
<hr>
{{ Form::open(['files' => true]) }}
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
							{{ Form::checkbox('anonify', '1', Auth::user()->preferences->anonymize) }}
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
@endif
@stop
