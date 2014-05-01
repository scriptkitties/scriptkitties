@extends('layout')

@section('script')
@parent
<script>
	$("#ucp-tabs a").click(function(e) {
		e.preventDefault();
		$(this).tab("show");
	});
</script>
@stop

@section('main')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<p>{{ trans('user.control.help') }}</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
			<ul id="ucp-tabs" class="nav nav-pills nav-stacked">
				<li data-toggle="pill">{{ link_to('#profile', 'User Settings') }}</li>
				@if($user->hasPermission('user', 'a'))
				<li data-toggle="pill">{{ link_to('#user-admin', 'User Administration') }}</li>
				@endif
				@if($user->hasPermission('bbs', 'a'))
				<li data-toggle="pill">{{ link_to('#bbs-admin', 'BBS Administration') }}</li>
				@endif
				@if($user->hasPermission('pages', 'a'))
				<li data-toggle="pill">{{ link_to('#page-admin', 'Page Administration') }}</li>
				@endif
			</ul>
		</div>
		<div class="col-md-10">
			<div class="tab-content">
				<div id="profile" class="tab-pane active">
					Maybe you wanna change yo password?
				</div>
				@if($user->hasPermission('user', 'a'))
				<div id="user-admin" class="tab-pane">
					<ul>
						<li>{{ link_to('admin/user/create', 'Create a new user') }}</li>
						<li>{{ link_to('admin/user/edit', 'Modify a user\'s permissions') }}</li>
						<li>{{ link_to('admin/user/delete', 'Delete a user') }}</li>
					</ul>
				</div>
				@endif
				@if($user->hasPermission('bbs', 'a'))
				<div id="bbs-admin" class="tab-pane">
					<ul>
						<li>{{ link_to('admin/bbs/create', 'Create a new board') }}</li>
						<li>{{ link_to('admin/bbs/delete', 'Delete a board') }}</li>
					</ul>
				</div>
				@endif
				@if($user->hasPermission('pages', 'a'))
				<div id="page-admin" class="tab-pane">
					<ul>
						<li>{{ link_to('admin/pages/edit', 'Edit a page on the website') }}</li>
					</ul>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@stop
