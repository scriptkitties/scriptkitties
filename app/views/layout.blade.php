<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Scriptkitties</title>
		{{ HTML::style('css/normalize.css') }}
		{{ HTML::style('css/foundation.min.css') }}
	</head>
	<body>
		<header>
			[ AWESOME LOGO ]
		</header>
		<nav>
			<ul>
				<li>{{ link_to('about', 'About') }}</li>
				<li>{{ link_to('bbs', 'BBS') }}</li>
				<li>{{ link_to('irc', 'IRC') }}</li>
				<li>{{ link_to('user/login', 'Login') }}</li>
			</ul>
		</nav>
		<main>
			@yield('main')
		</main>
		<footer>
			&copy; {{ date('Y') }} - Scriptkitties
		</footer>
		@section('script')
		{{ HTML::script('foundation.min.js') }}
		@show
	</body>
</html>
