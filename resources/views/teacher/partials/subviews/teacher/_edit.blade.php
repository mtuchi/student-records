<div class="panel-body">
	<form class="form-horizontal" role="form" method="POST" action="{{ route('assignteacher.update', $user->id) }}">
		{{ csrf_field() }}
		<div class="form-group{{ $errors->has('subject') ? 'has-error' : ''}}">
			<label for="teacher_subject" class="col-md-4 control-label">Change Subject</label>
			<div class="col-md-8 form-inline">
			  <select class="form-control" name="subject" placeholder="Select Subject" required>
			    <option value="">Select Subject</option>
						@foreach ($teacher->grade[0]->subject as $subject)
							<option value="{{ $subject->name }}" {{ $teacher->subject->name == "$subject->name" ? 'selected' : '' }}>{{ $subject->name }}</option>
						@endforeach
			  </select>
			  @if ($errors->has('subject'))
			      <span class="help-block">
			          <strong>{{ $errors->first('subject') }}</strong>
			      </span>
			  @endif
			</div>

		</div>

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4 col-sm-offset-2 col-sm-10">
				<input type="hidden" name="update" value="{{ $teacher->slug }}">
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				<button type="submit" class="btn btn-primary btn-block">
					Save Changes
				</button>
			</div>
		</div>
	</form>
</div>
