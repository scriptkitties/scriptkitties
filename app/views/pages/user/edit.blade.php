@extends('layout')

@section('script')
@parent
<script>
	$("#ue-tabs a").click(function(e) {
		e.preventDefault();
		$(this).tab("show");
	});
</script>
@stop

@section('main')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<ul id="ue-tabs"class="nav nav-tabs">
				<li data-toggle="tab">{{ link_to('#edit-settings', 'Edit main account settings') }}</li>
				<li data-toggle="tab">{{ link_to('#edit-prefs', 'Edit preferences') }}</li>
				<li data-toggle="tab">{{ link_to('#edit-p5p', 'Edit P5P settings') }}</li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			{{ Form::open() }}
				<div class="tab-content">
					<div id="edit-settings" class="tab-pane active">
						<div class="form-group">
							{{ Form::label('nickname', 'Nickname') }}
							{{ FOrm::text('nickname', $user->nickname, ['class' => 'form-control']) }}
						</div>
						<div class="form-group">
							{{ Form::label('email', 'Email address') }}
							{{ Form::text('email', $user->email, ['class' => 'form-control']) }}
						</div>
						<div class="form-group">
							{{ Form::label('website', 'Homepage') }}
							{{ Form::text('website', $user->website, ['class' => 'form-control']) }}
						</div>
						<br>
						<div class="form-group">
							{{ Form::label('newpass', 'New password') }}
							{{ Form::password('newpass', ['class' => 'form-control']) }}
						</div>
						<div class="form-group">
							{{ Form::label('newpass_confirm', 'Verify new password') }}
							{{ Form::password('newpass_confirm', ['class' => 'form-control']) }}
						</div>
					</div>
					<div id="edit-prefs" class="tab-pane">
						<table class="table">
							<tbody>
								<tr>
									<td>{{ Form::label('language', 'Preferred language') }}</td>
									<td>{{ Form::select('language', ['en'], 'en') }}</td>
								</tr>
								<tr>
									<td>{{ Form::label('theme', 'Theme') }}</td>
									<td>{{ Form::select('theme', $themes, $user->preferences->theme) }}
								<tr>
									<td>{{ Form::label('anonymize', 'Anonymize BBS posts by default') }}</td>
									<td>{{ Form::checkbox('anonymize', '1', $user->preferences->anonymize) }}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div id="edit-p5p" class="tab-pane">
						<p>Coming soon(tm)</p>
					</div>
					<hr>
					<div>
						<div class="form-group">
							{{ Form::label('password', 'Current password') }}
							{{ Form::password('password', ['class' => 'form-control']) }}
						</div>
						<div class="form-group">
							{{ Form::submit('Edit account', ['class' => 'btn btn-default']) }}
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@stop
