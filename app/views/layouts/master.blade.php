<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    @if(isset($title))
      <title>Daily Art | {{ $title }}</title>
    @else
      <title>Daily Art | Make art, daily.</title>
    @endif
    <meta name="description" content="The idea behind Daily Art is to make something around a daily theme. Be it a sketch, graphic design, photograph, origami, or even a dance interpretation. We want you to get creative!">
    <meta name="viewport" content="width=device-width">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
    {{ HTML::style('css/normalize.css') }}
    {{ HTML::style('css/foundation.min.css') }}
    {{ HTML::style('css/font-awesome.min.css') }}
    {{ HTML::style('css/dropzone.css') }}
    {{ HTML::style('css/swipebox.min.css') }}
    {{ HTML::style('css/hover-effect.css') }}

    {{ HTML::style('css/main.css') }}
    @yield('meta-tags')
  </head>
  <body>
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->

    <div id="wrapper">
      <header>
        <nav>
          <ul>
            <li>
              @if(Auth::user())
                @if( Request::segment('2') == Auth::user()->id && Request::segment('1') == "users")
                  <a href="{{ URL::to('user') }}">Submit Art</a>
                  <a href="{{ URL::route('users.edit.profile', Auth::user()->id) }}">Edit Profile</a>
                @else
                  <a href="{{ URL::to('user') }}">Submit Art</a>
                  <a href="{{ URL::route('user.profile', Auth::user()->id) }}">View Profile</a>
                @endif
              @else
                <a href="{{ URL::to('login') }}">Login</a>
              @endif
            </li>
          </ul>
        </nav>
        <a href="{{ URL::to('/') }}"><h1 class="main_heading">Daily<i class="fa fa-pencil"></i>Art</h1></a>
      </header>

      <div id="content">
        @if(Session::has('message'))
          <div class="alert-box danger">
            {{ Session::get('message') }}
          </div>
        @endif
        @if(Session::has('notice'))
          <div class="alert-box">
            {{ Session::get('message') }}
          </div>
        @endif

        @yield('content')
      </div>


      <footer>
        <div class="row">
          <div class="small-10 large-6 columns footer-links">
            <a href="{{ URL::to('request/invite') }}" class="invite-link">Request Invite</a> |
            <!-- <a href="{{ URL::route('archives.index') }}" class="invite-link">Archives</a> | -->
            <a href="{{ URL::route('suggestions.new') }}" class="invite-link">Suggest a topic</a>
          </div>
          <div class="small-2 large-6 columns">
            <a href="http://genii.in" class="logo"><img src="{{ URL::asset('img/genii-logo.png')}}" alt="Genii"></a>
          </div>
        </div>
      </footer>
    </div>

    <!-- Scripts -->

    {{ HTML::script('js/vendor/modernizr.js') }}
    {{ HTML::script('js/vendor/jquery.js') }}
    {{ HTML::script('js/vendor/masonry.pkgd.min.js') }}
    {{ HTML::script('js/vendor/imagesloaded.pkgd.min.js') }}
    {{ HTML::script('js/vendor/foundation.min.js') }}
    {{ HTML::script('js/vendor/dropzone.js') }}

    <script>
    $(document).foundation();

    //   var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
    //   (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    //   g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    //   s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>

    @yield('scripts')

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-26353814-5', 'auto');
      ga('send', 'pageview');

    </script>

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


      $('.main_heading').hover(function() {
        $(this).children('i').removeClass('fa-pencil').addClass('fa-home');
      }, function() {
        $(this).children('i').removeClass('fa-home').addClass('fa-pencil');
      });

      $('.like-btn').click(function() {

        var $this = $(this),
            likes = parseInt($this.children('.likes-count').html());

        if($this.hasClass('heart-empty'))
        {
          $.post("{{ URL::to('like') }}", { id :  $(this).data('id') }, function() {
            $this.removeClass('heart-empty').addClass('heart-filled');
            $this.children('.likes-count').html(likes + 1);
          });
        }
        else
        {
          $.post("{{ URL::to('unlike') }}", { id :  $(this).data('id') }, function() {
            $this.removeClass('heart-filled').addClass('heart-empty');
            $this.children('.likes-count').html(likes - 1);
          });
        }
      });
    </script>
  </body>
</html>
