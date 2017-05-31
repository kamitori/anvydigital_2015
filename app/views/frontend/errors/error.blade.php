@if( $code === 404 )
<div class="page-404">
	<div class="page-inner">
		<img src="{{ URL.'/assets/images/others/earth.jpg' }}" class="img-responsive" alt="">
	</div>
	<div class="container error-404">
		<h1>404</h1>
		<h2>Houston, we have a problem.</h2>
		<p>
			 Actually, the page you are looking for does not exist.
		</p>
	</div>
</div>
@section('pageCSS')
<style type="text/css">
.page-404 {
	background-color: #000;
}
.page-404 .img-responsive {
	margin-left: 26%;
}
.page-404 .error-404 {
	color: #fff;
	text-align: left;
	padding: 70px 20px 0;
	position: absolute;
	top: 215px;
	background-color: transparent;
}
.page-404 h1 {
	color: #fff;
	font-size: 130px;
	line-height: 160px;
}
.page-404 h2 {
	color: #fff;
	font-size: 30px;
	margin-bottom: 30px;
}
@media (max-width: 767px) {
	.page-404 {
		background-color: #000;
	}
	.page-404 .img-responsive {
		margin-left:0;
	}
	.page-404 .error-404 {
		color: #fff;
		text-align: left;
		padding: 5px;
		position: absolute;
		top: 80px;
		background-color: transparent;
	}
	.page-404 h1 {
		color: #fff;
		font-size: 500%;
		line-height: 80px;
	}
	.page-404 h2 {
		color: #fff;
		font-size: 150%;
		margin-bottom: 30px;
	}
}
</style>
@stop
@endif
