@extends('layouts.master')

@section('content')
	
 @if(Session::has('notice'))
    <div class="alert-box danger">
      {{ Session::get('notice') }}
    </div>
  @endif
	@foreach ($themes as $theme)
		@if(count($theme->art))
			<div class="day_container">
				<div class="row">
					<div class="large-12 columns">
						<h3 class="date"> {{ date('d M, Y', strtotime($theme->date)) }} | <span class="theme">{{ $theme->theme }}</span></h3>
					</div>
				</div>
				<div class="images_container">
					<ul class="clearing" data-clearing >
						@foreach ($theme->art as $art)
							<li class="item">
								<figure>
									<div>
										{{ HTML::image($art->image, $art->caption) }}
									</div>
									<figcaption>
		                <h3>{{ $theme->theme }}</h3>
		                <span>{{ $art->user->name }}</span>
		                <a class="single_image" href="{{ URL::asset($art->image) }}">Take a look</a>
			            </figcaption>
								</figure>
						@endforeach
					</ul>
				</div>
			</div>
		@endif
	@endforeach
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