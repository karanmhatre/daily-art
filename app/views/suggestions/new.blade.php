@extends('layouts.master')

@section('content')

  <div class="overlay"></div>
  <div class="row">
    <div class="large-6 large-centered columns" id="login-container">
      <h2>Suggest a topic</h2>

      <form class="pure-form pure-form-stacked suggestion-form" action="{{ URL::route('suggestions.store') }}" method="POST">
        <div class="small-10 large-centered columns">
          <div class="row">
            <div class="small-12 columns">
              <input id="topic" name="topic" type="text" placeholder="Topic" required>
            </div>
          </div>
        </div>
        <div class="small-10 large-centered columns">
          <div class="row">
            <div class="small-4 columns">
              <input type="submit" class="button" value="Submit Suggestion">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

@stop
