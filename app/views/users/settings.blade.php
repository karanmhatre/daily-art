@extends('layouts.master')

@section('content')
	
 @if(Session::has('notice'))
    <div class="alert-box danger">
      {{ Session::get('notice') }}
    </div>
  @endif
	<div class="day_container">
		<div class="row">
			<div class="large-12 columns">
				<div class="profile-div">
					<span class="number">{{ $user->getDaysBunked($user) }}</span> <span class="profile-text">days bunked</span>
					<img src="{{ URL::asset($user->avatar) }}" alt="" class="profile-picture">
					<span class="number">3</span> <span class="profile-text">submissions</span>
				</div>
				<h3 class="date"> {{$user->name}}'s Profile </h3>
			</div>
		</div>
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