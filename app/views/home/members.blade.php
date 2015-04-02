@extends('layouts.master')

@section('content')
  <div class="member-search-container">
    <i class="fa fa-search"></i>
    <input type="text" class="member-search" placeholder="Search for your friends">
  </div>
  <div class="day_container">
    <div class="row">
      @foreach ($users as $user)
        <a class="user-small-list" href="{{ URL::route('user.profile', [$user->id, Str::slug($user->name)]) }}" data-name="{{ $user->name }}">
          <div class="profile-picture-container">
            @if(empty($user->avatar))
              <img src="{{ URL::asset('img/default-avatar.png') }}" alt="Default avatar" class="profile-picture">
            @else
              <img src="{{ URL::asset($user->avatar) }}" alt="{{ $user->name }}" class="profile-picture"><br>
            @endif
          </div>
          <div class="fleft">
            <h4 class="profile-name">{{ $user->name }}</h4>
            <div>
              <h3 class="profile-stats">{{ $user->current_streak }} <span>Current streak</span></h3>
            </div>
          </div>
        </a>
      @endforeach
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