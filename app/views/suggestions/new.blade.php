@extends('layouts.master')

@section('content')

  <div class="overlay"></div>
  <div class="row">
    <div class="large-6 columns suggestion-topics">
      <h2>Previously posted topics</h2>
      <ul class="topics">
        @foreach($themes as $theme)
          <li data-topic="{{ $theme->theme }}">
            {{ $theme->theme }}
          </li>
        @endforeach
      </ul>
    </div>
    <div class="large-6 columns" id="login-container">
      <h2>Suggest a topic</h2>

      <form class="pure-form pure-form-stacked suggestion-form" action="{{ URL::route('suggestions.store') }}" method="POST">
        <div class="small-10 large-centered columns">
          <div class="row">
            <div class="small-12 columns">
              <input id="topic" name="topic" type="text" placeholder="Topic" required value="{{ Input::get('q') }}">
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

@section('scripts')
  <script>
    $(function() {
      $('#topic').keyup(function() {
        var input = $(this).val(),
            count = input.length;

        if(input != '')
        {
          $('.topics li').each(function() {
            var topic = $(this).data('topic');

            console.log(topic.substring(0, count));

            if(topic.substring(0, count).toLowerCase() == input.toLowerCase())
              $(this).fadeIn();
            else
              $(this).fadeOut();
          });
        }
        else
        {
          $('.topics li').show();
        }
      });
    });
  </script>
@stop
