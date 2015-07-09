@extends('layouts.master')

@section('content')
  <div class="todays-topic">
    @if(Auth::guest())
      <div class="streak-meter">
        <p>The idea behind Daily Art is to make something around a daily theme. Be it a sketch, graphic design, photograph, origami, or even a dance interpretation. We want you to get creative! <a href="{{ URL::to('request/invite') }}">Request an invite.</a>
        </p>
      </div>
    @else
      <div class="streak-meter">
        <div class="labels">
          <p>Current streak - {{ Auth::user()->current_streak }}/30</p>
          <p>Longest streak - {{ Auth::user()->longest_streak }}</p>
        </div>
        <div class="progress-bar">
          <div class="filled" style="width: {{ (Auth::user()->current_streak/30)*100 }}%;"></div>
        </div>
      </div>
    @endif
  </div>

  <div class="member-search-container">
    <i class="fa fa-search"></i>
    <input type="text" class="member-search" placeholder="Search for an old theme">
  </div>

  <div class="day_container hide" id="suggest_topic">
    <div class="row">
      <div class="large-8 columns large-centered text-center">
        <p>This topic doesn't exist. <a href="{{ URL::route('suggestions.new') }}" data-link="{{ URL::route('suggestions.new') }}" id="suggest_link">Would you like to suggest "<span id="search_topic"></span>" as a topic?</a></p>
      </div>
    </div>
  </div>

  @foreach ($themes as $index => $theme)
    <div class="theme-list-item" data-theme="{{ $theme->theme }}">
      @if(count($theme->art))
        <div class="day_container">
          <h3 class="date"><span class="theme">{{ $theme->theme }}</span> - {{ date('d M, Y', strtotime($theme->date)) }}</h3>

          <div class="images_container split-row cf" data-columns>
            @foreach ($theme->art()->orderBy('likes', 'DESC')->take(2)->get() as $art)
              <div class="item item-small">
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
            <div class="item item-small">
              <div class="item-inner">
                <div class="grid">
                  <a href="{{ URL::route('theme.single', [$theme->id, Str::slug($theme->theme)]) }}" class="view-all-btn">View {{ $theme->art->count() - 2 }} more artworks for "{{ $theme->theme }}" &rarr;</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif
    </div>
  @endforeach
@stop

@section('scripts')
  <script>

    function topicNotFound(q) {

      $('#search_topic').html(q);
      $('#suggest_topic').show();

      var link = $('#suggest_link').data('link');
      $('#suggest_link').attr('href', link + "?q=" + q);
    }

    $(function() {
      var search_flag = 0;
      $('.member-search').keyup(function() {
        var q = $(this).val().toLowerCase();

        if(q.trim() != '') {
          $('.theme-list-item').each(function() {
            var s = $(this).data('theme').toLowerCase();
            if(s.indexOf(q) == -1)
              $(this).fadeOut();
            else {
              $(this).fadeIn();
              search_flag = 1;
            }
          });

          if(!search_flag)
            topicNotFound(q);
          else {
            $('#suggest_topic').hide();
          }
        }
        else {
          $('.theme-list-item').fadeIn();
          $('#suggest_topic').hide();
        }

        search_flag = 0;

      });
    });
  </script>
@stop