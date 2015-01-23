@extends('layouts.master')

@section('content')

  <div class="overlay"></div>
  <div class="center suggestion">
        <a href="{{ URL::to('/') }}"><h1 class="main_heading">Daily<i class="fa fa-pencil"></i>Art</h1></a>
    <form class="pure-form pure-form-stacked suggestion-form" action="{{ URL::route('suggestions.store') }}" method="POST">
      <fieldset>
          <legend>Suggestions</legend>
          <div class="inner-addon left-addon">
            <i class="fa fa-pencil"></i>
            <input id="topic" name="topic" type="text" placeholder="Topic" required>
          </div>
          <button type="submit" class="pure-button pure-button-primary">Submit</button>
          @if(Session::has('notice'))
            <div style="margin: 20px auto; color:red"><i class="fa fa-warning"></i> {{ Session::get('notice') }}</div>
          @endif
      </fieldset>
    </form>
  </div>

@stop