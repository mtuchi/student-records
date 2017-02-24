<div class="col-md-6 form-inline">
	<div class="col-md-6"  style="padding-left:0;">
		<select class="form-control col-md-12" name="class[0]" placeholder="Select Class" required>
			<option value="">Select Class</option>
			<option value="Pre">Pre</option>
			<option value="I">I</option>
			<option value="II">II</option>
			<option value="III">III</option>
			<option value="IV">IV</option>
			<option value="V">V</option>
			<option value="VI">VI</option>
			<option value="VII">VII</option>
		</select>
	</div>
  <div class="col-md-6">
		<select class="form-control col-md-12" name="class[1]" placeholder="Select Stream">
			<option value="">Select Stream</option>
			<option value="A">A</option>
			<option value="B">B</option>
		</select>
  </div>
</div>
@if ($errors->has('class'))
		<span class="help-block">
				<strong>{{ $errors->first('class') }}</strong>
		</span>
@endif
