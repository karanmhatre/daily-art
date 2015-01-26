@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="large-12 columns user-page-theme">
			<h3>Today's theme is '{{ Theme::today()->theme }}'</h3>
			@if(is_null($art_today))
				<h5>Upload your artwork for the day below.</h5>
			@else
				<h5>Your submission for today. {{ HTML::linkRoute('user.change', 'Change?', array('id' => $art_today->id)) }}</h5>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns">
			@if(is_null($art_today))
				<form action="{{ URL::route('user.upload') }}" class="dropzone" method="POST" enctype="multipart/form-data" id="my-awesome-dropzone">
					<input type="file" name="file" id="file_upload"/>
				</form>

				<form action="{{ URL::route('user.upload') }}" method="POST" enctype="multipart/form-data" id="mobile-image-capture">
					<input type="file" name="file" accept="image/*" capture="camera" id="capture-field" />
				</form>
			@else
				<hr>
				<form action="{{ URL::route('updateCaption') }}" method="POST">
					<div class="row">
						<div class="large-10 columns">
							<label for=""><b>Caption</b></label>
							<input type="text" name="caption" placeholder="Add a caption to your artwork" value="{{ $art_today->caption }}"/>
						</div>
						<div class="large-2 columns">
							<button type="submit">Save</button>
						</div>
					</div>
				</form>
				<hr>
				{{ HTML::image($art_today->image) }}
			@endif
			<p style="text-align: center; margin-top: 15px;"><a href="{{ URL::to('logout') }}">Logout? Fine, leave!</a></p>
		</div>
	</div>
@stop

@section('scripts')

	<script type="text/javascript">

		$( document ).ready(function() {

			$('#capture-field').change(function() {
				$('#mobile-image-capture').submit();
			});

	    var isMobile = window.matchMedia("only screen and (max-width: 760px)");

	    if (isMobile.matches) {
	    	$('#my-awesome-dropzone').hide();
	    	$('#mobile-image-capture').show();
	    }
	    else {
	    	$('#mobile-image-capture').hide();
	    	Dropzone.options.myAwesomeDropzone = {
		      maxFiles: 1,
		      complete: function() {
		        location.reload();
		      }
    		}
	    }
	 	});
  </script>

@stop