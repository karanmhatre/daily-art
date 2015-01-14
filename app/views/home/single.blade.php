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
				<h3 class="date"> {{ date('d M, Y', strtotime($art->theme->date)) }} | <span class="theme">{{ $art->theme->theme }}</span> by {{ $art->user->name }}</h3>
			</div>
		</div>
		<div>
				{{ HTML::image($art->image, $art->caption) }}		
		</div>
	</div>
@stop

@section('scripts')


@stop