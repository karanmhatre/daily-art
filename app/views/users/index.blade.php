@extends('layouts.master')

@section('content')
	<div class="todays-topic">
  	<div class="topic">
  		<p>Today's topic is “<b>{{ Theme::today()->theme }}</b>”</p>
  	</div>
  	<div class="streak-meter">
  		<div class="labels">
	  		<p>Current streak - 1/5</p>
	  		<p>Longest streak - 2</p>
  		</div>
  		<div class="progress-bar">
  			<div class="filled"></div>
  		</div>
  	</div>
  </div>
	<div class="row">
		<div class="large-12 columns user-page-theme">
			@if(is_null($art_today))
				<h5>Upload your artwork for the day below.</h5>
			@else
				<h5>Congratutions! You've made it today. {{ HTML::linkRoute('user.change', 'Change?', array('id' => $art_today->id)) }}</h5>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="large-12 columns">
			@if(is_null($art_today))
				<form action="{{ URL::route('user.upload') }}" class="dropzone" method="POST" enctype="multipart/form-data" id="my-awesome-dropzone">
					<input type="file" name="file" id="file_upload"/>
				</form>
				<div class="row">
					<div class="small-6 columns">
						<form action="{{ URL::route('user.upload') }}" method="POST" enctype="multipart/form-data" id="mobile-image-capture">
							<label for="capture-field"><i class="fa fa-camera"></i><br>Take a Photo</label>
							<input type="file" name="file" accept="image/*" capture="camera" id="capture-field" />
						</form>
					</div>
					<div class="small-6 columns">
						<form action="{{ URL::route('user.upload') }}" method="POST" enctype="multipart/form-data" id="mobile-image-gallery">
							<label for="mobile-upload-field"><i class="fa fa-picture-o"></i><br>Upload from Gallery</label>
							<input type="file" name="file" accept="image/*" id="mobile-upload-field" />
						</form>
					</div>
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
			@else
				<hr>
				<form action="{{ URL::route('updateCaption') }}" method="POST">
					<div class="row">
						<div class="large-10 columns">
							<label for="caption"><b>Caption</b></label>
							<input type="text" id="caption" name="caption" placeholder="Add a caption to your artwork" value="{{ $art_today->caption }}"/>
						</div>
						<div class="large-2 columns">
							<button type="submit" class="btn margin-top-sm">Save</button>
						</div>
					</div>
				</form>
				<hr>
				{{ HTML::image($art_today->image) }}
				<br><br><br><br>
			@endif
		</div>
	</div>
@stop

@section('scripts')

	<script type="text/javascript">

		$( document ).ready(function() {

			$('.loader').hide();

			$('#capture-field').change(function() {
				$('#capture-field').fadeOut();
				$('#mobile-image-gallery').fadeOut();
				$('.loader').show();
				$('#mobile-image-capture').submit();
			});

			$('#mobile-upload-field').change(function() {
				$('#capture-field').fadeOut();
				$('#mobile-image-gallery').fadeOut();
				$('.loader').show();
				$('#mobile-image-gallery').submit();
			});

	    var isMobile = window.matchMedia("only screen and (max-width: 760px)");

	    if (isMobile.matches) {
	    	$('#my-awesome-dropzone').hide();
	    	$('#mobile-image-capture').show();
	    	$('#mobile-image-gallery').show();
	    }
	    else {
	    	$('#mobile-image-capture').hide();
	    	$('#mobile-image-gallery').hide();
	    	Dropzone.options.myAwesomeDropzone = {
		      maxFiles: 1,
		      complete: function(data) {
		      	// console.log(data);
		        location.reload();
		      }
    		}
	    }
	 	});
  </script>

@stop