@extends('layouts.master')

@section('content')

  @if(count($theme->art))
    <div class="day_container">
      <div class="row">
        <div class="large-12 columns">
          <h3 class="date"> {{ date('d M, Y', strtotime($theme->date)) }} | <span class="theme">{{ $theme->theme }}</span></h3>
        </div>
      </div>

      <div class="images_container split-row cf" data-columns>
        @foreach ($theme->art()->orderBy('likes', 'DESC')->get() as $art)
          <div class="item">
            <div class="item-inner">
              <div class="grid">
                <figure class="effect-sadie">
                  {{ HTML::image($art->image, $art->caption) }}
                  @if(!empty($art->caption))
                    <figcaption>
                      <p>{{ $art->caption }}</p>
                    </figcaption>
                  @endif
                  <a href="{{ URL::to('art', $art->id) }}">View more</a>
                </figure>
              </div>
              <div class="clearfix"></div>
              <div class="item-meta">
                @if(empty($art->user->avatar))
                  <img src="{{ URL::asset('img/default-avatar.png') }}" alt="Default avatar">
                @else
                  <img src="{{ URL::asset($art->user->avatar) }}" alt="{{ $art->user->name }}">
                @endif
                <a class="author-name" href="{{ URL::route('user.profile', [$art->user->id, Str::slug($art->user->name)]) }}">{{ $art->user->name }}</a>

                <div class="stat-meta">
                  @if(Auth::check())
                    <a href="javascript:void(0);" data-id="{{ $art->id }}" data-likes="{{ $art->likes }}" class="like-btn heart {{ ((array_search(Auth::user()->id, $art->like_users()->lists('user_id')) !== false ) ? 'heart-filled' : 'heart-empty') }}"><i class="fa fa-heart"></i> <span class="likes-count">{{ $art->likes }}</span></a>
                    <a href="javascript:void(0);" class="comment"><i class="fa fa-comment"></i> <span class="likes-count">{{ $art->comments()->count() }}</span></a>
                  @else
                    <a href="javascript:void(0);" class="heart heart-empty"><i class="fa fa-heart"></i> <span class="likes-count">{{ $art->likes }}</span></a>
                    <a href="javascript:void(0);" class="comment"><i class="fa fa-comment"></i> <span class="likes-count">{{ $art->comments()->count() }}</span></a>
                  @endif
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @endif
@stop

@section('scripts')

@stop