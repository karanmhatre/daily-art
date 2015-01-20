@extends('layouts.master')

@section('content')

  <div class="row">
    <div class="small-6 large-centered columns" id="login-container">
      <h2>Forgot Password</h2>

      @if(Session::has('message'))
        <div class="alert-box danger">
          {{ Session::get('message') }}
        </div>
      @endif


      {{ Form::open(array('route' => 'reset_password')) }}
        <div class="small-10 large-centered columns">
          <div class="row">
            <div class="small-12 columns">
              <input type="email" id="right-label" placeholder="Enter your Email address" name="email" required>
            </div>
          </div>
        </div>
        <div class="small-10 large-centered columns">
          <div class="row">
            <div class="small-4 columns">
              <input type="submit" class="button" value="Send"><br>
            </div>
            <div class="small-8 columns small-links">
              <a href="{{ URL::to('login') }}">Oh wait! I remembered it.</a>
            </div>
          </div>
        </div>
      {{ Form::close() }}

    </div>
  </div>

@stop