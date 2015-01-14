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
				<h3 class="date"> Artwork by {{$user->name}} </h3>
			</div>
		</div>
		<div class="images_container">
			<ul>
				@foreach ($arts as $art)
					<li class="item">
						<a class="single_image" href="{{ URL::route('art.show', $art->id) }}">
							{{ HTML::image($art->image, $art->caption) }}
						</a>
          </li>
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