<select class="selectpicker" data-live-search="true" name="subjects" multiple title="Choose multiple subjects..."
data-selected-text-format="count > 3">
	@foreach (\App\Models\Subject::get() as $subject)
		<option value="{{ $subject->id }}" data-tokens="{{ $subject->name }}">{{ $subject->name }}</option>
	@endforeach
</select>
@if ($errors->has('subjects'))
	<span class="help-block">
		<strong>{{ $errors->first('subjects') }}</strong>
	</span>
@endif
