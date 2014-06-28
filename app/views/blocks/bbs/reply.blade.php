<section class="content">
{{ Form::open(['files' => true]) }}
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('content', trans('bbs.'.$type.'.title', ['id' => @$id])) }}
					{{ Form::textarea('content', @$content, ['class' => 'form-control']) }}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-5">
				@if($type == 'edit')
				<div class="form-group">
					<div class="checkbox">
						<label>
							{{ Form::checkbox('img-update', '1', false, ['id' => 'img-update']) }}
							{{ Form::label('file', trans('bbs.edit.image')) }}
						</label>
						{{ Form::file('file', ['disabled']) }}
					</div>
				</div>
				@else
				<div class="form-group">
					{{ Form::label('file', trans('bbs.'.$type.'.image')) }}
					{{ Form::file('file') }}
				</div>
				@endif
			</div>
			<div class="col-sm-5">
				<div class="form-group">
					<div class="checkbox">
						<label>
							{{ trans('bbs.anonify') }}
							{{ Form::checkbox('anonify', '1', Auth::user()->preferences->anonymize && $type != 'edit') }}
						</label>
					</div>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					{{ Form::submit(trans('bbs.'.$type.'.submit'), ['class' => 'btn btn-default pull-right']) }}
				</div>
			</div>
		</div>
	</div>
{{ Form::close() }}
</section>
