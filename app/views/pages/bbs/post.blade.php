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
			<p>{{ $post->content }}</p>
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
			<p>{{ $reply->content }}</p>
		</div>
	</div>
</article>
@endforeach
@endif
@stop
