@foreach ($user->grade as $grade)
	<div id="collapse{{ str_slug($grade->slug) }}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{ str_slug($grade->slug) }}">
		<div class="panel-body">
			<form class="form-horizontal" role="form" method="post" action="{{ route('assignclass.update', $user->id) }}">
				{{ csrf_field() }}

				<div class="form-group {{ $errors->has('class') ? 'has-error' : ''}}">
					<label for="assignclassteacher" class="col-md-4 control-label">Change Class</label>
					<div class="col-md-8 form-inline">
					  <select class="form-control" name="class[0]" placeholder="Select Class" required>
							<option value="Pre" {{ $grade == "Pre" ? 'selected' : '' }}>Pre</option>
					    <option value="I" {{ $grade->name == "I" ? 'selected' : '' }}>I</option>
					    <option value="II" {{ $grade->name == "II" ? 'selected' : '' }}>II</option>
					    <option value="III" {{ $grade->name == "III" ? 'selected' : '' }}>III</option>
					    <option value="IV" {{ $grade->name == "IV" ? 'selected' : '' }}>IV</option>
					    <option value="V" {{ $grade->name == "V" ? 'selected' : '' }}>V</option>
					    <option value="VI" {{ $grade->name == "VI" ? 'selected' : '' }}>VI</option>
					    <option value="VII" {{ $grade->name == "VII" ? 'selected' : '' }}>VII</option>
					  </select>

					  <select class="form-control" name="class[1]" placeholder="Select Stream">
					    <option value="">Select Stream</option>
					    <option value="A" {{ $grade->stream == "A" ? 'selected' : '' }}>A</option>
					    <option value="B" {{ $grade->stream == "B" ? 'selected' : '' }}>B</option>
					  </select>
					</div>
					@if ($errors->has('class'))
							<span class="help-block">
									<strong>{{ $errors->first('class') }}</strong>
							</span>
					@endif
				</div>

				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<button type="submit" class="btn btn-primary btn-block">
							Save Records
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endforeach
