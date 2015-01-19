@extends('layouts.master')

@section('content')

 @if(Session::has('notice'))
    <div class="alert-box danger">
      {{ Session::get('notice') }}
    </div>
  @endif
  <div class="profile-container">
    <div class="profile-inner-box">
      <div class="profile-picture-container">
        @if(empty($user->avatar))
          <img src="{{ URL::asset('img/default-avatar.png') }}" alt="Default avatar" class="profile-picture">
        @else
          <img src="{{ URL::asset($user->avatar) }}" alt="{{ $user->name }}" class="profile-picture"><br>
          <a href="">Edit Profile</a>
        @endif
      </div>
      <div class="profile-stats">
        <div class="profile-name">
          <h4>{{ $user->name }}</h4>
          <p class="profile-date">Joined {{ date('d M, Y', strtotime($user->created_at)) }}</p>
        </div>
        <div class="profile-numbers">
          <div class="profile-single-number">{{ $user->getDaysSubmitted($user) }}<br><span class="stat-meta">Arts</span></div>
          <div class="profile-single-number">{{ $user->getDaysBunked($user) }}<br><span class="stat-meta">Bunks</span></div>
        </div>
      </div>
    </div>
  </div>
	<div class="day_container">
		<div class="row">
			<div class="large-12 columns">
				{{ Form::open(array('route' => ['user.update', $user->id],'files' => 'true')) }}
          <div class="small-10 large-centered columns">
            <div class="row">
              <div class="small-3 columns">
                <label for="right-label" class="right inline">Name</label>
              </div>
              <div class="small-9 columns">
                <input type="text" id="right-label" placeholder="Name" name="name" value="{{ $user->name }}" required>
              </div>
            </div>
          </div>
          <div class="small-10 large-centered columns">
            <div class="row">
              <div class="small-3 columns">
                <label for="right-label" class="right inline">Avatar</label>
              </div>
              <div class="small-9 columns">
                <input type="file" name="avatar" >
              </div>
            </div>
          </div>
          <div class="small-10 large-centered columns">
            <div class="row">
              <div class="small-3 columns">
                <label for="password" class="right inline">Password</label>
              </div>
              <div class="small-9 columns">
                <input type="password" id="password" name="password">
              </div>
            </div>
          </div>
          <div class="small-10 large-centered columns" style="text-align:center">
            <div class="row">
              <div class="small-3 columns">
              </div>
              <div class="small-12 columns">
                <input type="submit" class="button" value="Update"><br>
                <p>Todays topic “<b>{{ $theme }}</b>”.</p>
              </div>
            </div>
          </div>
        {{ Form::close() }}
			</div>
		</div>
  </div>
@stop

@section('scripts')

	<script type="text/javascript">
		$(window).load(function() {
	    $('.images_container').each(function() {
				$(this).masonry({
				  itemSelector: '.item',
				  "gutter": 5
				});
			});
		});

	</script>

@stop