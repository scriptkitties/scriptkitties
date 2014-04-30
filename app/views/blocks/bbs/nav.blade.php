@section('bbs-nav')
<nav id="bbs-nav">
[
	@if(count($boards) > 0)
	@foreach($boards as $board)
	{{ link_to('/bbs/board/'.$board->name, '/'.$board->name.'/') }}
	@endforeach
	@endif
]
</nav>
@show
