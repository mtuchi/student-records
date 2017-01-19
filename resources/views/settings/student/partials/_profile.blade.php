<div class="user-profile">
	<div class="user-profile-sticky-bar js-user-profile-sticky-bar hidden">
		<div class="user-profile-mini-vcard d-table">
			<span class="user-profile-mini-avatar d-table-cell center-block hidden">
				{{-- <img alt="" class="img-rounded" src="{{ $student->avatar(['size' => 64])}}" width="32" height="32"> --}}
			</span>
			<span class="d-table-cell v-align-middle lh-condensed js-user-profile-following-mini-toggle">
				<strong>{{ $student->name }}</strong>
			</span>
		</div>
	</div>
	<a href="#" aria-label="Change your avatar" class="card-avatar show tooltipped tooltipped-s hidden">
		{{-- <img alt="" class="avatar width-full img-circle" src="{{ $student->avatar(['size' =>460]) }}" width="150" height="150"> --}}
	</a>
	<div class="card-names-container js-user-profile-sticky-fields is-placeholder"></div>
	<div class="card-names-container" >
		<h2 class="card-names">
			<span class="card-fullname show">{{ $student->name }}</span>
		</h2>
	</div>
	<div class="user-profile-bio">
		<div class="text-muted">
			<a href="#" class="">Edit profile bio</a>
		</div>
	</div>

	<dl class="card-details border-gray-light">
		<dd aria-label="Organization" class="card-detail">
			<img src="/build/svg/organization.svg"></img>
			<span class="fa fa-gender"></span>
			@if (count($student->gender))
				@if ($student->gender == "m")
					{{ "Male" }}
				@else
					{{ "Female" }}
				@endif
			@endif
		</dd>

		<dd aria-label="Member since" class="card-detail">
			<img src="/build/svg/clock.svg"></img>
			<span class="join-label">Joined on </span>
			<local-time class="join-date" datetime="2014-02-05T08:13:14Z" day="numeric" month="short" year="numeric" title="5 Feb 2014 11:13 GMT +3">{{ $student->joined() }}</local-time>
		</dd>
	</dl>

	<div class="border-top clearfix">
		<h2 class="mb-1 h4">Grade</h2>
			<a href="{{ config('app.url') }}" aria-label="{{ config('app.name') }}" class="tooltipped tooltipped-n avatar-group-item" itemprop="follows">
				<img alt="@{{ config('app.name') }}" class="avatar img-circle" src="{{ $student->avatar(['size'=> 35,'image' => 'retro']) }}" width="35" height="35">
			</a>
	</div>
</div>
