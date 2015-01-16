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
					<ul>
						@foreach ($theme->art as $art)
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

@stop