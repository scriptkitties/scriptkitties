@extends('layout')

@section('script')
@parent
<script>
	// Activate the tabs
	$("#ue-tabs a").click(function(e) {
		e.preventDefault();
		$(this).tab("show");
	});

	// Force all password fields to start empty
	$("input[type=password]").val("");

	// Make the "Add another nick" button work
	$("#add_irc_nick").click(function() {
		// Add the new nick inputbox
		$("#add_irc_nick_before").before(" \
				<div class=\"input-group\"> \
					{{ str_replace('"', '\"', Form::text('irc_nick[]', '', ['class' => 'form-control'])) }} \
					<span class=\"input-group-addon remove-nick\">x</span> \
				</div> \
		");

		// Make the remove button work
		$(".remove-nick").click(function() {
			$(this).parent().remove();
		});
	});

	// Make the delete button work on IRC nicks
	$(".remove-nick").click(function() {
		$(this).parent().remove();
	});
</script>
@stop

@section('main')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<ul id="ue-tabs" class="nav nav-tabs">
				<li data-toggle="tab">{{ link_to('#edit-settings', 'Edit main account settings') }}</li>
				<li data-toggle="tab">{{ link_to('#edit-prefs', 'Edit preferences') }}</li>
				<li data-toggle="tab">{{ link_to('#edit-p5p', 'Edit P5P settings') }}</li>
				<li data-toggle="tab">{{ link_to('#edit-irc', 'Edit IRC nicknames') }}</li>
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
							{{ Form::label('newpass_confirmation', 'Verify new password') }}
							{{ Form::password('newpass_confirmation', ['class' => 'form-control']) }}
						</div>
					</div>
					<div id="edit-prefs" class="tab-pane">
						<h2>General preferences</h2>
						<div class="form-group">
							{{ Form::label('desktop', 'Link to desktop image') }}
							{{ Form::text('desktop', $user->preferences->desktop, ['class' => 'form-control']) }}
						</div>
						<h2>Website preferences</h2>
						<div class="form-group">
							{{ Form::label('language', 'Preferred language') }}
							{{ Form::select('language', ['en'], 'en') }}
						</div>
						<div class="from-group">
							{{ Form::label('theme', 'Theme') }}
							{{ Form::select('theme', $themes, $user->preferences->theme) }}
						</div>
						<div class="form-group">
							{{ Form::label('anonymize', 'Anonymize BBS posts by default') }}
							{{ Form::checkbox('anonymize', '1', $user->preferences->anonymize) }}
						</div>
						<h2>IRC preferences</h2>
						<div class="form-group">
							{{ Form::label('irc_join', 'Join message') }}
							{{ Form::text('irc_join', $user->preferences->irc_join, ['class' => 'form-control']) }}
						</div>
						<div class="form-group">
							{{ Form::label('irc_part', 'Leave message') }}
							{{ Form::text('irc_part', $user->preferences->irc_part, ['class' => 'form-control']) }}
						</div>
					</div>
					<div id="edit-p5p" class="tab-pane">
						<table class="table">
							<tbody>
								@foreach(UserP5p::$types as $token => $type)
								<tr>
									<td><abbr title="{{trans('p5p.'.$token)}}">{{$token}}</abbr></td>
									<td class="pull-right">
										@if($type == 'boolean')
										{{Form::checkbox('p5p['.$token.']', '1', $user->p5p->{$token})}}
										@endif
										@if($type == 'enum')
										{{Form::select('p5p['.$token.']', UserP5p::$enums[$token], $user->p5p->{$token})}}
										@endif
										@if($type == 'integer')
										{{Form::text('p5p['.$token.']', $user->p5p->{$token})}}
										@endif
										@if($type == 'string')
										{{Form::text('p5p['.$token.']', $user->p5p->{$token})}}
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div id="edit-irc" class="tab-pane">
						<div class="form-group">
							{{ Form::label('irc_nick[]', 'IRC Nicks') }}
							@if(count($user->irc_nicks) == 0)
							<div class="input-group col-md-9">
								{{ Form::text('irc_nick[]', '', ['class' => 'form-control']) }}
								<span class="input-group-addon remove-nick">x</span>
							</div>
							@endif
							@foreach($user->irc_nicks as $nick)
							<div class="input-group col-md-9">
								{{ Form::text('irc_nick[]', $nick->nick, ['class' => 'form-control']) }}
								<span class="input-group-addon remove-nick">x</span>
							</div>
							@if($nick->verified)
							<div class="col-md-3">
								Verified
							</div>
							@endif
							@endforeach
							<div id="add_irc_nick_before"></div>
						</div>
						<div class="form-group">
							<button id="add_irc_nick" class="btn btn-default" type="button">
								Add another nick
							</button>
						</div>
					</div>
					@if(!isset($adminMode) || !$adminMode)
					<hr>
					<div class="form-group">
						{{ Form::label('password', 'Current password') }}
						{{ Form::password('password', ['class' => 'form-control']) }}
					</div>
					@endif
					<div class="form-group">
						{{ Form::submit('Edit account', ['class' => 'btn btn-default']) }}
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@stop
