@extends('layout')

@section('main')
<div class="container-fluid">
	<div class="row">
		<section class="col-md-8">
			<h1>
				Scriptkitties
				@if(Auth::check() && Auth::user()->hasPermission('pages', 'a'))
				<small>
					[{{ link_to('admin/pages/edit/'.$page->id, 'edit') }}]
				</small>
				@endif
			</h1>
			{{$page->getParsed()}}
		</section>
		<section class="col-md-4">
			<h2>Epeen ranking</h2>
			@foreach($epeenTop as $e)
			<div class="row">
				<div class="col-md-8">{{ $e->user->nickname }}</div>
				<div class="col-md-4">{{ $e->epeen }}px</div>
			</div>
			@endforeach
			<div class="row">
				<div class="col-md-12">...</div>
			</div>
			@foreach($epeenBot as $e)
			<div class="row">
				<div class="col-md-8">{{ $e->user->nickname }}</div>
				<div class="col-md-4">{{ $e->epeen }}px</div>
			</div>
			@endforeach
			<h2>Latest board posts</h2>
			@if(count($posts) > 0)
			@foreach($posts as $post)
			<article class="row">
				<header>
					{{ $post->getHeader() }}
				</header>
				<div class="row">
					<div class="col-md-2">
						@if(isset($post->file))
						<a href="{{ URL::to('bbs/post/'.$post->getParent()) }}">
							<img class="bbs-img" src="{{ $post->getImage() }}" alt="">
						</a>
						@endif
					</div>
					<section class="col-md-10">
						<p>{{ $post->getParsed(200) }}</p>
					</section>
				</div>
			</article>
			@endforeach
			@endif
		</div>
	</div>
</div>
@stop
