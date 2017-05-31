<!doctype html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="{{ $metaInfo['meta_description'] or '' }}" />
	<meta name="keywords" content="{{ $metaInfo['key_word'] or '' }}" />
	<meta name="author" content="{{ URL }}">
	<meta name="p:domain_verify" content="cb8b92203cb9875cbbf5ad67f787bc3d"/>
	@if( isset($metaInfo['favicon']))
		<link href="{{ URL::asset($metaInfo['favicon']) }}" rel="shortcut icon" type="image/x-icon" />
	@endif
   <title>{{ isset($metaInfo['meta_title']) && !empty($metaInfo['meta_title']) ? $metaInfo['meta_title'] : (isset($metaInfo['title_site']) ? $metaInfo['title_site'] : '') }}</title>
	<link href="{{ URL::asset('assets/css/bootstrap/bootstrap.min.css') }}" type="text/css" rel="stylesheet" />
	<link href="{{ URL::asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" type="text/css" rel="stylesheet" />
	<link href="{{ URL::asset('assets/css/fonts.css') }}" type="text/css" rel="stylesheet" />	
	<link href="{{ URL::asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/mobile/main.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/mobile/menu.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/mobile/mobile.css') }}" type="text/css" rel="stylesheet" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="{{ URL::asset('assets/js/bootstrap/html5shiv.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/bootstrap/respond.min.js') }}"></script>
	<![endif]-->
	@yield('pageCSS')
  </head>

  <body>
	<div class="container">
		@include('frontend.mobile.layout.header')
		{{ $content or '' }}
		@yield('content')
	</div>
	<div class="scroll-to-top">
		<i class="fa fa-chevron-up"></i>
	</div>
	@include('frontend.mobile.layout.footer')
	<script src="{{ URL::asset( 'assets/js/jquery-1.11.3.min.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset( 'assets/js/bootstrap/bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset( 'assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset( 'assets/js/main.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
	toastr.options.positionClass = 'toast-center-center';
	@if(Session::has('flash_success'))
	toastr.success("{{Session::pull('flash_success')}}", 'Message');
	@elseif(Session::has('flash_error'))
	<?php
	    $errorArr = (array)Session::get('flash_error');
	    $error = '';
	    foreach($errorArr as $err){
	        $error .= '<p>'.$err.'</p>';
	    }
	?>
	toastr.error("{{ $error }}", 'Error');
	@endif
	if (window.location.href.indexOf('#login') != -1) {
	    $('#login').modal('show');
	 }
	</script>
	@yield('pageJS')
  </body>
</html>