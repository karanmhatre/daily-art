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
					<span class="number">{{ $user->getDaysSubmitted($user) }}</span> <span class="profile-text">submissions</span>
				</div>
				<h3 class="date"> Artwork by {{$user->name}} </h3>
			</div>
		</div>
		<div class="images_container">
			<ul>
				@foreach ($arts as $art)
					<li class="item">
						<a class="single_image" href="{{ URL::route('art.show', $art->id) }}">
							{{ HTML::image($art->image, $art->caption) }}
						</a>
						<a class="user_link" href="#"><span>{{ $art->theme->theme }}</span></a>
          </li>
				@endforeach
			</ul>
		</div>
		<div class="share">
    	<div class="row">
    		<div class="large-12 columns">
    			<a href="http://www.facebook.com/sharer.php?u={{URL::route('user.profile', [$user->id])}}" target="_blank"><img src="http://www.simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" /></a>
    			<a href="http://twitter.com/share?url={{URL::route('user.profile', [$user->id])}}&text={{ $art->user->name }}'s' Profile on Daily Art&hashtags=dailyart, genii" target="_blank"><img src="http://www.simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" /></a>

    		</div>
    		<div class="large-12 columns">
    			<div class="fb-comments" data-href="{{URL::route('user.profile', [$user->id])}}" data-numposts="5" data-colorscheme="light"></div>
    		</div>
    	</div>
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