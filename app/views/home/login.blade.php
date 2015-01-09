<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Daily Art | Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    {{ HTML::style('css/normalize.css') }}
    {{ HTML::style('css/foundation.min.css') }}
    {{ HTML::style('css/font-awesome.min.css') }}
    {{ HTML::style('css/main.css') }}
  </head>
  <body>
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->

    <!-- Add your site or application content here -->

    <div class="row">
      <div class="small-6 large-centered columns" id="login-container">
        <h2>Daily<i class="fa fa-pencil"></i>Art Login</h2>

        @if(Session::has('message'))
          <div class="alert-box danger">
            {{ Session::get('message') }}
          </div>
        @endif


        {{ Form::open(array('route' => 'login')) }}
          <div class="small-10 large-centered columns">
            <div class="row">
              <div class="small-3 columns">
                <label for="right-label" class="right inline">Email</label>
              </div>
              <div class="small-9 columns">
                <input type="text" id="right-label" placeholder="Email" name="email">
              </div>
            </div>
          </div>
          <div class="small-10 large-centered columns">
            <div class="row">
              <div class="small-3 columns">
                <label for="password" class="right inline">Password</label>
              </div>
              <div class="small-9 columns">
                <input type="password" id="password" name="password">
              </div>
            </div>
          </div>
          <div class="small-10 large-centered columns">
            <div class="row">
              <div class="small-3 columns">
              </div>
              <div class="small-9 columns">
                <input type="submit" class="button" value="Login"><br>
                <p>Don't have an account. Email me at <a href="mailto:karan@genii.in">karan@genii.in</a> to get invited.</p>
              </div>
            </div>
          </div>
        {{ Form::close() }}

      </div>
    </div>


    <!-- Scripts -->

    {{ HTML::script('js/vendor/modernizr-2.6.2.min.js') }}
    {{ HTML::script('js/vendor/jquery-1.9.0.min.js') }}
    {{ HTML::script('js/vendor/foundation.min.js') }}

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
    $(document).foundation();
    //   var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
    //   (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    //   g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    //   s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>

    @yield('scripts')
  </body>
</html>
