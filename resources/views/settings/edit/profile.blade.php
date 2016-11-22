<div class="col-sm-3 pull-right">
  <a id="" href="#" class="button pull-right button-link" data-toggle="modal" data-target="#editProfileModal">Edit Profile</a>
</div>
<!-- Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Edit your profile</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form" method="POST" action="">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Name</label>

                <div class="col-sm-10 col-md-6">
                  <p class="form-control-static">Full Name</p>
                </div>
            </div>

            <div class="form-group">
              <label for="username" class="col-sm-2 col-md-4 control-label">Username</label>

              <div class="col-sm-10 col-md-6">
                <input type="text" class="form-control" id="username" placeholder="Username">
              </div>

            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary btn-block">
                        Update profile
                    </button>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer hidden">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
