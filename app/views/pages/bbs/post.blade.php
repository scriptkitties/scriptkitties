@extends('layout')

@section('main')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12" style="text-align: center;">
			<h1>/{{ $board->name }}/ <small>{{ $board->description }}</small></h1>
		</div>
	</div>
</div>
<article class="container-fluid bbs-post">
	<header class="bbs-post-header">
		<div class="pull-left">
			{{ $post->getHeader() }}
		</div>
		@if(Auth::check())
		<div class="pull-right">
			@if(Auth::user()->id == $post->author_id)
			[{{link_to('bbs/post-edit/'.$post->id, 'edit')}}]
			@endif
			@if(Auth::user()->hasPermission('bbs', 'a'))
			[{{link_to('admin/bbs/post-delete/'.$post->id, 'delete')}}]
			@endif
		</div>
		@endif
	</header>
	<div class="row bbs-post-content">
		<div class="col-sm-2 bbs-post-image">
		@if(isset($post->file))
			<a href="{{ $post->getImage(true) }}">
				<img class="bbs-img" src="{{ $post->getImage() }}" alt="">
			</a>
		@endif
		</div>
		<section class="col-sm-10 bbs-post-text">
			<p>{{ $post->getParsed() }}</p>
		</section>
	</div>
</article>
@if(count($replies) > 0)
@foreach($replies as $reply)
<article class="container-fluid bbs-post">
	<header class="bbs-post-header">
		<div class="pull-left">
			{{ $reply->getHeader() }}
		</div>
		@if(Auth::check())
		<div class="pull-right">
			@if(Auth::user()->id == $reply->author_id)
			[{{link_to('bbs/post-edit/'.$reply->id, 'edit')}}]
			@endif
			@if(Auth::user()->hasPermission('bbs', 'a'))
			[{{link_to('admin/bbs/post-delete/'.$reply->id, 'delete')}}]
			@endif
		</div>
		@endif
	</header>
	<div class="row bbs-post-content">
		<div class="col-sm-2 bbs-post-image">
			@if(isset($reply->file))
			<a href="{{ $reply->getImage(true) }}">
				<img class="bbs-img" src="{{ $reply->getImage() }}" alt="">
			</a>
			@endif
		</div>
		<section class="col-sm-10 bbs-post-text">
			<p>{{ $reply->getParsed() }}</p>
		</section>
	</div>
</article>
@endforeach
@endif
@if(Auth::check())
{{$replyBlock}}
@endif
@stop
