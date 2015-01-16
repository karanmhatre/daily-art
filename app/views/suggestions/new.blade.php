<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daily Art | Make art, daily.</title>
    {{ HTML::style('css/admin/pure-min.css') }}
    {{ HTML::style('css/admin/main.css') }}
    {{ HTML::style('css/admin/side-menu.css') }}
    {{ HTML::style('css/admin/font-awesome.min.css')}}
    {{ HTML::style('css/main.css') }}
  </head>
  <body class="login" style="background-image: url('../../img/{{$number}}.jpg'); background-size: cover;">
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
    {{ HTML::script('js/vendor/jquery.js') }}
    {{ HTML::script('js/vendor/polyfiller.js') }}
    <script>
        webshims.setOptions('forms', {
        lazyCustomMessages: true
    });

    //start polyfilling
    webshims.polyfill('forms');
    </script>
  </body> 
</html>