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
    <div class="small-12 large-6 large-centered columns" id="login-container">
      <h2>Unsubscribe</h2>

      @if(Session::has('message'))
        <div class="alert-box danger">
          {{ Session::get('message') }}
        </div>
      @endif


      {{ Form::open(array('route' => 'do_unsubscribe')) }}
        <div class="small-10 large-centered columns">
          <div class="row">
            <div class="small-12 columns">
              <p>Are you sure you want to unsubscribe to our awesome mails?</p>
            </div>
          </div>
        </div>
        <div class="large-10 small-12 large-centered columns">
          <div class="row">
            <div class="small-4 columns">
              <input type="hidden" value="{{ $token }}" name="id">
              <input type="submit" class="button" value="Yes">
            </div>
            <div class="small-8 columns small-links">
              <a href="{{ URL::to('/') }}">No! I was kidding.</a>
            </div>
          </div>
        </div>
      {{ Form::close() }}

    </div>
  </div>

@stop
