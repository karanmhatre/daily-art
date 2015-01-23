@extends('layouts.master')

@section('content')
  <div class="row">
    <div class="small-6 large-centered columns" id="login-container">
      <h2>Daily<i class="fa fa-pencil"></i>Art Register</h2>

      @if(Session::has('message'))
        <div class="alert-box danger">
          {{ Session::get('message') }}
        </div>
      @endif


      {{ Form::open(array('route' => 'user.store','files' => 'true')) }}
        <div class="small-10 large-centered columns">
          <div class="row">
            <div class="small-3 columns">
              <label for="right-label" class="right inline">Name</label>
            </div>
            <div class="small-9 columns">
              <input type="text" id="right-label" placeholder="Name" name="name" value="{{ $user->name }}" required>
            </div>
          </div>
        </div>
        <input name="register_code" type="hidden" value="{{ $user->register_code }}">
        <div class="small-10 large-centered columns">
          <div class="row">
            <div class="small-3 columns">
              <label for="right-label" class="right inline">Email</label>
            </div>
            <div class="small-9 columns">
              <input type="text" id="right-label" placeholder="Email" name="email" disabled value="{{ $user->email }}" required>
            </div>
          </div>
        </div>
        <div class="small-10 large-centered columns">
          <div class="row">
            <div class="small-3 columns">
              <label for="right-label" class="right inline">Avatar</label>
            </div>
            <div class="small-9 columns">
              <input type="file" name="avatar" required>
            </div>
          </div>
        </div>
        <div class="small-10 large-centered columns">
          <div class="row">
            <div class="small-3 columns">
              <label for="password" class="right inline">Password</label>
            </div>
            <div class="small-9 columns">
              <input type="password" id="password" name="password" required>
            </div>
          </div>
        </div>
        <div class="small-10 large-centered columns">
          <div class="row">
            <div class="small-3 columns">
            </div>
            <div class="small-9 columns">
              <input type="submit" class="button" value="Register"><br>
              <p>Todays topic “<b>{{ $theme }}</b>”.</p>
            </div>
          </div>
        </div>
      {{ Form::close() }}

    </div>
  </div>

@stop