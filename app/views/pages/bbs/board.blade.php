@extends('layout')

@section('main')
@if(count($posts) > 0)
	@foreach($posts as $post)
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
				<p>{{ $post->htmlSafeContent() }}</p>
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
@stop
