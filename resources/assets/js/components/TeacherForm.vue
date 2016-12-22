<template>
<div class="container">
	<div class="row">
		<div class="col-md-8 col-xs-12 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
          <div class="row">
            <h4 class="col-md-8 text-center text-uppercase text-muted">Add Teacher Records</h4>
            <div class="col-md-4">
              <div class="btn-group pull-right" role="group">
                <a href="#" class="btn btn-primary">Use Excel</a>
                <a href="#" class="btn btn-default">Go Back</a>
              </div>
            </div>
          </div>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" v-on:submit.prevent="addTeacher">
						<div class="form-group" v-bind:class="{'has-error' : errors.name}">
							<label for="name" class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input id="name" type="text" class="form-control" name="name" v-model="name" required autofocus>
								<span v-if="errors.name" class="help-block">
										<strong v-for="nameErrors in errors.name">{{ nameErrors }}</strong>
								</span>
							</div>
						</div>
						<div class="form-group">
							<label for="gender" class="col-md-4 control-label">Gender</label>
							<div class="col-md-6">
								<select class="form-control" v-model="gender">
									<option value="m">Male</option>
									<option value="f">Female</option>
								</select>
							</div>
						</div>
						<div class="form-group" v-bind:class="{'has-error' : errors.dob}">
							<label for="gender" class="col-md-4 control-label">Date Of Birth</label>
							<div class="col-md-6">
								<input type="date" class="form-control" v-model="dob" required>
								<span v-if="errors.dob" class="help-block">
										<strong v-for="dobErrors in errors.dob">{{ dobErrors }}</strong>
								</span>
							</div>
						</div>
						<div class="form-group" v-bind:class="{'has-error' : errors.phone}">
							<label for="gender" class="col-md-4 control-label">Phone number</label>
							<div class="col-md-6">
								<input type="tel" name="phone" class="form-control" v-model="phone" required>
								<span v-if="errors.phone" class="help-block">
										<strong v-for="phoneErrors in errors.phone">{{ phoneErrors }}</strong>

								</span>
							</div>
						</div>
						<div class="form-group" v-bind:class="{'has-error' : errors.email}">
							<label for="email" class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input id="email" type="email" class="form-control" name="email" v-model="email" required>
								<span v-if="errors.email" class="help-block">
										<strong v-for="emailError in errors.email">{{ emailError }}</strong>

								</span>
							</div>
						</div>
						<div class="form-group" v-bind:class="{'has-error' : errors.password}">
							<label for="password" class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input id="password" type="password" class="form-control" v-model="password" required>
								<span v-if="errors.password" class="help-block">
									<strong v-for="passwordError in errors.password">{{ passwordError }}</strong>
								</span>
							</div>
						</div>
						<div class="form-group" v-bind:class="{'has-error' : errors.password_confirmation}">
							<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input id="password-confirm" type="password" class="form-control" v-model="password_confirmation" required>
								<span v-if="errors.password_confirmation" class="help-block">
										<strong v-for="password_confirmationError in errors.password_confirmation">{{ password_confirmationError }}</strong>
								</span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Add Records</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
    <div class="col-xs-6 col-md-4 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					School Management Section
				</div>
				<div class="panel-body">
					<div class="boxed-group-inner">
						<ul class="mini-class-list js-class-list">
							<li><a href="">Teachers</a></li>
							<li><a href="">Students</a></li>
							<li><a href="">Grades</a></li>
							<li><a href="">Subjects</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</template>
<script>
    export default {
        mounted() {
            console.log('Component ready.')
        },
        data() {
          return {
            name: null,
            gender: 'm',
            dob: null,
            phone: null,
            email: null,
            password: null,
						password_confirmation: null
						errors:[]
          }
        },
        methods: {
          addTeacher(){
            return this.$http.post('/addteacher',{
              name: this.name,
              gender: this.gender,
              DOB: this.dob,
              phone: this.phone,
              email: this.email,
              password: this.password
            }).then(function(response) {
						    console.log(response.data);
						}, function (response) {
								if (response.status == 422) {
									this.errors = response.data
								}
						});
          }
        }
    }
</script>
