@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="tab-content" id="myTabContent">
                 <div class="tab-pane fade active in" role="tabpanel" id="single" aria-labelledby="single-tab">
                   <div class="panel-heading">Assaign Teacher</div>

                   <div class="panel-body">
                       <form class="form-horizontal" role="form" method="POST" action="#">
                           {{ csrf_field() }}

                           <div class="form-group{{ $errors->has('teachers') ? 'has-error' : ''}}">
                             <label for="" class="col-md-4 control-label">Assaign Role</label>
                             <div class="col-md-6">
                               <div class="dropdown">
                                 <button class="btn btn-default dropdown-toggle" type="button" id="teacher-dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                   Select Role
                                   <span class="caret"></span>
                                 </button>
                                 <ul class="dropdown-menu" aria-labelledby="teacher-dropdownMenu">
                                   <li class="dropdown-header">Roles</li>
                                   <li>
                                     <input id="class_teacher" name="teachers[]" value="Class Teacher" type="checkbox" class="dropdown-radio">
                                     <label for="class_teacher">Class Teacher</label>
                                   </li>
                                   <li>
                                     <input id="teachers" name="teachers[]" value="Teacher" type="checkbox" class="dropdown-radio">
                                     <label for="teachers">Teacher</label>
                                   </li>
                                 </ul>
                                 @if ($errors->has('teachers'))
                                     <span class="help-block">
                                         <strong>{{ $errors->first('teachers') }}</strong>
                                     </span>
                                 @endif
                               </div>
                             </div>
                           </div>

                           <div class="form-group{{ $errors->has('class') ? 'has-error' : ''}}">
                             <label for="" class="col-md-4 control-label">Assaign Class</label>
                             @include('teacher.partials._gradelist')
                           </div>

                           <div class="form-group{{ $errors->has('subject') ? 'has-error' : ''}}">
                             <label for="" class="col-md-4 control-label">Assaign Subject</label>
                             @include('teacher.partials._subjectlist')
                           </div>

                           <div class="form-group">
                               <div class="col-md-6 col-md-offset-4">
                                   <button type="submit" class="btn btn-primary">
                                       Add Records
                                   </button>
                               </div>
                           </div>
                       </form>
                   </div>
                 </div>
               </div>

            </div>
        </div>
    </div>
</div>
@endsection
