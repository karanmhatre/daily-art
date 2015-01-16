@extends('layouts.master')

@section('content')

 @if(Session::has('notice'))
    <div class="alert-box danger">
      {{ Session::get('notice') }}
    </div>
  @endif

	@foreach($months as $key => $month)
		@if(count($month))
			<div class="day_container">
				<div class="row">
					<div class="large-12 columns">
						<h3 class="date"> {{ date('M, Y', strtotime($key)) }} | <a href="{{ URL::route('archives.show', [date('m',strtotime($key)), date('Y',strtotime($key))]) }}">Admire 'em all</a> </h3>
					</div>
				</div>
				<div class="images_container">
					<ul>
							@foreach(array_slice($month, 0, 3) as $index => $art)
							<li class="item">
								<a class="single_image" href="{{ URL::route('art.show', $art->id) }}">
									{{ HTML::image($art->image, $art->caption) }}
								</a>
		            <a class="user_link" href="{{ URL::route('user.profile', [$art->user->id, Str::slug($art->user->name)]) }}"><span>{{ $art->user->name }}</span></a>
		           </li>
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