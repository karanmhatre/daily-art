@extends('layouts.master')

@section('content')

 @if(Session::has('notice'))
    <div class="alert-box danger">
      {{ Session::get('notice') }}
    </div>
  @endif

  <div class="todays-topic">
  	<p>Today's topic is “<b>{{ $theme->theme }}</b>”</p>
  </div>


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
								<div class="item-inner">
									<a rel="gallery-{{$index}}" class="single_image swipebox" href="{{ URL::to('art', $art->id) }}">
										{{ HTML::image($art->image, $art->caption, ['title' => ''] ) }}
									</a>
									<a class="item-meta" href="{{ URL::route('user.profile', [$art->user->id, Str::slug($art->user->name)]) }}">
										@if(empty($art->user->avatar))
					            <img src="{{ URL::asset('img/default-avatar.png') }}" alt="Default avatar">
					          @else
					            <img src="{{ URL::asset($art->user->avatar) }}" alt="{{ $art->user->name }}">
					          @endif
										{{ $art->user->name }}
									</a>
								</div>
		          </li>
						@endforeach
					</ul>
				</div>
				<div class="loader">
						<div class="cube">
							<div class="plane-1">
								<div class="top-left"></div>
								<div class="top-middle"></div>
								<div class="top-right"></div>
								<div class="middle-left"></div>
								<div class="middle-middle"></div>
								<div class="middle-right"></div>
								<div class="bottom-left"></div>
								<div class="bottom-middle"></div>
								<div class="bottom-right"></div>
							</div>
							<div class="plane-2">
								<div class="top-left"></div>
								<div class="top-middle"></div>
								<div class="top-right"></div>
								<div class="middle-left"></div>
								<div class="middle-middle"></div>
								<div class="middle-right"></div>
								<div class="bottom-left"></div>
								<div class="bottom-middle"></div>
								<div class="bottom-right"></div>
							</div>
							<div class="plane-3">
								<div class="top-left"></div>
								<div class="top-middle"></div>
								<div class="top-right"></div>
								<div class="middle-left"></div>
								<div class="middle-middle"></div>
								<div class="middle-right"></div>
								<div class="bottom-left"></div>
								<div class="bottom-middle"></div>
								<div class="bottom-right"></div>
							</div>
						</div>
					</div>
			</div>
		@endif
	@endforeach

	<div class="pagination-block">
		<div class="row">
			<div class="large-12 columns">
				{{ $themes->links() }}
			</div>
		</div>
	</div>

@stop

@section('scripts')

	<script type="text/javascript">

		$('.images_container').hide();

		$(window).load(function() {

			$('.images_container').fadeIn();
			$('.loader').hide();

	    $('.images_container').each(function() {

	    	$(this).masonry({
		       itemSelector : '.item',
		       "gutter" : 5
		   	});

			});
		});

	</script>

@stop