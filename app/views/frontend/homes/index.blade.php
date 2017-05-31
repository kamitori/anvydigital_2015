<div class="row banner">
	@include('frontend.layout.banner')
</div>

<!-- end Product Service -->
<div class="row home-title graybg">
	<h1>{{ isset($home['home']['header_title']) ? nl2br($home['home']['header_title']) : '' }}</h1>
	<span>{{ isset($home['home']['header_description']) ? nl2br($home['home']['header_description']) : '' }}</span>
</div>
	

<div class="row">
	<div class="col-md-10 categorybox-margin col-md-offset-1 probox">
		<div class="row  homeproduct">
			{{ $homeLink or '' }}
		</div>
	</div>
</div>
<!-- end Hot product -->
<div class="row home-title graybg">
	<h1>{{ isset($home['home']['main_title']) ? nl2br($home['home']['main_title']) : '' }}</h1>
	<span>{{ isset($home['home']['main_description']) ? nl2br($home['home']['main_description']) : '' }}</span>
</div>


<div class="row hotproduct">
	<div class="col-md-10 col-md-offset-1 probox">
		<div class="row homeproduct">
			{{ $homeCategory or '' }}
		</div>
	</div>
</div>

<!-- tileAboutUs  changed from 4 to 1 -->
	<div class="row categorybox-margin">
		<hr/>
	<div class="text-center home_tile_about">
		 @for($m=0;$m<1;$m++) 
		<a href="/pages/about-us" class="group-section-links" style="text-decoration:none;">
			<div class="tileAboutUs">
				<div style="text-align:center; padding-top:10px; font-size: 24px; font-family: 'Myriad W01 Light';">
					<strong class="glyphicon glyphicon-play-circle" aria-hidden="true"></strong>
					<p>Our story</p>
				</div>
				<div style="text-align:center;width:270px; font-size:16px;">
					<p>Learn more about us.</p>
				</div>
			</div>
		</a>
		@endfor
	
	<div class="text-left home_info_about">
		<h2>The Company</h2>
		<p>Anvy Digital Imaging Inc. is a large format printing company, but not just any printing company. Anvy Digital is a digital printer, which means we do it faster. With state of the art equipment and dedicated employees, we produce high quality prints that will exceed your standards! Send us your print ready files digitally and we can have your product ready in as little as three days!</p><p> We deliver printed materials that can motivate, educate, or inspire your prospects to become customers.</p>
		</div>
	</div>
</div><!--end row-->

<!-- end About -->

<!-- Social links module on home page hidden due to redundancy-->
<!--
<div class="row home-title whitebg">
	<h2>{{ isset($home['home']['footer_title']) ? nl2br($home['home']['footer_title']) : '' }}</h2>
	<span>{{ isset($home['home']['footer_description']) ? nl2br($home['home']['footer_description']) : '' }}</span>
	<div class="text-center">
		{{ $homeSocial or '' }}
	</div>
-->

</div>
@section('pageJS')
<script src="{{ URL::asset( 'assets/js/banner.js') }}" type="text/javascript"></script>
@stop

