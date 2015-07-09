@extends('layouts.master')

@section('content')
  <div class="invite-bg">
    @foreach ($arts as $art)
      <div class="art">
        <a href="{{ URL::to('art', $art->id) }}">
          <img src="{{ URL::asset($art->image) }}" alt="{{ $art->caption }}">
        </a>
      </div>
    @endforeach
  </div>
  <div class="row">
    <div class="large-6 small-12 large-centered columns" id="login-container">
      <h2>Request an Invite</h2>
      <p>We are still in beta, so you need to request for an invite before you can start posting. Don't worry the process is easy.</p>

      {{ Form::open(array('route' => 'user.storeInvite','files' => 'true')) }}
        <div class="small-10 large-centered columns">
          <div class="row">
            <div class="small-12 columns">
              <input type="text" id="right-label" placeholder="Name" name="name" value="" required>
            </div>
          </div>
        </div>
        <div class="small-10 large-centered columns">
          <div class="row">
            <div class="small-12 columns">
              <input type="text" id="right-label" placeholder="Email" name="email" value="" required>
            </div>
          </div>
        </div>
        <div class="large-10 small-12 large-centered columns">
          <div class="row">
            <div class="small-4 columns">
              <input type="submit" class="button" value="Request an invite">
            </div>
            <div class="small-8 columns small-links">
              <a href="{{ URL::route('login') }}">I'm already a member.</a>
            </div>
          </div>
        </div>
      {{ Form::close() }}

    </div>
  </div>

@stop