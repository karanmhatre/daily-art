@extends('layouts.master')

@section('meta-tags')

  <meta name="description" content="Daily Art for {{ date('d M, Y', strtotime($art->theme->date)) }} on {{ $art->theme->name }}'s by {{ $art->user->name }}" />
  <meta name="keywords" content="{{ $art->theme }}, daily art" />

  <meta name="author" content="{{ $art->user->name }}" />


  <!-- for Facebook -->
  <meta property="og:title" content="'Daily Art for {{ date('d M, Y', strtotime($art->theme->date)) }} on '{{ $art->theme->name }}' by {{ $art->user->name }}." />
  <meta property="og:type" content="article" />
  <meta property="og:image" content="{{ URL::asset($art->image) }}" />
  <meta property="og:url" content="{{URL::route('art.show', [$art->id])}}" />
  <meta property="og:description" content="{{ $art->caption }}" />

  <!-- for Twitter -->
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:title" content="{{ $art->theme->theme }}'s by {{ $art->user->name }}" />
  <meta name="twitter:description" content="Here's my Daily Art submission for {{ $art->theme->name }}. #dailyArt" />
  <meta name="twitter:image" content="{{ URL::asset($art->image) }}" />
@stop

@section('content')

 @if(Session::has('notice'))
    <div class="alert-box danger">
      {{ Session::get('notice') }}
    </div>
  @endif

	<div class="margin-top">
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
        <div class="user-info">
          <div class="row">
            <div class="large-4 small-3 columns">
              @if(empty($art->user->avatar))
                <a href="{{ URL::route('user.profile', [$art->user->id, Str::slug($art->user->name)]) }}"><img src="{{ URL::asset('img/default-avatar.png') }}" alt="Default avatar" class="rounded"></a>
              @else
                <a href="{{ URL::route('user.profile', [$art->user->id, Str::slug($art->user->name)]) }}"><img src="{{ URL::asset($art->user->avatar) }}" alt="{{ $art->user->name }}" class="rounded"></a>
              @endif
            </div>
            <div class="large-8 small-9 columns image-details">
              <p><span class="theme">{{ $art->theme->theme }}</span> by <a href="{{ URL::route('user.profile', [$art->user->id, Str::slug($art->user->name)]) }}">{{ $art->user->name }}</a><br>
              {{ date('d M, Y', strtotime($art->theme->date)) }}
              </p>
            </div>
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
          @if(count($post_liked_by_users_liked))
            <div class="liked_users">
              <p>Liked by {{ $post_liked_by_users_liked }}</p>
            </div>
          @endif
        </div>
        <hr>
        <a class="facebook_share share_btn" href="http://www.facebook.com/sharer.php?u={{URL::route('art.show', [$art->id])}}" target="_blank">Facebook Share karo</a>
        <a class="twitter_share share_btn" href="http://twitter.com/share?url={{URL::route('art.show', [$art->id])}}&text=Daily Art submission by {{ $art->user->name }}&hashtags=dailyart, genii" target="_blank">Tweet karo</a>
			</div>
		</div>
    <div class="comment-bg" id="comments">
      <div class="row">
        <div class="large-8 small-12 columns">
          <div class="comments-container hide-on-mobile">
            <h1>Comments</h1>
            @if(!count($art->comments))
              <div class="empty-section">
                <p>No comments have been posted yet. Show some love, start a conversation.</p>
              </div>
            @endif
            <ul class="comments-list">
              <div class="comments-real">
                @if(count($art->comments))
                  @foreach ($art->comments as $comment)
                    @include('layouts.comment')
                  @endforeach
                @endif
              </div>

              @if(Auth::check())
                <li>
                  <div class="comment-main-level">
                    <div class="comment-avatar">
                      @if(empty(Auth::user()->avatar))
                        <img src="{{ URL::asset('img/default-avatar.png') }}" alt="Default avatar">
                      @else
                        <img src="{{ URL::asset(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                      @endif
                    </div>
                    <div class="comment-box">
                      <div class="comment-head">
                        <h6 class="comment-name
                          @if(Auth::user()->id == $art->user->id)
                            by-author
                          @endif
                        "><a href="http://creaticode.com/blog">{{ Auth::user()->name }}</a></h6>
                        <span>Add a new comment</span>
                      </div>
                      <div class="comment-content">
                        <textarea name="comment" id="comment-field" cols="30" rows="15"></textarea>
                        <button class="btn btn-primary" id="comment-submit">Comment</button>
                      </div>
                    </div>
                  </div>
                </li>
              @endif
            </ul>
          </div>
          <div class="comments-mobile show-on-mobile">
            <h2>Comments</h2>
            @if(!count($art->comments))
              <div class="empty-section">
                <p>No comments have been posted yet. Show some love, start a conversation.</p>
              </div>
            @endif
            <ul>
              <div class="comments-mobile-real">
                @if(count($art->comments))
                  @foreach ($art->comments as $comment)
                    <li>
                      <a href="{{ URL::route('user.profile', [$comment->user->id, Str::slug($comment->user->name)]) }}">{{ $comment->user->name }}</a> - {{{ $comment->body }}}
                    </li>
                  @endforeach
                @endif
              </div>
              @if(Auth::check())
                <li>
                  <div>
                    <textarea name="comment" id="comment-mobile-field" cols="30" rows="15" placeholder="Leave a comment"></textarea>
                    <button class="btn btn-primary" id="comment-mobile-submit">Comment</button>
                  </div>
                </li>
              @endif
            </ul>
          </div>
        </div>
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

  $.fn.extend({
    flash: function () {
      var $this = $(this);
      $this.addClass('animate-flash');
    }
  });

  $(function() {

    $('#comment-submit').click(function() {
      var value = $('#comment-field').val();

      if(value.trim() != '') {
        $.post('{{ URL::route("comment") }}', { id : "{{ $art->id }}", body : value }, function(data) {
          $('.empty-section').hide();
          $('.comments-real').append(data);
          $('#comment-field').val('');
          $('.comments-real li:last-child').flash();
        });
      }
    });

    $('#comment-field').keyup(function(e){

      var value = $('#comment-field').val();

      if(e.keyCode == 13 && value.trim() != '') {

        $.post('{{ URL::route("comment") }}', { id : "{{ $art->id }}", body : value }, function(data) {
          $('.empty-section').hide();
          $('.comments-real').append(data);
          $('#comment-field').val('');
          $('.comments-real li:last-child .comment-box .comment-content').flash();
        });
      }

    });

    $('#comment-mobile-submit').click(function() {
      var value = $('#comment-mobile-field').val();

      if(value.trim() != '') {
        $.post('{{ URL::route("comment_mobile") }}', { id : "{{ $art->id }}", body : value }, function(data) {
          $('.empty-section').hide();
          $('.comments-mobile-real').append(data);
          $('#comment-mobile-field').val('');
          $('.comments-mobile-real li:last-child').flash();
        });
      }
    });

  });
  </script>
@stop
