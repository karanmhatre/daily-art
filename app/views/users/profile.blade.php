@extends('layouts.master')

@section('content')

 @if(Session::has('notice'))
    <div class="alert-box danger">
      {{ Session::get('notice') }}
    </div>
  @endif
  	<div class="profile-container">
      <div class="image-bg">
        @if($arts_array)
          <img src="{{ URL::asset($arts_array[$random]['image']) }}" alt="">
        @endif
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
              <a class="item-image-container" href="{{ URL::to('art', $art->id) }}">
                @if(!empty($art->caption))
                  <div class="item-caption">
                    <p>{{ $art->caption }}</p>
                  </div>
                @endif
                {{ HTML::image($art->image, $art->caption) }}
              </a>

              <div class="item-meta">
                <a href="#" class="theme-meta">{{ $art->theme->theme }}</a>

                @if(Auth::check())
                  <a href="javascript:void(0);" data-id="{{ $art->id }}" data-likes="{{ $art->likes }}" class="like-btn heart {{ ((array_search(Auth::user()->id, $art->like_users()->lists('user_id')) !== false ) ? 'heart-filled' : 'heart-empty') }}"><i class="fa fa-heart"></i> <span class="likes-count">{{ $art->likes }}</span></a>
                @else
                  <a href="javascript:void(0);" class="heart heart-empty"><i class="fa fa-heart"></i> <span class="likes-count">{{ $art->likes }}</span></a>
                @endif

              </div>
            </div>
          </li>
  			@endforeach
  		</ul>
  	</div>
    <div class="loader">
      <div class="cube">
        <div class="plane-1">
          <div class="top-left"></div>
          <div class="top-middle"></div>
          <div class="top-right"></div>
          <div class="middle-left"></div>
          <div class="middle-middle"></div>
          <div class="middle-right"></div>
          <div class="bottom-left"></div>
          <div class="bottom-middle"></div>
          <div class="bottom-right"></div>
        </div>
        <div class="plane-2">
          <div class="top-left"></div>
          <div class="top-middle"></div>
          <div class="top-right"></div>
          <div class="middle-left"></div>
          <div class="middle-middle"></div>
          <div class="middle-right"></div>
          <div class="bottom-left"></div>
          <div class="bottom-middle"></div>
          <div class="bottom-right"></div>
        </div>
        <div class="plane-3">
          <div class="top-left"></div>
          <div class="top-middle"></div>
          <div class="top-right"></div>
          <div class="middle-left"></div>
          <div class="middle-middle"></div>
          <div class="middle-right"></div>
          <div class="bottom-left"></div>
          <div class="bottom-middle"></div>
          <div class="bottom-right"></div>
        </div>
      </div>
    </div>
@stop

@section('scripts')

	<script type="text/javascript">

    $('.images_container').hide();

    $(window).load(function() {

      $('.images_container').fadeIn();
      $('.loader').hide();

      $('.images_container').each(function() {

        $(this).masonry({
           itemSelector : '.item',
           "gutter" : 5
        });

      });
    });

	</script>

@stop