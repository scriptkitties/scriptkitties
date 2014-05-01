@section('nav')
<nav class="navbar navbar-default">
	<ul class="nav navbar-nav">
		<li id="nav-li-about">{{ link_to('about', 'About') }}</li>
		@if(Auth::check())
		@if(Auth::user()->hasPermission('bbs', 'r'))
		<li id="nav-li-bbs" class="dropdown">
			{{ link_to('#', 'BBS', ['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown']) }}
			@if(count($bbsBoards) > 0)
			<ul class="dropdown-menu">
			@foreach($bbsBoards as $bbsBoard)
				<li>{{ link_to('bbs/board/'.$bbsBoard->name, '/'.$bbsBoard->name.'/') }}</li>
			@endforeach
			</ul>
			@endif
		</li>
		@endif
		<li id="nav-li-irc">{{ link_to('irc', 'IRC') }}</li>
		<li id="nav-li-user">{{ link_to('user/control', 'User Control Panel') }}</li>
		<li>{{ link_to('user/logout', 'Logout') }}</li>
		@else
		<li id="nav-li-user">{{ link_to('user/login', 'Login') }}</li>
		@endif
	</ul>
</nav>
@stop

@section('html')
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Scriptkitties</title>
		@section('style')
		{{ HTML::style('css/normalize.css') }}
		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('css/bootstrap-theme.min.css') }}
		{{ HTML::style('css/style.css') }}
		@show
	</head>
	<body>
		<header id="header">
			[ AWESOME LOGO ]
		</header>
		@yield('nav')
		<main>
			@yield('main')
		</main>
		<footer id="footer">
			&copy; {{ date('Y') }} - Scriptkitties
		</footer>
		@section('script')
		{{ HTML::script('js/vendor/jquery.js') }}
		{{ HTML::script('js/bootstrap.min.js') }}
		<script>
			// I R jQuery proz
			$("#nav-li-{{Request::segment(1)}}").addClass("active");
		</script>
		@show
	</body>
</html>
@show
