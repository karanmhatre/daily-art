@extends('layouts.master')

@section('content')

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
						@foreach ($theme->art()->orderBy('likes', 'DESC')->get() as $art)
							<li class="item">
								<div class="item-inner">
									<div class="grid">
										<figure class="effect-sadie">
											{{ HTML::image($art->image, $art->caption) }}
											@if(!empty($art->caption))
												<figcaption>
													<p>{{ $art->caption }}</p>
												</figcaption>
											@endif
											<a href="{{ URL::to('art', $art->id) }}">View more</a>
										</figure>
									</div>
									<div class="clearfix"></div>
									<div class="item-meta">
										@if(empty($art->user->avatar))
					            <img src="{{ URL::asset('img/default-avatar.png') }}" alt="Default avatar">
					          @else
					            <img src="{{ URL::asset($art->user->avatar) }}" alt="{{ $art->user->name }}">
					          @endif
					          <a href="{{ URL::route('user.profile', [$art->user->id, Str::slug($art->user->name)]) }}">{{ $art->user->name }}</a>

										@if(Auth::check())
											<a href="javascript:void(0);" data-id="{{ $art->id }}" data-likes="{{ $art->likes }}" class="like-btn heart {{ ((array_search(Auth::user()->id, $art->like_users()->lists('user_id')) !== false ) ? 'heart-filled' : 'heart-empty') }}"><i class="fa fa-heart"></i> <span class="likes-count">{{ $art->likes }}</span></a>
										@else
											<a href="javascript:void(0);" class="heart heart-empty"><i class="fa fa-heart"></i> <span class="likes-count">{{ $art->likes }}</span></a>
										@endif

									</div>
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

		$('.images_container').each(function() {
			var $container = $(this);

			$container.imagesLoaded(function() {
				$container.masonry({
	        itemSelector : '.item',
	        "gutter" : 5
	   		});

	   		$container.siblings('.loader').hide();
	   	});

		});

	</script>

@stop