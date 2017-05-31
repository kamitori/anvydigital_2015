<!-- BANNER PRODUCT -->
<div class="row graybg">
	<div class="col-md-9 alignfixall">
		<div class="productBanner" style="background-image: url(assets/images/banner4.jpg); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
            <img src="assets/images/banner4.jpg" style="display:none;">
        </div>
        <div style="margin-top: -120px; padding-left: 120px; height: 120px;opacity:0.99;" class="product-bannerTextBand"></div>
        <div class="product-banner-text">
            <h1>Traditional Frames</h1>
            <h2 style="margin-top: 0px; max-width: 860px; color: white; width: 860px;" id="bannerDescription">A tasteful touch of tradition.</h2>
        </div>
	</div>
	<div class="col-md-3 alignfix odernow">
		<div class="oderbox">
			<h1 style="color: #E6E6E6; margin-bottom:0px;">Order Now</h1>
			<h2 style="margin-top:0px;">Order direct on loxleycolour.com</h2><br>
			<div>
			    <div style="width: 65%; font-size: 14px;padding-bottom: 20px;">
			        <p style="color: #E6E6E6;">Create your product online.  In a few clicks, your order is placed and ready to be processed.</p>
			    </div>
			</div>
			<input class="inputButton" type="button" value="Order now" title="Please login" id="productLoginButton">
		</div>
	</div>
</div>
<!-- CONTENT PRODUCT -->
<div class="row darkgraybg">
	<div class="col-md-10 col-md-offset-1 alignfix">
		<ul class="product-navigation nav nav-tabs">
            <li class="active"><a href="#overview" data-toggle="tab" aria-expanded="true">Overview</a></li>
            <li class=""><a href="#sizes" data-toggle="tab" aria-expanded="false">Sizes &amp; pricing</a></li>
            <li class=""><a href="#printOptions" data-toggle="tab" aria-expanded="false">Print finishes</a></li>
            <li class=""><a href="#mouldings" data-toggle="tab" aria-expanded="false">Mouldings</a></li>
            <li class=""><a href="#mountOptions" data-toggle="tab" aria-expanded="false">Mounts</a></li>
            <li class=""><a href="#mountLayouts" data-toggle="tab" aria-expanded="false">Layouts</a></li>
            <li class=""><a href="#offers" data-toggle="tab" aria-expanded="false">Offers &amp; samples</a></li>
            <li class=""><a href="#orderNow" data-toggle="tab" aria-expanded="false">Order</a></li>
        </ul>
	</div>
</div>
<div class="row tab-content">
	<div class="col-md-10 col-md-offset-1 alignfix tab-pane" id="overview">
		<div class="header_product_cont">
            <h1>Traditional Frames 1</h1>
            <h2>A tasteful touch of tradition.</h2>
		</div>
		<div class="row" style="margin-left:0;">
			<div class="col-md-3 hotcont">
				<b>In a nutshell</b><br />
Choose a classic style for timeless elegance with a framing collection that embodies traditional framing styles. Flexible, adaptable and at home in any environment, traditional frames offer wide appeal with something for every style of photography and every clients taste<br /><br />
				<b>In a nutshell</b><br />
Choose a classic style for timeless elegance with a framing collection that embodies traditional framing styles. Flexible, adaptable and at home in any environment, traditional frames offer wide appeal with something for every style of photography and every clients taste
			</div>
			<div class="col-md-9">
				<div class="tab_container">
					@for($m=0;$m<8;$m++)
				    <div class="image-gutter fadeout imgitem">
				        <a class="fancybox" data-fancybox-group="overviewGallery" href="assets/images/products/13844498461382562037worleyparsons-edited2.jpg" title="Traditional Frames">
				            <div class="imgbgitem" style="background-image: url(assets/images/products/13844498461382562037worleyparsons-edited2.jpg) 50% 50%;">
				                <img src="assets/images/products/13844498461382562037worleyparsons-edited2.jpg" height="184" style="display:none;">
				                <input type="image" class="iconzoom" src="assets/images/magnifying-glass.png" name="ImageView">
				            </div>
				        </a>
				    </div>
				    @endfor
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-10 col-md-offset-1 alignfix tab-pane" id="sizes">
		<div class="header_product_cont">
            <h1>Traditional Frames 2</h1>
            <h2>A tasteful touch of tradition.</h2>
		</div>
	</div>
	<div class="col-md-10 col-md-offset-1 alignfix tab-pane active" id="printOptions">
		<div class="header_product_cont">
            <h1>Fotospeed Papers</h1>
            <h2>The following Fotospeed print options are available.</h2>
		</div>
		<div class="six-image-div">
			@for($m=0;$m<8;$m++)
		    <div class="imagethumbnailwithdesc fadeout">
		            <a class="fancybox" data-fancybox-group="Fotospeed Papers Gallery" href="assets/images/products/13844498461382562037worleyparsons-edited2.jpg" title="High White Smooth Lite 215gsm">
		                <div class="siximgbgitem" style="background-image: url(assets/images/products/13844498461382562037worleyparsons-edited2.jpg);">
		                    <img src="assets/images/products/13844498461382562037worleyparsons-edited2.jpg" style="display:none;">
		                    <input type="image" class="sixiconzoom" src="assets/images/magnifying-glass.png">
		                </div>
		            </a>
		        <div class="itemtitlepro">
		            <p class="name">High White Smooth Lite 215gsm</p>
		            <p class="desc">A white based subtly textured fine art paper.</p>
		        </div>
		    </div>
		    @endfor
		</div>
	</div>
</div>

@section('pageCSS')
<link href="{{ URL::asset('assets/global/scripts/fancybox/jquery.fancybox-1.3.4.css')}}" media="screen" type="text/css" rel="stylesheet" />
@stop

@section('pageJS')
<script src="{{ URL::asset( 'assets/global/scripts/fancybox/jquery.mousewheel-3.0.4.pack.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset( 'assets/global/scripts/fancybox/jquery.fancybox-1.3.4.pack.js') }}" type="text/javascript"></script>
<script type="text/javascript">
	$(".fancybox").fancybox({
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'titlePosition' 	: 'over',
		'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
			return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
		}
	});
</script>
@stop