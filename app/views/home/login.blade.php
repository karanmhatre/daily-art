@extends('layouts.master')

@section('content')
  <div class="row">
    <div class="small-6 large-centered columns" id="login-container">
      <h2>Login</h2>

      @if(Session::has('message'))
        <div class="alert-box danger">
          {{ Session::get('message') }}
        </div>
      @endif


      {{ Form::open(array('route' => 'login')) }}
        <div class="small-10 large-centered columns">
          <div class="row">
            <div class="small-12 columns">
              <input type="text" id="right-label" placeholder="Email" name="email">
            </div>
          </div>
        </div>
        <div class="small-10 large-centered columns">
          <div class="row">
            <div class="small-12 columns">
              <input type="password" id="password" name="password" placeholder="Password">
            </div>
          </div>
        </div>
        <div class="small-10 large-centered columns">
          <div class="row">
            <div class="small-4 columns">
              <input type="submit" class="button" value="Login">
            </div>
            <div class="small-8 columns small-links">
              <a href="{{ URL::route('forgot_password') }}">Forgot Password?</a> |
              <a href="{{ URL::route('user.requestInvite') }}">Request an Invite.</a>
            </div>
          </div>
        </div>
      {{ Form::close() }}

    </div>
  </div>

@stop
