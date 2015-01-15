@extends('layouts.master')

@section('content')
	
 @if(Session::has('notice'))
    <div class="alert-box danger">
      {{ Session::get('notice') }}
    </div>
  @endif
	<div class="day_container">
		<div class="row">
			<div class="large-12 columns">
				<div class="profile-div">
					<span class="number">{{ $user->getDaysBunked($user) }}</span> <span class="profile-text">days bunked</span>
					<img src="{{ URL::asset($user->avatar) }}" alt="" class="profile-picture">
					<span class="number">3</span> <span class="profile-text">submissions</span>
				</div>
				<h3 class="date"> Artwork by {{$user->name}} </h3>
			</div>
		</div>
		<div class="images_container">
			<ul class="clearing" data-clearing >
				@foreach ($arts as $art)
					<li class="item">
						<figure>
							<div>
								{{ HTML::image($art->image, $art->caption) }}
							</div>
							<figcaption>
                <h3>{{ $art->theme->theme }}</h3>
                <a href="{{ URL::route('user.profile', [$art->user->id, Str::slug($art->user->name)]) }}"><span>{{ $art->user->name }}</span></a>
                <a class="single_image" href="{{ URL::asset($art->image) }}">Take a look</a>
	            </figcaption>
						</figure>
				@endforeach
			</ul>
		</div>
	</div>
@stop

@section('scripts')

	<script type="text/javascript">
		$(window).load(function() {
	    $('.images_container').each(function() {
				$(this).masonry({
				  itemSelector: '.item',
				  "gutter": 5
				});
			});
		});

	</script>

@stop