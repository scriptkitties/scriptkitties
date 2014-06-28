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
			<div class="pull-left">
				{{ $post->getHeader() }}
			</div>
			<div class="pull-right">
			[{{ link_to('bbs/post/'.$post->id, Lang::choice('bbs.post.footer', $post->replyCount(), [
				'count' => $post->replyCount()
			])) }}]
			</div>
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
{{$replyBlock}}
@endif
@stop
