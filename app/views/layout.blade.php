@section('nav')
<div class="container-fluid">
	<div class="row">
		<nav class="navbar navbar-default">
			<div class="col-md-10 col-md-offset-1">
			<ul class="nav navbar-nav">
				<li id="nav-li-about">{{ link_to('about', 'About') }}</li>
				@if(Auth::check())
				@if(Auth::user()->hasPermission('bbs', 'r'))
				<li id="nav-li-bbs" class="dropdown">
					{{ link_to('#', 'BBS', ['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown']) }}
					@if(count($bbsBoards) > 0)
					<ul class="dropdown-menu">
					@foreach($bbsBoards as $bbsBoard)
						<li>{{ link_to('bbs/board/'.$bbsBoard->name, '/'.$bbsBoard->name.'/'.' - '.$bbsBoard->description) }}</li>
					@endforeach
					</ul>
					@endif
				</li>
				@endif
				<li id="nav-li-logs">{{ link_to('logs', 'Website logs') }}</li>
				<li id="nav-li-members">{{ link_to('members', 'Members') }}</li>
				<li id="nav-li-user">{{ link_to('user/control', 'Profile') }}</li>
				<li>{{ link_to('user/logout', 'Logout') }}</li>
				@else
				<li id="nav-li-user">{{ link_to('login', 'Login') }}</li>
				@endif
			</ul>
			</div>
		</nav>
	</div>
</div>
@stop

@section('alert')
@if(count($errors) > 0)
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Validation error!</strong>
				<ul>
					@foreach($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
@endif
@foreach(['success', 'info', 'warning', 'danger'] as $alert)
@if(Session::get('alert-'.$alert))
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="alert alert-{{$alert}} alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>{{ucfirst($alert)}}!</strong>
				<p>{{Session::get('alert-'.$alert)}}</p>
			</div>
		</div>
	</div>
</div>
@endif
@endforeach
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
		@if($theme != null)
		{{ HTML::style('css/themes/'.$theme.'.css') }}
		@endif
		{{ HTML::style('css/style.css') }}
		@show
	</head>
	<body>
		<header id="header">
			[ AWESOME LOGO ]
		</header>
		@yield('nav')
		@yield('alert')
		<main style="width: 90%; margin: 0 auto;">
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
