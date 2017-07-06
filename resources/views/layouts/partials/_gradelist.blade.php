<select class="selectpicker" multiple name="class" title="Select Class and Stream">
	<optgroup label="Class" data-max-options="1">
		<option value="Pre">Pre</option>
		<option value="I">I</option>
		<option value="II">II</option>
		<option value="III">III</option>
		<option value="IV">IV</option>
		<option value="V">V</option>
		<option value="VI">VI</option>
		<option value="VII">VII</option>
	</optgroup>
	<optgroup label="Stream" data-max-options="1">
		<option>A</option>
		<option>B</option>
		<option>C</option>
		<option>D</option>
		<option>E</option>
		<option>F</option>
	</optgroup>
</select>
@if ($errors->has('class'))
	<span class="help-block">
			<strong>{{ $errors->first('class') }}</strong>
	</span>
@endif
