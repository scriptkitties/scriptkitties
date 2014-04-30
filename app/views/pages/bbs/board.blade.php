@extends('layout')

@section('main')
@if(count($posts) > 0)
	@foreach($posts as $post)
	<article class="bbs-post">
		<header>
			{{ link_to('user/profile/'.$post->author, User::find($post->author)->nickname) }}
			posted
			{{ link_to('bbs/post/'.$post->id, '#'.$post->id) }}
			on
			{{ $post->created_at }}:
		</header>
		<div class="bbs-image">
		@if(isset($post->file))
			<img src="{{ $post->file }}" alt="">
		@endif
		</div>
		<p>
			{{ $post->content }}
		</p>
		<footer>
			{{ $post->replyCount() }} replies.
		</footer>
	</article>
	@endforeach
@else
{{ trans('bbs.board.empty') }}
@endif
@stop
