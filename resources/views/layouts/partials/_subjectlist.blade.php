<div class="col-md-8 form-inline">
  <select class="form-control" name="subject" placeholder="Select Subject" required>
    <option value="">Select Subject</option>
    <option value="Mathematics"> Mathematics</option>
    <option value="English">English</option>
    <option value="Kiswahili">Kiswahili</option>
    <option value="Science">Science</option>
    <option value="Arts">Arts</option>
    <option value="Sports">Sports</option>
    <option value="General Manner">General Manner</option>
    <option value="Vocational Skills">Vocational Skills</option>
    <option value="Civicd">Civics</option>
    <option value="Geography">Geography</option>
    <option value="History">History</option>
    <option value="French">French</option>
    <option value="Social Studies">Social Studies</option>
  </select>
  @if ($errors->has('subject'))
      <span class="help-block">
          <strong>{{ $errors->first('subject') }}</strong>
      </span>
  @endif
</div>
