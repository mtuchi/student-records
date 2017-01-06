<div class="col-md-8 form-inline">
  <select class="form-control" name="class[0]" placeholder="Select Class" required>
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
  <select class="form-control" name="class[1]" placeholder="Select Stream">
    <option value="">Select Stream</option>
    <option value="A">A</option>
    <option value="B">B</option>
  </select>
</div>
@if ($errors->has('class'))
		<span class="help-block">
				<strong>{{ $errors->first('class') }}</strong>
		</span>
@endif
