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
    <h3 class="date"> Artwork by {{$user->name}} </h3>
  	<div class="images_container">
  		<ul>
  			@foreach ($arts as $art)
  				<li class="item">
  					<a class="single_image" href="{{ URL::route('art.show', $art->id) }}">
  						{{ HTML::image($art->image, $art->caption) }}
  					</a>
          </li>
  			@endforeach
  		</ul>
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