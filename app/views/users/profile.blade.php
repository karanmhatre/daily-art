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
                <h3 class="profile-stats">{{ $user->current_streak }} <span>Current streak</span></h3>
                <h3 class="profile-stats">{{ $user->longest_streak }} <span>Longest streak</span></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="images_container split-row cf" data-columns>
			@foreach ($arts as $art)
        <div class="item">
          <div class="item-inner">
            <div class="grid">
              <figure class="effect-sadie">
                {{ HTML::image($art->image, $art->caption) }}
                <figcaption>
                  @if(!empty($art->caption))
                    <p>{{ $art->caption }}</p>
                  @endif
                  <a href="{{ URL::to('art', $art->id) }}">View more</a>
                </figcaption>
              </figure>
            </div>
            <div class="clearfix"></div>
            <div class="item-meta">
              <a href="{{ URL::route('theme.single', [$art->theme->id, Str::slug($art->theme->theme)]) }}" class="theme-meta">{{ $art->theme->theme }}</a>
              <div class="stat-meta">
                @if(Auth::check())
                  <a href="javascript:void(0);" data-id="{{ $art->id }}" data-likes="{{ $art->likes }}" class="like-btn heart {{ ((array_search(Auth::user()->id, $art->like_users()->lists('user_id')) !== false ) ? 'heart-filled' : 'heart-empty') }}"><i class="fa fa-heart"></i> <span class="likes-count">{{ $art->likes }}</span></a>
                @else
                  <a href="javascript:void(0);" class="heart heart-empty"><i class="fa fa-heart"></i> <span class="likes-count">{{ $art->likes }}</span></a>
                @endif
              </div>
            </div>
          </div>
        </div>
			@endforeach
  	</div>

    <!-- <div class="loader">
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
    </div> -->
@stop

@section('scripts')

	<script type="text/javascript">

    // $('.images_container').hide();

    // $(window).load(function() {

    //   $('.images_container').fadeIn();
    //   $('.loader').hide();

    //   $('.images_container').each(function() {

    //     $(this).masonry({
    //        itemSelector : '.item',
    //        "gutter" : 5
    //     });

    //   });
    // });

	</script>

@stop