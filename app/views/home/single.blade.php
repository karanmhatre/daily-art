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
				<h3 class="date"> {{ date('d M, Y', strtotime($art->theme->date)) }} | <span class="theme">{{ $art->theme->theme }}</span> by <a href="{{ URL::route('user.profile', [$art->user->id, Str::slug($art->user->name)]) }}">{{ $art->user->name }}</a></h3>
			</div>
		</div>
		<div class="single-image">
				{{ HTML::image($art->image, $art->caption) }}
		</div>
    <div class="share">
    	<div class="row">
    		<div class="large-12 columns">
    			<a href="http://www.facebook.com/sharer.php?u={{URL::route('art.show', [$art->id])}}" target="_blank"><img src="http://www.simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" /></a>
    			<a href="http://twitter.com/share?url={{URL::route('art.show', [$art->id])}}&text=Daily Art by {{ $art->user->name }}&hashtags=dailyart, genii" target="_blank"><img src="http://www.simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" /></a>

    		</div>
    		<div class="large-12 columns">
    			<div class="fb-comments" data-href="{{URL::route('art.show', [$art->id])}}" data-numposts="5" data-colorscheme="light"></div>
    		</div>
    	</div>
    </div>
	</div>
@stop

@section('scripts')
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1523370727924834&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

@stop