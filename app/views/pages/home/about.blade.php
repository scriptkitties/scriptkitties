@extends('layout')

@section('main')
<div class="container-fluid">
	<div class="row">
		<section class="col-md-8">
			<h1>About Scriptkitties</h1>
			<p>{{ $page->getParsed() }}</p>
		</section>
		<section class="col-md-4">
			<h2>Latest board posts</h2>
			@if(count($posts) > 0)
			@foreach($posts as $post)
			<div class="row">
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
						<p>{{ $post->getParsed() }}</p>
					</div>
				</div>
			</article>
			@endforeach
			@endif
		</div>
	</div>
</div>
@stop
