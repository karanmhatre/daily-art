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
				<h3 class="date"> {{ date('d M, Y', strtotime($art->theme->date)) }} | <span class="theme">{{ $art->theme->theme }}</span> by <a href="{{ URL::route('user.profile', [$art->user->id, Str::slug($art->user->name)]) }}">{{ $art->user->name }}</a></h3>
			</div>
		</div>
		<div class="single-image">
				{{ HTML::image($art->image, $art->caption) }}
		</div>
	</div>
@stop

@section('scripts')


@stop