<div class="col-md-8 form-inline">
  <select class="form-control" name="subject" placeholder="Select Subject" required>
    <option value="">Select Subject</option>
		@foreach (\App\Models\Subject::get() as $subject)
			<option value="{{ $subject->name }}">{{ $subject->name }}</option>
		@endforeach
  </select>
  @if ($errors->has('subject'))
      <span class="help-block">
          <strong>{{ $errors->first('subject') }}</strong>
      </span>
  @endif
</div>
