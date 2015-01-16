@extends('layouts.master')

@section('content')

 @if(Session::has('notice'))
    <div class="alert-box danger">
      {{ Session::get('notice') }}
    </div>
  @endif
  @if(count($theme->art) == 0)
  <div class="day_container">
  	<h3 class="date">Todays topic “<b>{{ $theme->theme }}</b>”.</h3> </h3>
  </div>
  @endif
	@foreach ($themes as $index => $theme)
		@if(count($theme->art))
			<div class="day_container">
				<div class="row">
					<div class="large-12 columns">
						<h3 class="date"> {{ date('d M, Y', strtotime($theme->date)) }} | <span class="theme">{{ $theme->theme }}</span></h3>
					</div>
				</div>
				<div class="images_container">
					<ul>
						@foreach ($theme->art as $art)
							<li class="item">
								<a rel="gallery-{{$index}}" class="single_image swipebox" href="{{ URL::asset($art->image) }}" title="<a href={{ URL::route('art.show', $art->id) }}>{{ $theme->theme }}</a> by <a href={{ URL::route('user.profile', [$art->user->id, Str::slug($art->user->name)]) }}><img src={{ URL::asset($art->user->avatar) }} class='profile-picture light-box-picture'></a><a href=http://www.facebook.com/sharer.php?u={{URL::route('art.show', [$art->id])}} target='_blank'><img src='http://www.simplesharebuttons.com/images/somacro/facebook.png' alt='Facebook' /></a>
    			<a href=http://twitter.com/share?url={{URL::route('art.show', [$art->id])}}&text=Daily Art by {{ $art->user->name }}&hashtags=dailyart, genii target='_blank'><img src='http://www.simplesharebuttons.com/images/somacro/twitter.png' alt='Twitter' /></a>
">
									{{ HTML::image($art->image, $art->caption, ['title' => ''] ) }}
								</a>
		           </li>
						@endforeach
					</ul>
				</div>
			</div>
		@endif
	@endforeach
	<div class="pagination-block day_container">
		<div class="row">
			<div class="large-12 columns">
				{{ $themes->links() }}		
			</div>
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
	<script type="text/javascript">
;( function( $ ) {

	$( '.swipebox' ).swipebox();

} )( jQuery );
</script>

@stop