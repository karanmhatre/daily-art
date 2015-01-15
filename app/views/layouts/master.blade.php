<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Daily Art | Make art, daily.</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
    {{ HTML::style('css/normalize.css') }}
    {{ HTML::style('css/foundation.min.css') }}
    {{ HTML::style('css/font-awesome.min.css') }}
    {{ HTML::style('css/dropzone.css') }}

    {{ HTML::style('css/main.css') }}
  </head>
  <body>
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->


    <header>
        <a href="{{ URL::to('/') }}"><h1 class="main_heading">Daily<i class="fa fa-pencil"></i>Art</h1></a>
        <a href="{{ URL::to('login') }}" class="login-btn">Submission</a>
        @if(Auth::user())
            @if( Request::segment('2') == Auth::user()->id && Request::segment(3) == Str::slug(Auth::user()->name))
                <a href="{{ URL::route('users.edit.profile', Auth::user()->id) }}" class="login-btn profile-btn">Edit Profile</a>
            @endif
        @endif
    </header>

    @yield('content')

    <!-- Scripts -->

    {{ HTML::script('js/vendor/modernizr.js') }}
    {{ HTML::script('js/vendor/jquery.js') }}
    {{ HTML::script('js/vendor/masonry.pkgd.min.js') }}
    {{ HTML::script('js/vendor/foundation.min.js') }}
    {{ HTML::script('js/vendor/dropzone.js') }}

    <!-- Add fancyBox main JS and CSS files -->
    {{ HTML::script('js/vendor/fancy-source/jquery.fancybox.js?v=2.1.5') }}
    {{ HTML::style('js/vendor/fancy-source/jquery.fancybox.css?v=2.1.5" media="screen') }}

    <!-- Add Button helper (this is optional) -->
    {{ HTML::style('js/vendor/fancy-source/helpers/jquery.fancybox-buttons.css?v=1.0.5') }}
    {{ HTML::script('js/vendor/fancy-source/helpers/jquery.fancybox-buttons.js?v=1.0.5') }}

    <!-- Add Thumbnail helper (this is optional) -->
    {{ HTML::style('js/vendor/fancy-source/helpers/jquery.fancybox-thumbs.css?v=1.0.7') }}
    {{ HTML::script('js/vendor/fancy-source/helpers/jquery.fancybox-thumbs.js?v=1.0.7') }}

    <!-- Add Media helper (this is optional) -->
    {{ HTML::script('js/vendor/fancy-source/helpers/jquery.fancybox-media.js?v=1.0.6') }}

    <script>
    $(document).foundation();

    //   var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
    //   (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    //   g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    //   s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>

    <script type="text/javascript">
        Dropzone.options.myAwesomeDropzone = {
          maxFiles: 1,
          complete: function() {
            location.reload();
          }
        }
    </script>

    @yield('scripts')
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '1523370727924834',
          xfbml      : true,
          version    : 'v2.2'
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
  </body>
</html>
