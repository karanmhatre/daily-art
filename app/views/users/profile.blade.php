@extends('layouts.master')

@section('content')

 @if(Session::has('notice'))
    <div class="alert-box danger">
      {{ Session::get('notice') }}
    </div>
  @endif
  	<div class="profile-container">
      <div class="image-bg">
        <img src="{{ URL::asset($arts_array[$random]['image']) }}" alt="">
      </div>
      <div class="profile-inner-box">
        <div class="profile-picture-container">
          @if(empty($user->avatar))
            <img src="{{ URL::asset('img/default-avatar.png') }}" alt="Default avatar" class="profile-picture">
          @else
            <img src="{{ URL::asset($user->avatar) }}" alt="{{ $user->name }}" class="profile-picture"><br>
          @endif
        </div>
        <div class="profile-stats">
          <div class="profile-name">
            <h4>{{ $user->name }}</h4>
            @if(Auth::check())
              @if(Auth::user()->id == $user->id)
                <p class="profile-date"><a href="{{ URL::route('users.edit.profile', Auth::user()->id) }}">Edit Profile</a></p>
              @else
                <p class="profile-date">Joined {{ date('d M, Y', strtotime($user->created_at)) }}</p>
              @endif
            @endif
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
            <div class="item-inner">
              <a class="single_image swipebox" href="{{ URL::to('art', $art->id) }}">
                {{ HTML::image($art->image, $art->caption, ['title' => ''] ) }}
              </a>
              <a class="item-meta" href="#">
                {{ $art->theme->theme }}
              </a>
            </div>
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