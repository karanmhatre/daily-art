@extends('layouts.master')

@section('content')
  <div class="day_container">
    <div class="row">
      <div class="large-11 large-centered columns user-list">
        <input type="text" class="member-search" placeholder="Search for your friends">
        @foreach ($users as $user)
          <a class="profile-inner-box" href="{{ URL::route('user.profile', [$user->id, Str::slug($user->name)]) }}" data-name="{{ $user->name }}">
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
                <p class="profile-date">Joined {{ date('d M, Y', strtotime($user->created_at)) }}</p>
              </div>
              <div class="profile-numbers">
                <div class="profile-single-number">{{ $user->getDaysSubmitted($user) }}<br><span class="stat-meta">Arts</span></div>
                <div class="profile-single-number">{{ $user->getDaysBunked($user) }}<br><span class="stat-meta">Bunks</span></div>
              </div>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </div>
@stop

@section('scripts')
  <script>
    $(function() {
      $('.member-search').keyup(function() {
        var q = $(this).val().toLowerCase();

        if(q.trim() != '') {
          $('.profile-inner-box').each(function() {
            var s = $(this).data('name').toLowerCase();
            if(s.indexOf(q) == -1)
              $(this).fadeOut();
          });
        }
        else {
          $('.profile-inner-box').fadeIn();
        }
      });
    });
  </script>
@stop