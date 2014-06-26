@extends('layout')

@section('main')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<section class="content">
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
		</div>
		<div class="col-md-4">
			<div>
			<section class="content">
				<h2>Epeen ranking</h2>
				<table class="table">
				@foreach($epeenTop as $e)
					<tr>
						<td>{{link_to('member/'.$e->user->id, $e->user->nickname)}}</td>
						<td style="text-align: right">{{ $e->epeen }}px</td>
					</tr>
				@endforeach
					<tr>
						<td colspan="2">...</td>
					</tr>
				@foreach($epeenBot as $e)
					<tr>
						<td>{{link_to('member/'.$e->user->id, $e->user->nickname)}}</td>
						<td style="text-align: right">{{ $e->epeen }}px</td>
					</tr>
				@endforeach
				</table>
			</section>
			</div>
			<section class="content">
			<h2>Latest board posts</h2>
			@if(count($posts) > 0)
			@foreach($posts as $post)
			<article class="row bbs-post bbs-preview">
				<header>
					{{ $post->getHeader() }}
					[{{link_to('bbs/post/'.$post->getParent().'#post-'.$post->id, trans('bbs.reply'))}}]
				</header>
				<div class="row">
					<div class="col-sm-2 col-md-3">
						@if(isset($post->file))
						<a href="{{ URL::to('bbs/post/'.$post->getParent()) }}">
							<img class="bbs-img" src="{{ $post->getImage() }}" alt="">
						</a>
						@endif
					</div>
					<section class="col-sm-10 col-md-9">
						<p>{{ $post->getParsed(200) }}</p>
					</section>
				</div>
			</article>
			@endforeach
			@endif
			</section>
		</div>
	</div>
</div>
@stop
