@extends('layouts.master')

@section('meta-tags')

  <meta name="description" content="Daily Art for {{ date('d M, Y', strtotime($art->theme->date)) }} on {{ $art->theme->name }}'s by {{ $art->user->name }}" />
  <meta name="keywords" content="{{ $art->theme }}, daily art" />

  <meta name="author" content="{{ $art->user->name }}" />


  <!-- for Facebook -->
  <meta property="og:title" content="'{{ $art->theme->theme }}' by {{ $art->user->name }}" />
  <meta property="og:type" content="article" />
  <meta property="og:image" content="{{ URL::asset($art->image) }}" />
  <meta property="og:url" content="{{URL::route('art.show', [$art->id])}}" />
  <meta property="og:description" content="Daily Art for {{ date('d M, Y', strtotime($art->theme->date)) }} on '{{ $art->theme->name }}' by {{ $art->user->name }}." />

  <!-- for Twitter -->
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:title" content="{{ $art->theme->theme }}'s by {{ $art->user->name }}" />
  <meta name="twitter:description" content="Here's my Daily Art submission for {{ $art->theme->name }}'. #dailyArt" />
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
      <div class="large-8 columns">
        <div class="single-image">
          {{ HTML::image($art->image, $art->caption) }}
          <div class="controls">
            @if(is_object($prev))
              <a class="prev-arrow-btn" href="{{ URL::to('art', $prev->id) }}"><i class="fa fa-chevron-left"></i></a>
            @endif
            @if(is_object($next))
              <a class="next-arrow-btn" href="{{ URL::to('art', $next->id) }}"><i class="fa fa-chevron-right"></i></a>
            @endif
          </div>
        </div>
      </div>
			<div class="large-4 columns">
        <div class="row">
          <div class="large-4 small-6 columns">
            @if(empty($art->user->avatar))
              <a href="{{ URL::route('user.profile', [$art->user->id, Str::slug($art->user->name)]) }}"><img src="{{ URL::asset('img/default-avatar.png') }}" alt="Default avatar" class="rounded"></a>
            @else
              <a href="{{ URL::route('user.profile', [$art->user->id, Str::slug($art->user->name)]) }}"><img src="{{ URL::asset($art->user->avatar) }}" alt="{{ $art->user->name }}" class="rounded"></a>
            @endif
          </div>
          <div class="large-8 small-6 columns image-details">
            <p><span class="theme">{{ $art->theme->theme }}</span> by <a href="{{ URL::route('user.profile', [$art->user->id, Str::slug($art->user->name)]) }}">{{ $art->user->name }}</a><br>
            {{ date('d M, Y', strtotime($art->theme->date)) }}
            </p>
          </div>
        </div>
        @if(!empty($art->caption))
          <div class="caption">
            <hr>
            <p>{{ $art->caption }}</p>
          </div>
        @endif
        <hr>
        <div class="image-stats">
          @if(Auth::check())
            <a href="javascript:void(0);" data-id="{{ $art->id }}" class ="like-btn {{ (($liked) ? 'heart-filled' : 'heart-empty') }}"><i class="fa fa-heart"></i> <span class="likes-count">{{ $art->likes }}</span></a>
          @else
            <a href="javascript:void(0);" data-id="{{ $art->id }}" class ="{{ (($liked) ? 'heart-filled' : 'heart-empty') }}"><i class="fa fa-heart"></i> <span class="likes-count">{{ $art->likes }}</span></a>
          @endif
        </div>
        <hr>
        <a class="facebook_share share_btn" href="http://www.facebook.com/sharer.php?u={{URL::route('art.show', [$art->id])}}" target="_blank">Facebook Share karo</a>
        <a class="twitter_share share_btn" href="http://twitter.com/share?url={{URL::route('art.show', [$art->id])}}&text=Daily Art submission by {{ $art->user->name }}&hashtags=dailyart, genii" target="_blank">Tweet karo</a>
			</div>
		</div>
	</div>
@stop

@section('scripts')
  <div id="fb-root"></div>
  <script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1523370727924834&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>

  <script>

  $(function() {
    $('.like-btn').click(function() {

      var $this = $(this),
          likes = parseInt($('.likes-count').html());

      if($this.hasClass('heart-empty'))
      {
        $.post("{{ URL::to('like') }}", { id :  $(this).data('id') }, function() {
          $this.removeClass('heart-empty').addClass('heart-filled');
          $('.likes-count').html(likes + 1);
        });
      }
      else
      {
        $.post("{{ URL::to('unlike') }}", { id :  $(this).data('id') }, function() {
          $this.removeClass('heart-filled').addClass('heart-empty');
          $('.likes-count').html(likes - 1);
        });
      }
    });
  });
  </script>
@stop
