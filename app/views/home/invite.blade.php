@extends('layouts.master')

@section('content')

  <div class="row">
    <div class="small-6 large-centered columns" id="login-container">
      <h2>Request Invite</h2>

      @if(Session::has('message'))
        <div class="alert-box danger">
          {{ Session::get('message') }}
        </div>
      @endif
      @if(Session::has('notice'))
        <div class="alert-box">
          {{ Session::get('message') }}
        </div>
      @endif

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
        <div class="small-10 large-centered columns">
          <div class="row">
            <div class="small-4 columns">
              <input type="submit" class="button" value="Login">
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