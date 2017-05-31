<!-- BANNER PRODUCT -->
<div class="row graybg">
    <div class="col-xs-12 alignfixall">
        <div class="productBanner" style="background-image: url({{ $product['cover']['image'] }}); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;">
            <img src="{{ $product['cover']['image'] }}" style="display:none;">
        </div>
    </div>
    <div class="col-xs-12 alignfix ordernow">
        <div class="orderbox">
            <h1 style="color: #E6E6E6; margin-bottom:0px;">{{ $product['name'] }}</h1>
            <h2 style="margin-top:0px;">{{ $product['short_description'] }}</h2><br>
            @if( !is_object($user) )
            <div>
                <div style="width: 90%; font-size: 14px;padding-bottom: 10px;">
                    <p style="color: #E6E6E6;">Create your product online. Create Estimate online. Please login for these tools.</p>
                </div>
            </div>
            <input class="inputButton" type="button" value=" Login " id="productLoginButton">
            @endif
        </div>
    </div>
</div>
<!-- CONTENT PRODUCT -->
<div class="row darkgraybg">
	<div class="col-xs-12 alignfix" style="padding:0">
		<ul class="product-navigation nav nav-tabs product-navigation-mobile">
            <li class="active"><a href="#overview" data-toggle="tab" aria-expanded="true">Overview</a></li>
            <li class=""><a href="#pricing" data-toggle="tab" aria-expanded="false">Pricing</a></li>
            @if( !empty($product['specification']) )
                <li class=""><a href="#specification" data-toggle="tab" aria-expanded="true">Specifications</a></li>
            @endif
            @if( !empty($product['technical']) )
                <li class=""><a href="#technical" data-toggle="tab" aria-expanded="true">Technical</a></li>
            @endif
            @foreach($product['tabs'] as $tab)
            <li class=""><a href="#tab-{{ $tab['tab']['name_id'] }}" data-toggle="tab" aria-expanded="false">{{ $tab['tab']['name'] }}</a></li>
            @endforeach
        </ul>
	</div>
</div>
<div class="row tab-content">
	<div class="col-sx-12 alignfix tab-pane active" id="overview" style="padding-left:15px; padding-right:10px;">
		<div class="header_product_cont">
            <h1>{{ $product['name'] }}</h1>
            <h2>{{ $product['short_description'] }}</h2>
		</div>
		<div class="row" style="padding-left: 0;padding-right: 0;">
			<div class="col-xs-12 hotcont">
				{{ $product['description'] }}
				@if( !empty($product['working_time']) )
				<br /><br /><b>Production Time</b><br />
				{{ $product['working_time'] }}<br /><br />
	            @endif
	            @foreach($product['tabs'] as $tab)
	            <br><a style="color: black; text-decoration: underline; font-weight: bold;" href="#tab-{{ $tab['tab']['name_id'] }}" data-toggle="tab" >{{ $tab['tab']['name'] }}</a><br />
	            @foreach($tab['groups'] as $key => $group)
	            {{ $key ? ', '.$group['name'] : '' }}
	            @endforeach
	            @endforeach

			</div>
			<div class="col-xs-12" style="padding:20px 0 0 0">
				<div class="tab_container">
                    @if( !empty($product['pinterest']) )
                    <div class="item-pinterest  col-md-4 col-xs-12">
                        <a data-pin-do="embedBoard" href="{{ $product['pinterest'] }}" data-pin-scale-width="65" data-pin-scale-height="277" data-pin-board-width="400"></a>
                    </div>
                    @endif
					@foreach($product['overview'] as $overview)
				    <div class="image-gutter fadeout imgitem  col-md-4 col-xs-6">
				        <a class="fancybox" data-fancybox-group="Product Gallery" rel="image-group-name" href="{{ $overview['image'] }}" title="{{ $product['name'] }}">
				            <div class="imgbgitem" style="background: url({{ $overview['thumb'] }}) 50% 50%;">
				                <img src="{{ $overview['thumb'] }}" style="display:none;">
				                <!-- <input type="image" class="iconzoom" src="{{ URL }}/assets/images/magnifying-glass.png" name="ImageView"> -->
				            </div>
				        </a>
				    </div>
				    @endforeach
				</div>
			</div>
		</div>
	</div>
    @if( !empty($product['specification']) )
    <div class="col-xs-12 alignfix tab-pane" id="specification">
        {{ $product['specification'] }}
    </div>
    @endif
    @if( !empty($product['technical']) )
    <div class="col-xs-12 alignfix tab-pane" id="technical">
        {{ $product['technical'] }}
    </div>
    @endif
	@foreach($product['tabs'] as $tab)
        <!-- Quick design -->
        @if($tab['tab']['id']==9)
        <div class="col-xs-12 alignfix tab-pane" id="tab-{{ $tab['tab']['name_id'] }}">
            <div class="header_product_cont">
                <h1>Order using Design Online Tools</h1>
                <h2>A quick design tools of AnvyDigital</h2>
            </div>
            <div class="col-md-3 ordernow-last-div" style="width: 276px; height: 350px;float:left;">
                <h1 style="font-size: 24px;margin-bottom: 30px;"> Choose one product</h1>
                <div style="margin-bottom:10px;"><a href="{{ $designLink }}" class="inputButton" data-attr-id="2"> Quick Design </a></div>
            </div>
        </div>
        @endif
        <div class="col-xs-12 alignfix tab-pane" id="tab-{{ $tab['tab']['name_id'] }}">
        	@foreach($tab['groups'] as $group)
    		<div class="header_product_cont">
                <h1>{{ $group['name'] }}</h1>
                <h2>{{ $group['description'] }}</h2>
    		</div>
    		<div class="six-image-div">
    			@foreach( $group['options'] as $option )
    			<div class="imagethumbnailwithdesc fadeout col-md-2 col-xs-12">
    		            <a class="fancybox" data-fancybox-group="{{$group['name']}} Gallery" href="{{ $option['images']['image'] }}" title="{{ $option['name'] }}">
    		                <div class="siximgbgitem" style="background-image: url({{ $option['images']['thumb'] }});">
    		                    <img src="{{ $option['images']['thumb'] }}" style="display:none;">
    		                    <!-- <input type="image" class="sixiconzoom" src="{{ URL }}/assets/images/magnifying-glass.png"> -->
    		                </div>
    		            </a>
    		        <div class="itemtitlepro">
    		            <p class="name">{{ $option['name'] }}</p>
    		            <p class="desc">{{ $option['description'] }}</p>
    		        </div>
    		    </div>
        		@endforeach
    		</div>
        	@endforeach
    	</div>
    @endforeach

    <div class="{{ is_object($user)?'col-xs-12 bg_gray':'col-xs-12 alignfix'}} tab-pane" id="pricing">
        @if( is_object($user) )
        @if (empty($product['jt_products']))
        <div class="col-md-12">
            <div class="no-price-default">
                <p>For more pricing information on this product, please contact one of our representatives at 403.291.2244</p>
            </div>
        </div>
        @endif
        <div class="col-md-3" style="padding-left:0; padding-right:0;">
            <table class="table">
                <tr>
                    <td>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title label">Products</h3>
                            </div>
                            <div class="list-group" id="product-list" style="min-height: 300px;">
                                @foreach($product['jt_products'] as $p)
                                <a href="javascript:void(0)" data-id="{{ $p['jt_id'] }}" class="list-group-item">{{ $p['name'] }}</a>
                                @endforeach
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="col-md-12" style="padding-left:0; padding-right:0;">
                            <img class="img-responsive img-hover img-thumbnail" id="product-image" src="{{ URL.'/assets/images/noimage/no-image.png' }}" alt="" />
                            <h4 id="product-name">Product name</h4>
                            <p>SKU: <span id="product-sku">ANVY-SKU</span></p>
                            <p id="product-description">This is the description of product.</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
		<div class="col-md-5 bg_gray alignfix" id="product-infomation" style="padding-left:0; padding-right:0;">
			<input type="hidden" id="_id" name="_id" value="" />
            <table class="table">
                <thead>
                    <tr>
                        <td>
                            <span class="pricing_lable">Size (<i>inches</i>)</span><br />
                            Width: <input type="text" class="min-w" name="sizew" id="size-w" value="" /> Height: <input type="text" class="min-w" name="sizeh" id="size-h" value="" /></td>
                        <td align="right">
                            <span class="pricing_lable">Quantity</span><br />
                            <input type="text" class="size-w min-w" name="quantity" id="quantity" value="1" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right" style="padding-top:15px;">
                            Number of file to print
                            <input type="text" class="min-w" name="file_qty" id="file_qty" value="1" />
                        </td>
                    </tr>
                </thead>
            </table>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title label">Options for Each Print</h3>
                </div>
                <ul class="list-group" id="option-list" style="min-height: 300px;" >
                </ul>
            </div>
        </div>
        <div class="col-md-4 bg_gray" style="min-height:483px;" id="sum_box">
            <table class="table">
                <thead>
                    <tr>
                        <td align="right">
                            <br />Unit Cost:<br />
                        </td>

                        <td align="right">
                             <br /><b><span id="unit-cost">00.00</span></b>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            Sub Total:<br /><br />
                        </td>
                        <td align="right">
                           <b><span id="sub-total">00.00</span></b>
                        </td>
                    </tr>
                </thead>
            </table>
            <!--
            <button type="button" id="estimate" class="btn btn-primary main-bt">ADD TO ORDER</button>
            <div class="control-group form-group" style="padding-top: 50px;">
                <div class="controls">
                    <textarea rows="12" class="form-control" id="note" name="note" style="border-color: #ddd; resize: none; height: 250px;" placeholder="Additional Information Request"></textarea>
                <div class="help-block"></div></div>
            </div>-->
        </div>
        @else
        <div class="header_product_cont">
            <h1>{{ $product['name'] }}</h1>
            <h2>Size you need not listed? <a href="/pages/contact-us">Click here to contact us for help.</a></h2>
            <div class="price-login-box">
                <div style="margin-bottom:10px;">Pricing - please login or register to view</div>
                <div>
                    <input class="inputButton" type="button" value="Login" id="pricingLoginButton">
                    <a class="inputNoColourButton" href="/pages/join-the-family">Why register?</a>                
                </div>
            </div>
        </div>
        <div class="row homeproduct">
            @foreach($product['jt_products'] as $p)
            @if( !empty($p['image']) )
                <div class="item col-md-3">
                	<!--<a class="fadeout">
                        <img src="{{ $p['image'] }}" alt="" class="proimg" style="width:276px; height:184px" />
                        <h5>{{ $p['name'] }}</h5>
                    </a>-->
                </div>
            @endif
            @endforeach
        </div>
        @endif
    </div>
</div>
@section('pageCSS')
<link rel="stylesheet" type="text/css" href="{{ URL::asset( 'assets/css/estimate.css' ) }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset( 'assets/css/nprogress.css' ) }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset( 'assets/css/fancybox.css')}}" />
@stop
@section('pageJS')
<script type="text/javascript" src="{{ URL::asset( 'assets/js/fancybox.js' ) }}"></script>
<script type="text/javascript" src="{{ URL::asset( 'assets/js/nprogress.js' ) }}"></script>
<script type="text/javascript">
@if( !empty($product['pinterest']) )
$.getScript('http://assets.pinterest.com/js/pinit_main.js');
@endif
$(".fancybox").fancybox({
    prevEffect: 'none',
    nextEffect: 'none',
    closeBtn: true,
    'autoSize': true,
    //'width': '960px',
    //'minWidth': '960px',
    'maxWidth': '960px',
    //'minHeight': '640px',
    'maxHeight': '640px',
    //'height': '640px',
    'autoScale': false,
    'autoDimensions': false,
    fitToView: false,
    helpers: {
        title: { type: 'inside' }
    },
});
$('#productLoginButton, #pricingLoginButton').click(function(){
    window.location.hash = 'pricing';
    @if( !is_object($user) )
    $('a[href="#login"]').trigger('click');
    @endif
});
@if( is_object($user) )
var inProcess = null;
$("#product-list").on("click", "a", function(){
    startLoading();
    if( $(this).attr("data-id") == undefined ){
        stopLoading();
        return false;
    }
    getProductInfo($(this).attr("data-id"));
    $(".list-group-item").removeClass('active');
    $(this).addClass('active');
});
$('#pricing #product-list .list-group-item:first').trigger('click');
$("#option-list").on("change", "input[type=checkbox]", function(){
    checkGroup(this);
    hideExtraInput();
    if( inProcess != null ) {
        clearTimeout(inProcess);
        inProcess = null;
    }
    inProcess = setTimeout(function() {
        calculationProcess()
    }, 500);
});
$("#option-list").on("change", "input[type!=checkbox]", function(){
    if( inProcess != null ) {
        clearTimeout(inProcess);
        inProcess = null;
    }
    inProcess = setTimeout(function() {
        calculationProcess()
    }, 500);
});

function resetInput()
{
    $("#size-w, #size-h, #_id, #size-h, #size-w").val("");
    $("#quantity").val(1);
    $("#unit-cost").text("00.00");
    $("#sub-total").text("00.00");
    $("#estimate").prop("disabled", true);
    $("#product-image").attr("src", "{{ URL.'/assets/images/noimage/no-image.png' }}");
    $("#product-description").html("This is the description of product.");
    $("#product-name").html("Product name.");
    $("#product-sku").html("ANVY-SKU");
    $("#option-list").html("");
}

function getProductInfo(id)
{
    resetInput();
    $.ajax({
        url: "{{ URL.'/product-info' }}",
        type: "POST",
        data: { product_id : id },
        success: function(result) {
            var html = "";
            if(result.status == "ok") {
                $("#_id").val(result.product._id);
                $("#size-h").val(result.product.sizeh);
                $("#size-w").val(result.product.sizew);
                $("#product-description").html(result.product.product_desciption);
                $("#product-image").attr("src",result.product.image);
                $("#product-name").html(result.product.name);
                $("#product-sku").html(result.product.sku);
                for( i in result.product.options ) {
                    customClass = require = hiddenClass = "";
                    _id     = result.product.options[i]._id;
                    hidden  = result.product.options[i].hidden;
                    group   = result.product.options[i].group;
                    name    = result.product.options[i].name;
                    group_type    = result.product.options[i].group_type;
                    group   = result.product.options[i].group;
                    if(group=='')
                        group = 'special';
                    title = 'Group: '+group+'  | Type: '+group_type;
                    if( result.product.options[i].require ){
                        title += ' | Required';
                        if(group_type!='Exc'){
                            require = 'checked onclick="return false;" data-required="1"';
                            customClass = 'class="label_gray"';
                        } else {
                            require = 'checked data-required="1"';
                        }
                        if( $.inArray(_id, ['5284a3ee222aad54140002fa', '5284a42e222aad54140003c1']) != -1 ){
                            // is file
                            hiddenClass = 'hide';
                        }
                    }
                    if(hidden){
                        hiddenClass = 'hide';
                    }
                    html += ['<li id="li-'+_id+'" class="list-group-item '+hiddenClass+'">',
                                '<input type="hidden" name="options['+_id+'][id]" value="'+_id+'" />',
                                '<input id="checkbox-'+_id+'" type="checkbox" '+require+' data-group="'+group+'" data-group-type="'+group_type+'" name="options['+_id+'][choose]" />',
                                '<label '+customClass+' title="'+title+'" for="checkbox-'+_id+'">'+name+'</label>',
                            '</li>',
                                '<input type="text" class="min-w qty_item '+hiddenClass+'" name="options['+_id+'][quantity]" id="qty_item_'+_id+'" value="'+result.product.options[i].quantity+'" />'
                            ].join("");
                    if( !result.product.options[i].same_parent ){
                        display = 'style="display: none"';
                        if( require )
                            display = "";
                        html += ['<li id="extra-checkbox-'+_id+'" '+display+' class="list-group-item text-right '+hiddenClass+'">',
                                'Width <input type="text" class="min-w sizewop" name="options['+_id+'][sizew]" value="'+result.product.sizew+'"> ',
                                'Height <input type="text" class="min-w sizehop" name="options['+_id+'][sizeh]" value="'+result.product.sizeh+'"> ',
                            '</li>'].join("");
                    }
                }
            }
            $("#option-list").html(html);
            $("input[type=text]:first", "#product-infomation").trigger("change");
        }
    });
}
function hideExtraInput(){
    $("input:checked", "#option-list").each(function(){
        var id = $(this).attr("id");
        $("#qty_item_"+id.replace("checkbox-", "")).val(1);
        if( !$("#extra-"+id).length ) return;
        $("#extra-"+id).fadeIn();
    });
    $("input[type=checkbox]:not(:checked)", "#option-list").each(function(){
        var id = $(this).attr("id");
        if($("#li-"+id.replace("checkbox-", "")+" label").attr("class") == 'label_gray')
            return;
        $("#qty_item_"+id.replace("checkbox-", "")).val("");
        if( !$("#extra-"+id).length ) return;
        $("#extra-"+id).fadeOut();
    });
}
function checkGroup(object)
{
    var groupType = $(object).attr("data-group-type");
    if( groupType != "Inc" ) {
        var group = $(object).attr("data-group");
        var id = $(object).attr("id");
        if( $(object).is(":checked") ){
            $("input[data-group='"+group+"']").prop("checked", false);
            $(object).prop("checked", true);
        } else {
            if( $("input[data-group='"+group+"'][data-required=1]").length ){
                if( $("input[data-group='"+group+"']").length == 1 ){
                    $(object).prop("checked", true);
                } else {
                    $("input[data-group='"+group+"']").prop("checked", false);
                    $("input[data-group='"+group+"'][id!="+id+"]:first").prop("checked", true);
                }
            }
        }
    }
}
$("input[type!=checkbox]", "#product-infomation").change(function(){
    calculationProcess();
});
function startLoading()
{
    NProgress.done();
    NProgress.start();
    NProgress.inc();
}
function stopLoading()
{
    NProgress.done();
}
function calculationProcess()
{
    startLoading();
    $("#unit-cost, #sub-total").text("00.00");
    $(".option-price", "#option-list").text("00.00");
    // $("#file-price").text("00.00");
    var data = $("input", "#product-infomation").serialize();
    $.ajax({
        url: "{{ URL.'/product-calculating' }}",
        type: "POST",
        data: data,
        success: function(result) {
            if( result.status == "ok" ) {
                $("#unit-cost").text(result.data.sell_price);
                $("#sub-total").text(result.data.sub_total);
                for( i in result.data.prices ) {
                    $(".option-price", "#li-"+i).text(result.data.prices[i]);
                    // if( i == "5284a3ee222aad54140002fa" || i == "5284a42e222aad54140003c1" ){
                    //     $("#file-price").text(result.data.prices[i]);
                    // } else {
                    //     $(".option-price", "#li-"+i).text(result.data.prices[i]);
                    // }
                }
                calculationView();
            } else {
                toastr.error(result.message, 'Error');
            }
            $("#estimate").prop("disabled", false);
            stopLoading();
        }
    });
}

function calculationView()
{
    var content_width = $("#content_box").width();
    if(content_width>970){
        $("#option-list").css("min-height",'300px');
        $("#product-list").css("min-height",'300px');
        $("#sum_box").css("min-height",'483px');
        var more_height = 0;
        var padding_top = 15;
        var opt_to_top = 184;
        var content_box = $("#content_box").height();
        var sum_box = content_box - padding_top;
        var option_list = sum_box - opt_to_top;
        var product_list = option_list + more_height;
        $("#option-list").css("min-height",option_list+'px');
        $("#product-list").css("min-height",product_list+'px');
        $("#sum_box").css("min-height",sum_box+'px');
    }else{ //mobile
        var minHeight = {'min-height': '150px'};
        $("#option-list").css(minHeight);
        $("#product-list").css(minHeight);
        $("#sum_box").css(minHeight);
    }
}
$('#estimate').click(function(){
    var productDiv = $('#product-infomation');
    if( productDiv.find('#_id').length ) {
        var data = productDiv.find('input').serialize();
        data.note = $('#sum_box #note').val();
        $.ajax({
            url: '{{ URL.'/cart/add' }}',
            type: 'POST',
            data: data,
            success: function(result) {
                if( result.status == 'ok' ) {
                    $('html, body').animate({scrollTop: 0}, 500);
                    $('#cart-quantity').text( result.cart_quantity );
                    toastr.success(result.message, 'Message');
                }
            }
        })
    }
});
@endif
</script>
@stop
