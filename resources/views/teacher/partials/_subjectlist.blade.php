<div class="col-md-6">
  <div class="dropdown col-md-6">
    <select class="form-control" placeholder="Select Subject">
      <option>Select Subject</option>
      <option>Mathematics</option>
      <option>English</option>
      <option>Kiswahili</option>
      <option>Science</option>
      <option>Arts</option>
      <option>Sports</option>
      <option>General Manner</option>
      <option>Vocational Skills</option>
      <option>Civics</option>
      <option>Geography</option>
      <option>History</option>
      <option>French</option>
      <option>Social Studies</option>
    </select>
    @if ($errors->has('subject'))
        <span class="help-block">
            <strong>{{ $errors->first('subject') }}</strong>
        </span>
    @endif
  </div>
  <div class="dropdown col-md-6">
    <a href="#" class="btn btn-link">+ Add Fields</a>
  </div>
</div>
