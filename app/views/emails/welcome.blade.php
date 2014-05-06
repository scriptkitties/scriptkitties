<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>Welcome to Scriptkitties!</h1>
		<p>
			Welcome to Scriptkitties, {{ $user->nickname }}.
		</p>
		<p>
			You have been invited to this community by {{ link_to('user/profile/'.$referer->id, $referer->nickname) }}. If you like,
			you can thank him (or her) on our {{ link_to('bbs', 'BBS') }}, or {{ link_to('irc', 'IRC') }}.
		</p>
		<p>
			Of course, you would like to be able to log in, which requires a password. We've generated one for you:
		</p>
		<pre>{{ $password }}</pre>
		<p>
			For security reasons, please change this password to something else after logging in. You can do so on
			your {{ link_to('user/control', 'User Control Panel') }}. The best security would be to use a password
			manager.
		</p>
		<p>
			We hope you will enjoy our community!
		</p>
	</body>
</html>
