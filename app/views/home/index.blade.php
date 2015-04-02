@extends('layouts.master')

@section('content')

  <div class="todays-topic">
  	<div class="topic">
  		<p class="{{ Auth::guest() ? 'guest_topic' : '' }}">Today's topic is “<b>{{ $theme->theme }}</b>”</p>
  	</div>
    @if(Auth::guest())
      <div class="streak-meter">
        <p>The idea behind Daily Art is to make something around a daily theme. Be it a sketch, graphic design, photograph, origami, or even a dance interpretation. We want you to get creative! <a href="{{ URL::to('request/invite') }}">Request an invite.</a>
        </p>
      </div>
    @else
    	<div class="streak-meter">
    		<div class="labels">
  	  		<p>Current streak - {{ Auth::user()->current_streak }}/10</p>
  	  		<p>Longest streak - {{ Auth::user()->longest_streak }}</p>
    		</div>
    		<div class="progress-bar">
    			<div class="filled" style="width: {{ (Auth::user()->current_streak/10)*100 }}%;"></div>
    		</div>
    	</div>
    @endif
  </div>

	@foreach ($themes as $index => $theme)
		@if(count($theme->art))
			<div class="day_container">
				<h3 class="date">
					<span class="theme">{{ $theme->theme }}</span> - {{ date('d M, Y', strtotime($theme->date)) }}
				</h3>
				<div class="images_container split-row cf" data-columns>
						@foreach ($theme->art()->orderBy('likes', 'DESC')->get() as $art)
							<div class="item">
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
	          				<a class="author-name" href="{{ URL::route('user.profile', [$art->user->id, Str::slug($art->user->name)]) }}">{{ $art->user->name }}</a>

	          				<div class="stat-meta">
	          					@if(Auth::check())
	          						<a href="javascript:void(0);" data-id="{{ $art->id }}" data-likes="{{ $art->likes }}" class="like-btn heart {{ ((array_search(Auth::user()->id, $art->like_users()->lists('user_id')) !== false ) ? 'heart-filled' : 'heart-empty') }}"><i class="fa fa-heart"></i> <span class="likes-count">{{ $art->likes }}</span></a>
	          						<a href="{{ URL::to('art', $art->id) }}#comments" class="comment"><i class="fa fa-comment"></i> <span class="likes-count">{{ $art->comments()->count() }}</span></a>
	          					@else
	          						<a href="javascript:void(0);" class="heart heart-empty"><i class="fa fa-heart"></i> <span class="likes-count">{{ $art->likes }}</span></a>
	          						<a href="{{ URL::to('art', $art->id) }}#comments" class="comment"><i class="fa fa-comment"></i> <span class="likes-count">{{ $art->comments()->count() }}</span></a>
	          					@endif
	          				</div>
									</div>
								</div>
		          </div>
						@endforeach
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

@stop