@extends('layouts.master')

@section('content')

  <div class="image-bg">
    <div class="row">
      <div class="large-8 columns large-centered">
        <div class="row">
          <div class="large-4 columns">
            <div class="profile-picture-container">
              @if(empty($user->avatar))
                <img src="{{ URL::asset('img/default-avatar.png') }}" alt="Default avatar" class="profile-picture">
              @else
                <img src="{{ URL::asset($user->avatar) }}" alt="{{ $user->name }}" class="profile-picture"><br>
              @endif
            </div>
          </div>
          <div class="large-8 columns">
            <h4 class="profile-name">{{ $user->name }}</h4>
            <div>
              <h3 class="profile-stats">5 <span>Current streak</span></h3>
              <h3 class="profile-stats">20 <span>Longest streak</span></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
	<div class="marginTop">
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
          <div class="small-10 large-centered columns">
            <div class="row">
              <div class="small-3 columns">
              </div>
              <div class="small-9 columns">
                <input type="submit" class="button" value="Update"><br>
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