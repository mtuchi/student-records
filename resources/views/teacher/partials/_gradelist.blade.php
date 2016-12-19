<div class="col-md-6">
  <div class="dropdown col-md-6">
    <select class="form-control" placeholder="Select Class">
      <option>Select Class</option>
      <option>I</option>
      <option>II</option>
      <option>III</option>
      <option>IV</option>
      <option>V</option>
      <option>VI</option>
      <option>VII</option>
    </select>
    @if ($errors->has('class'))
        <span class="help-block">
            <strong>{{ $errors->first('class') }}</strong>
        </span>
    @endif
  </div>
  <div class="dropdown col-md-6">
    <select class="form-control" placeholder="Select Stream">
      <option>Select Stream</option>
      <option>A</option>
      <option>B</option>
      <option>C</option>
      <option>D</option>
    </select>
    @if ($errors->has('stream'))
        <span class="help-block">
            <strong>{{ $errors->first('stream') }}</strong>
        </span>
    @endif
  </div>
</div>
