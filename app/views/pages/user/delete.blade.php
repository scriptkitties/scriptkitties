@extends('layout')

@section('main')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			{{ Form::open() }}
				<div class="form-group">
					<p>
						This deletes the user, his permissions and preferences. This action <strong>CAN NOT</strong> be
						undone. Be very careful with this feature. It's use will be logged, and improper use will lead
						to immediate removal of your account.
					</p>
					<div class="checkbox">
						<label>
							{{ Form::checkbox('delete', $user->id) }}
							I want to delete <strong>{{$user->nickname}}</strong>
						</label>
					</div>
					<div class="form-group pull-right">
						{{ Form::submit('Yes, I am sure', ['class' => 'btn btn-danger']) }}
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@stop
