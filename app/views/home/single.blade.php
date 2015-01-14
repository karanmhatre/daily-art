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
				<h3 class="date"> {{ date('d M, Y', strtotime($art->theme->date)) }} | <span class="theme">{{ $art->theme->theme }}</span></h3>
			</div>
		</div>
		<div class="images_container">
			<ul class="clearing" data-clearing >
				<li class="item">
					<figure>
						<div>
							{{ HTML::image($art->image, $art->caption) }}
						</div>
						<figcaption>
              <span>{{ $art->user->name }}</span>
              <a class="single_image" href="{{ URL::asset($art->image) }}">Take a look</a>
            </figcaption>
					</figure>
			</ul>
		</div>
	</div>
@stop

@section('scripts')


@stop