@extends('layouts.app') 
@section('content') {{-- @dd($document) --}}
<section id="home" class="video-hero" style="height: 500px; background-image: url(images/cover_img_1.jpg);  background-size:cover; background-position: center center;background-attachment:fixed;"
 data-section="home">
	<div class="overlay"></div>
	<div class="display-t display-t2 text-center">
		<div class="display-tc display-tc2">
			<div class="container">
				<div class="col-md-12 col-md-offset-0">
					<div class="animate-box">
						<h2>Download page</h2>
						<p class="breadcrumbs"><span><a href="/">Home</a></span> <span>share</span></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div id="colorlib-contact">
	<div class="container">
		<div class="row">
			<div class="col-md-12 animate-box">
				<h2>Document Information</h2>
				<div class="row">
					<div class="col-md-12">
					    @if($document->access == 1):
						<div class="contact-info-wrap-flex">
							<div class="con-info">
								<p><span><i class="icon-location-2"></i></span> {{$document->title}}</p>
							</div>
							<div class="con-info">
								<p><span><i class="icon-phone3"></i></span>{{$document->user->name}}</p>
							</div>
							<div class="con-info">
								<p><span><i class="icon-paperplane"></i> </span> {{$document->description}}</p>
							</div>
							<div class="con-info">
								<p><span><i class="icon-globe"></i></span> {{$document->category}}</p>
							</div>
						</div>
						
						
						<div class="con-info">
							<a id="downloadfile" data-url="{{extractFileFromPath($document->filename)}}" href="#" class="btn btn-success btn-lg" value="Download">Download</a>
						</div>
						@else:
						<div class="con-info">
							<p><span><i class="icon-location-2"></i></span> This document is private. Please contact the Uploader to make it publicly accessible</p>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="map" class="colorlib-map"></div>
@endsection
 
@section('scripts')

<script>
	$('body').delegate('#downloadfile', 'click', function(){
		var url = $(this).data('url');
		window.location = "/download/"+url
	});
</script>
@endsection