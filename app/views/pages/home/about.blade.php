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
			<table class="table">
			@foreach($epeenTop as $e)
				<tr>
					<td>{{ $e->user->nickname }}</td>
					<td>{{ $e->epeen }}px</td>
				</tr>
			@endforeach
				<tr>
					<td colspan="2">...</td>
				</tr>
			@foreach($epeenBot as $e)
				<tr>
					<td>{{ $e->user->nickname }}</td>
					<td>{{ $e->epeen }}px</td>
				</tr>
			@endforeach
			</table>
			<h2>Latest board posts</h2>
			@if(count($posts) > 0)
			@foreach($posts as $post)
			<article class="row bbs-preview">
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
