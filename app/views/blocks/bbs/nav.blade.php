@section('subnav')
<nav id="bbs-nav">
	<ul>
		@if(count($boards) > 0)
		@foreach($boards as $board)
		<li>{{ link_to('/bbs/board/'.$board->name, $board->name) }}</li>
		@endforeach
		@endif
	</ul>
</nav>
@show
