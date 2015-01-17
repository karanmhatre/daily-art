@extends('layouts.master')

@section('meta-tags')
<title></title>
<meta name="description" content="Daily Art for {{ date('d M, Y', strtotime($art->theme->date)) }} on {{ $art->theme->name }}'s by {{ $art->user->name }}" />
<meta name="keywords" content="{{ $art->theme }}, daily art" />

<meta name="author" content="{{ $art->user->name }}" />


<!-- for Facebook -->
<meta property="og:title" content="{{ $art->theme->theme }}'s by {{ $art->user->name }}" />
<meta property="og:type" content="article" />
<meta property="og:image" content="{{ URL::asset($art->image) }}" />
<meta property="og:url" content="{{URL::route('art.show', [$art->id])}}" />
<meta property="og:description" content="Daily Art for {{ date('d M, Y', strtotime($art->theme->date)) }} on {{ $art->theme->name }}'s by {{ $art->user->name }}." />

<!-- for Twitter -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="{{ $art->theme->theme }}'s by {{ $art->user->name }}" />
<meta name="twitter:description" content="Daily Art for {{ date('d M, Y', strtotime($art->theme->date)) }} on {{ $art->theme->name }}'s by {{ $art->user->name }}." />
<meta name="twitter:image" content="{{ URL::asset($art->image) }}" />
@stop

@section('content')

 @if(Session::has('notice'))
    <div class="alert-box danger">
      {{ Session::get('notice') }}
    </div>
  @endif

	<div class="day_container">
		<div class="row">
      <div class="large-9 columns">
        <div class="single-image">
          {{ HTML::image($art->image, $art->caption) }}
        </div>
      </div>
			<div class="large-3 columns">
        <div class="row">
          <div class="large-4 small-6 columns">
            @if(empty($art->user->avatar))
              <a href="{{ URL::route('user.profile', [$art->user->id, Str::slug($art->user->name)]) }}"><img src="{{ URL::asset('img/default-avatar.png') }}" alt="Default avatar" class="rounded"></a>
            @else
              <a href="{{ URL::route('user.profile', [$art->user->id, Str::slug($art->user->name)]) }}"><img src="{{ URL::asset($art->user->avatar) }}" alt="{{ $art->user->name }}" class="rounded"></a>
            @endif
          </div>
          <div class="large-8 small-6 columns">
            <p><span class="theme">{{ $art->theme->theme }}</span> by <a href="{{ URL::route('user.profile', [$art->user->id, Str::slug($art->user->name)]) }}">{{ $art->user->name }}</a><br>
            {{ date('d M, Y', strtotime($art->theme->date)) }}
            </p>
          </div>
        </div>
        <hr>
        <a class="facebook_share share_btn" href="http://www.facebook.com/sharer.php?u={{URL::route('art.show', [$art->id])}}" target="_blank">Facebook Share karo</a>
        <a class="twitter_share share_btn" href="http://twitter.com/share?url={{URL::route('art.show', [$art->id])}}&text=Daily Art by {{ $art->user->name }}&hashtags=dailyart, genii" target="_blank">Tweet karo</a>

        <div class="row">
          <div class="large-12 columns">
            <hr>
            <h5>More of "{{ $art->theme->theme }}"</h5>
          </div>
          <div class="large-6 small-6 columns">
            @if(is_object($prev))
              <a href="{{ URL::to('art', $prev->id) }}" class="paginate-btn">
                <img src="{{ URL::asset($prev->image) }}" alt="">
                <div class="hover_arrow"><i class="fa fa-chevron-left"></i></div>
              </a>
            @else
              <img src="{{ URL::asset('img/blank.png') }}" alt="">
            @endif
          </div>
          <div class="large-6 small-6 columns">
            @if(is_object($next))
              <a href="{{ URL::to('art', $next->id) }}" class="paginate-btn">
                <img src="{{ URL::asset($next->image) }}" alt="">
                <div class="hover_arrow"><i class="fa fa-chevron-right"></i></div>
              </a>
            @else
              <img src="{{ URL::asset('img/blank.png') }}" alt="">
            @endif
          </div>
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