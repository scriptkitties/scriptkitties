<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Scriptkitties</title>
		{{ HTML::style('css/normalize.css') }}
		{{ HTML::style('css/foundation.min.css') }}
		{{ HTML::style('css/style.css') }}
	</head>
	<body>
		<header>
			[ AWESOME LOGO ]
		</header>
		@section('nav')
		<nav id="nav">
			<ul>
				<li id="nav-li-about">{{ link_to('about', 'About') }}</li>
				@if(Auth::check())
				<li id="nav-li-bbs">{{ link_to('bbs', 'BBS') }}</li>
				<li id="nav-li-irc">{{ link_to('irc', 'IRC') }}</li>
				<li id="nav-li-user">{{ link_to('user/control', 'User Control Panel') }}</li>
				<li>{{ link_to('user/logout', 'Logout') }}</li>
				@else
				<li id="nav-li-user">{{ link_to('user/login', 'Login') }}</li>
				@endif
			</ul>
		</nav>
		@yield('subnav')
		@show
		<main>
			@yield('main')
		</main>
		<footer>
			&copy; {{ date('Y') }} - Scriptkitties
		</footer>
		@section('script')
		{{ HTML::script('js/vendor/jquery.js') }}
		{{ HTML::script('js/foundation.min.js') }}
		<script>
			// I R jQuery proz
			$("#nav-li-{{Request::segment(1)}}").addClass("active");
		</script>
		@show
	</body>
</html>
