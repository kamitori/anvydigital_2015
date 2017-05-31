<div class="row ds-main-box">
<div id="loading_wait" style="width:160px; margin:125px 0 0 1264px; position:absolute;display:none;float:right;">
	<img src="{{URL}}/assets/designonline/images/ajax-loader.gif" alt="title" />
	<span> Loading ...</span>
</div>
<div class="null cf">
	<article id="bundleBody" class="cp designawall">
		<section id="navBarContainer">
			<div class="breadcrumb" style="height: 37px;">
			    <div class="col-md-10 col-md-offset-1 alignfix">
			        <span class="breadcumb-links"><a href="{{ URL }}">Home</a></span><span class="caret-right" style="margin-bottom: 2px"></span>
        			<span class="breadcumb-links">Design</span><span class="caret-right" style="margin-bottom: 2px"></span>
        			<span class="breadcumb-links"><a href="#">{{ $product['name'] }}</a></span><span class="caret-right" style="margin-bottom: 2px"></span>
        			<span class="breadcumb-links"><a href="#">{{ isset($product['jt_products'][0]['name'])?$product['jt_products'][0]['name']:'Custom product'; }}</a>
			    </div>
			<div id="actionContainer" style="margin-right: 2%;">
				<span>Wrap type: </span>
				<span id="name_wrap" style="font-weight:bold;color:red;">
				</span>
				<span>Total Price: $</span><span id="name_price" style="font-weight:bold;color:red;"> {{ Product::viFormat($product['sell_price']) }} </span>
				<a id="addToCartLink" class="primaryButton" onclick="Main.addCart()">{{ isset($product['cart_id']) ? 'Update' : 'Add to'}} Cart</a><a id="returnToCartLink" class="primaryButton hidden">Return to Cart</a>
			</div>
		</section>
		<section id="contentContainer" style="min-height:750px;">
			<div id="paletteContainer">
				<div id="paletteContent">
					<div class="headerLine"></div>
					<div id="paletteContentUploads"  class="paletteContent viSTPWide">
						<div class="large-3 columns" >
							<img id="import_vi" src="/assets/designonline/images/social_icon/button-vi.png" style="width:100%;" alt="import_vi" title="From VI library" />
						</div>
						<div class="large-3 columns">
							<img id="import_mpc" src="/assets/designonline/images/social_icon/mypc-upload.jpg" alt="import_mpc" style="width:100%;" title="Upload From PC" />
						</div>
						<div class="large-3 columns">
							<img id="import_fb" src="/assets/designonline/images/social_icon/button-facebook.png" alt="import_fb" style="width:100%;" title="Facebook" />
						</div>
						<div class="large-3 columns">
							<img id="import_flickr" src="/assets/designonline/images/social_icon/button-flickr.png" alt="import_flickr" style="width:100%;" title="Upload From Facebook" />
						</div>
						<div class="large-3 columns" style="clear:left;">
							<img id="import_dropbox" src="/assets/designonline/images/social_icon/button-dropbox.png" alt="import_dropbox" style="width:100%;" title="Upload From DropBox" />
						</div>
						<div class="large-3 columns">
							<img id="import_googledrive" src="/assets/designonline/images/social_icon/button-googledrive.png" alt="import_googledrive" style="width:100%;" title="Upload From Google Driver" />
						</div>
						<div class="large-3 columns">
							<img id="import_picasa" src="/assets/designonline/images/social_icon/button-picasa.png" alt="import_picasa" style="width:100%;" title="Upload From Picasa" />
						</div>
						<div class="large-3 columns">
							<img id="import_skydrive" src="/assets/designonline/images/social_icon/button-skydrive.png" alt="import_skydrive" style="width:100%;" title="Upload From Skydrive" />
						</div>
						<div class="large-3 columns" style="clear:left;">
							<img id="import_instagram" src="/assets/designonline/images/social_icon/button-instagram.png" alt="import_instagram" style="width:100%;" title="Upload From Instagram" />
						</div>
						<form id="upload_file" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
							<input type="file" name="upload_file[]" id="fileup" style="visibility: hidden;"  />
							<input type="submit" value="Upload" id="upload_file_bt" />
						</form>
						<div id="loading_none" style="display:none;">
							<img src="{{URL}}/assets/designonline/images/loading.gif" alt="title" />Loading ...
						</div>
						<div id="loading_import" style="display:none;margin-top:20px;">
							<img src="{{URL}}/assets/designonline/images/loading.gif" alt="title" />Loading ...
						</div>
						<div id="dialog" title="Import Image" style="display:none;width:800px;">
							<h3 class="of_album">List Album</h3>
							<div id="search_dialog" style="display:none">
								<div class="lib_box_search">
									<form id="searchByTag" action="javascript:void(0)">
										<input name="searchlib_text" id="searchlib_text" type="text" placeholder="Search by tags" />
										<input id="searchlib_bt" type="button" value=" Search " />
									</form>
								</div>
								<button onclick="Main.chooseImages()">Choice Images</button>
							</div>
							<div id="list_album" class="of_album">
							</div>
							<div id="list_image">
							</div>
						</div>
					</div>
					<div id="dialog_resolution" title="Resolution Image" style="display:none;width:800px;"></div>
					<!-- Products -->
					<div id="paletteContentProducts"  class="paletteContent active">
						@foreach($product['jt_products'] as $p)
						<a href="#" data-id="{{ $p['jt_id'] }}">
							<div id="bundle-203" class="bundle bundle_203 noHiRes" style="margin-top:0px;">
								<div style="height:200px">
									<img src="{{ $p['image'] }}">
								</div>
								<label class="bundlename">{{ $p['name'] }}</label>
							</div>
						</a>
						@endforeach
					</div>
					<div id="paletteContentDesigns"  class="paletteContent">
					</div>
					<div id="paletteContentOptions"  class="paletteContent">
						<div class="col-md-12 bg_gray alignfix" id="product-infomation">
            				<input type="hidden" id="product_id" name="product_id" value="{{ $product['id'] }}" />
							<input type="hidden" id="_id" name="_id" value="" />
				            <table class="table ds-size-table">
				                <thead>
				                    <tr>
				                        <td>
				                            <span class="pricing_lable">Size (<i>inches</i>)</span><br />
				                            Width: <input type="text" class="size min-w" name="sizew" id="size-w" value="" /> Height: <input type="text" class="size min-w" name="sizeh" id="size-h" value="" /></td>
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
				            <div class="panel panel-default ds-opt-table">
				                <div class="panel-heading">
				                    <h3 class="panel-title label">Options for Each Print</h3>
				                </div>
				                <ul class="list-group" id="option-list" style="min-height: 300px;" >
				                </ul>
				            </div>
				        </div>
					</div>
					<div id="paletteContentText"  class="paletteContent">
						<div class="col-md-12 alignfix" id="product-infomation" style="background-color:#f8f8f8;padding-left: 15px;">
							<table class="table ds-size-table">
				                <thead>
				                    <tr>
				                        <td colspan="2">
				                        	<table style="width: 100%;">
				                        		<tr>
				                        			<td>
				                        				<p><b>Text</b></p>
				                        			</td>
				                        			<td class="text-right">
				                        				<button type="button" title="Delete text" class="btn btn-danger" onclick="Design.deleteText()"><i class="fa fa-times"></i></button>
				                        			</td>
				                        		</tr>
				                        	</table>
				                        <textarea class="text-content" style="resize: none;"></textarea>
				                    </tr>
				                    <tr>
				                    	<td colspan="2"><p>Font size: (<span class="font-size-value">12</span>px)</p>
			                            <div class="font-size ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" style="margin: 0px 4px 4px 16px;"  aria-disabled="false">
											<div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-max" style="height: 100%;"></div>
											<a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="bottom: 0%;"></a>
										</div>
			                        </tr>
				                    <tr>
				                    	<td colspan="2"><p>Font family:</p>
			                          	<select class="font-family form-control">
			                          		<option value="Arial">Arial</option>
			                          		@foreach($fonts as $font)
			                          		<option value="{{ $font['name'] }}">{{ $font['name'] }}</option>
			                          		@endforeach
			                          	</as>
			                          	</td>
			                        </tr>
			                         <tr>
				                    	<td colspan="2"><p>Font weight: (<span class="font-weight-value">400</span>)</p>
			                            <div class="font-weight ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" style="margin: 0px 4px 4px 16px;"  aria-disabled="false">
											<div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-max" style="height: 100%;"></div>
											<a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="bottom: 0%;"></a>
										</div>
			                        </tr>
			                        <tr>
				                    	<td style="width:50%" ><p>Fill color:</p>
			                          		<div class="choice-color" data-text-id="color" data-text-color="#000" style="background-color:#000;"></div>
			                          	</td>
				                    	<td style="width:50%" ><p>Stroke:</p>
				                    		<div class="choice-color" data-text-id="stroke" data-text-color="#000" style="background-color:#000;"></div>
			                          	</td>
			                        </tr>
			                        <tr>
				                    	<td colspan="2"><p>Stroke width: (<span class="stroke-width-value">0</span>px)</p>
				                            <div class="stroke-width ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" style="margin: 0px 4px 4px 16px;"  aria-disabled="false">
												<div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-max" style="height: 100%;"></div>
												<a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="bottom: 0%;"></a>
											</div>
										</td>
			                        </tr>
			                        <tr>
				                    	<td>
				                    		<button class="btn btn-info add-path" onclick="EPath.addPath()" style="display:block;">Add Text path </button>
				                    		<button class="btn btn-warning apply-path" onclick="EPath.applyPath()" style="display:none;"> Apply Text path </button>
				                    	</td>
				                    	<td>
				                    		<button class="btn btn-danger remove-path" onclick="EPath.removerPath()" style="display:block;"> Remove Text path </button>
				                    	</td>
				                    </tr>
				                </thead>
				            </table>
						</div>
					</div>
					<div id="paletteContentFilters"  class="paletteContent" style="padding-left: 13px;">
						@foreach(['original' => 'Original', 'sepia' => 'Sepia', 'grayscale' => 'Grayscale'] as $key => $filter)
						<div class="step3-options " style="display: block;">
							<label for="opfilter_{{ $key }}">
								<ul>
									<li class="col1">
										<input type="radio" id="opfilter_{{ $key }}" name="filter_type" value="{{ $key }}" onclick="Design.filter('{{ $key }}');">
										<span><b>{{ $filter }}</b></span>
									</li>
									<li class="col2">
										<div class="float-L thumb-img item_{{ $key }}"></div>
									</li>
								</ul>
							</label>
						</div>
						@endforeach
					</div>
					<div id="paletteContentBackgrounds" class="paletteContent" style="padding-left: 13px;padding-top: 15px;">
						@foreach($systemBackgrounds as $bg)
						<div class="backgroundCategory active" id="background-gray" onclick="Main.changeBackgound(this)">
							<div class="assetCategoryLabel"></div>
							<img src="{{ $bg }}" class="paletteBgThumbnail" style="width:150px; height: auto !important;" />
						</div>
						@endforeach

						<button class="nicebt" onclick="$('#background-upload').click();">Add your background images</button>
						<input type="file" style="display:none" id="background-upload" />
						<div id="user-background">
							@foreach($userBackgrounds as $bg)
							<div class="backgroundCategory" onclick="Main.changeBackgound(this)">
								<div class="assetCategoryLabel"></div>
								<img src="{{ $bg }}" class="paletteBgThumbnail" style="width:150px; height: auto !important;" />
							</div>
							@endforeach
						</div>
					</div>
					<!-- Pick color -->
					@if( $product['wrap_option'] !== false )
					<div id="paletteContentOptions"  class="paletteContent" style="padding-left: 13px;padding-top: 15px;">
						@foreach($product['options'] as $wrap)
						@if( $wrap['option_group_id'] == $product['wrap_option'] )
						<div id="opbox_{{ $wrap['key'] }}" class="step3-options" style="display: block;">
							<label for="opstyle_{{ $wrap['key'] }}">
								<ul>
									<li class="col1">
										<input type="radio" id="opstyle_{{ $wrap['key'] }}" name="frame_style" value="{{ $wrap['key'] }}" onclick="Main.changeWrap('{{ $wrap['key'] }}', '{{ $wrap['name'] }}')" title="{{ $wrap['name'] }}" {{ $product['layout']['wrap'] == $wrap['key'] ? 'checked' : '' }} />
										<span><b>{{ $wrap['name'] }}</b></span>
									</li>
									<li class="col2">
										<div class="float-L thumb-img item_{{ $wrap['key'] }}"></div>
										<p class="price"></p>
									</li>
								</ul>
							</label>
						</div>
						@endif
						@endforeach
					</div>
					@endif
					<!-- Pick color -->
					<div id="pick_color" class="paletteContent" style="padding-left: 13px;padding-top: 15px;">
						<button type="button" class="close_picker" onclick="ColorPicker.close()">×</button>
						<div class="ChooseColor">
							<div>Create your own colour</div>
							<div id="pickcolorbox">
								<div class="picker">
								    <div class="picker-colors">
								        <div class="picker-colorPicker"></div>
								    </div>
								    <div class="picker-hues">
								        <div class="picker-huePicker"></div>
								    </div>

								    <div class="picker_color_rgb">
								        <div align="center" class="picker_t_rgb">
								            <span>R</span><br>
								            <input type="text" value="" id="colorR" maxlength="3">
								        </div>
								        <div align="center" class="picker_t_rgb">
								            <span>G</span><br>
								            <input type="text" value="" id="colorG" maxlength="3">
								        </div>
								        <div align="center" class="picker_t_rgb">
								            <span>B</span><br>
								            <input type="text" value="" id="colorB" maxlength="3">
								        </div>
								    </div>

								    <div class="picker_color_hsv">
								        <div align="center" class="picker_t_hsv">
								            <span>H</span><br>
								            <input type="text" value="" id="colorH" maxlength="3">
								        </div>
								        <div align="center" class="picker_t_hsv">
								            <span>S</span><br>
								            <input type="text" value="" id="colorS" maxlength="3">
								        </div>
								        <div align="center" class="picker_t_hsv">
								            <span>V</span><br>
								            <input type="text" value="" id="colorV" maxlength="3">
								        </div>
								    </div>

								    <div class="picker_color_cmyk">
								        <div align="center" class="picker_t_1">
								            <span>C</span><br>
								            <input type="text" value="" id="colorC" maxlength="3">
								        </div>
								        <div align="center" class="picker_t_1">
								            <span>M</span><br>
								            <input type="text" value="" id="colorM" maxlength="3">
								        </div>
								        <div align="center" class="picker_t_1">
								            <span>Y</span><br>
								            <input type="text" value="" id="colorY" maxlength="3">
								        </div>
								        <div align="center" class="picker_t_1">
								            <span>K</span><br>
								            <input type="text" value="" id="colorK" maxlength="3">
								        </div>
								    </div>

								</div>
							</div>
							<div id="divPMS">
								<div id="Matchingto">
									<div class="choiced_color_box">
										<div class="choiced_color_img picker_h" style="background-color:#ffffff;" id="colorbg"></div>
										<div class="choiced_color_text" style="width: 150px;">HEX: <input type="text" value="121212" id="colorhex" maxlength="6" style="width: 100px;" /> </div>
									</div>
								</div>
							</div>
							<div class="choiced_color_box" style="border:none;">
								<button id="btnChooseColorFromImg" type="button" class="btn btn-default cf-btn-colorPicker">
								<span class="cf-btn-colorPicker-icon"></span>
								<span class="cf-btn-colorPicker-text LocalizedStrings" data-localizedstringname="WrapColorPickerButton">Choose a colour<br>from your photo...</span>
								</button>
							</div>
							<div class="choiced_color_box" style="border:none;">
								<button id="btnChooseColor" type="button" class="btn btn-default cf-btn-colorPicker" onclick="ColorPicker.close()">
								<span>Choose Color</span>
								</button>
							</div>
						</div>

					</div>

				</div>
			</div>
			<div id="paletteLabels">
				<div id="paletteLabelUploads" data-label-for="paletteContentUploads" class="paletteLabel" style="height: 110px;">
					<div style="width: 100px; left:-34px; top: 29px;" class="noIe8 lblUploads">Uploads</div>
				</div>
				<div id="paletteLabelProducts" data-label-for="paletteContentProducts" class="paletteLabel active" style="height: 110px;">
					<div style="width: 100px; left:-34px; top: 29px;" class="noIe8 lblProducts">Products</div>
				</div>
				<div id="paletteLabelDesigns" data-label-for="paletteContentDesigns" class="paletteLabel" style="height: 110px; display: none;">
					<div style="width: 100px; left:-34px; top: 29px;" class="noIe8 lblProducts">Designs</div>
				</div>
				<div id="paletteLabelOptions" data-label-for="paletteContentOptions" class="paletteLabel " style="height: 110px;">
					<div style="width: 100px; left:-34px; top: 25px;" class="noIe8 lblOptions">Options</div>
				</div>
				<div id="paletteLabelFilters" data-label-for="paletteContentFilters" class="paletteLabel" style="height: 85px;">
					<div style="width: 100px; left:-34px; top: 6px;" class="noIe8 lblFilters">Filters</div>
				</div>
				<div id="paletteLabelLayouts" data-label-for="paletteContentLayouts" class="paletteLabel " style="height: 84px;display:none">
					<div style="width: 54px; left: -14px; top: 34px;" class="noIe8 lblLayouts">Layouts</div>
				</div>
				<div id="paletteLabelBackgrounds" data-label-for="paletteContentBackgrounds" class="paletteLabel " style="height: 120px;display:none">
					<div style="width: 90px; left: -32px; top: 52px;" class="noIe8 lblBackgrounds">Backgrounds</div>
				</div>
				@if( $product['wrap_option'] !== false )
				<div id="paletteLabelOptions" data-label-for="paletteContentOptions" class="paletteLabel" style="height: 90px;">
				 	<div style="width: 54px; left: -11px; top: 40px;" class="noIe8 lblOptions">Options</div>
			  	</div>
				@endif
			</div>
			<div id="editPageContainer" class="svg edit" style="width: 75%;min-height:100px;">
				<div id="editAreaToolBar" style="width: 100%;">
					<div class=" slider_bt" style="position: absolute; margin: 100px 1px 1px 0px; display: block; z-index:5;background:transparent;">
						<p style="width: 37px;font-family:verdana;">Rotate</p>
						<input type="text" id="amount" style="width: 36px;color:#f6931f;font-weight:bold;">
						<div id="slider-vertical" style="  margin: 8px 4px 4px 13px;" class="ui-slider ui-slider-vertical ui-widget ui-widget-content ui-corner-all" aria-disabled="false">
							<div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-max" style="height: 100%;"></div>
							<a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="bottom: 0%;"></a>
						</div>
					</div>
					<div class=" slider_bt" style="position: absolute;   margin: 300px 1px 1px 0px; display: block;">
						<p style="width:45px;font-family:verdana;background:transparent;">Zoom</p>
						<div id="zoom-slider" style="margin: 0px 4px 4px 16px;" class="ui-slider ui-slider-vertical ui-widget ui-widget-content ui-corner-all" aria-disabled="false">
							<div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-max" style="height: 100%;"></div>
							<a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="bottom: 0%;"></a>
						</div>
					</div>
					<div id="image_bt" class="ds_tool_group ds_border_right" style="">
						<div id="dsbt_filter" class="ds_button dsbt">
							<div class="ds_button_icon" style="color:green;"><i class="fa fa-fw fa-filter"></i></div>
							<div class="ds_button_name">Filter</div>
						</div>
						<div class="ds_button" onclick="Design.rotate()">
							<div class="ds_button_icon"><i class="fa fa-fw fa-repeat"></i></div>
							<div class="ds_button_name">Rotate Image</div>
						</div>
						<div class="ds_button" onclick="Design.flipX()">
							<div class="ds_button_icon"><i class="fa fa-fw fa-sort2"></i></div>
							<div class="ds_button_name">Flip X</div>
						</div>
						<div class="ds_button" onclick="Design.flipY()">
							<div class="ds_button_icon"><i class="fa fa-fw fa-sort"></i></div>
							<div class="ds_button_name">Flip Y</div>
						</div>
						<div class="ds_button" onclick="Design.text()">
							<div class="ds_button_icon"><i class="fa fa-fw fa-pencil-square-o"></i></div>
							<div class="ds_button_name">Add text</div>
						</div>
						<div class="ds_button" onclick="Main.resolution()">
							<div class="ds_button_icon"><i class="fa fa-fw fa-flag"></i></div>
							<div class="ds_button_name">Resolution</div>
						</div>
					</div>
					<div id="preview_bt" class="ds_tool_group ds_border_left right" style="display:block">
						<div class="ds_button" onclick="Main.previewBG()">
							<div class="ds_button_icon" style="color:red;"><i class="fa fa-fw fa-eye"></i></div>
							<div class="ds_button_name">Preview All</div>
						</div>
						<div class="ds_button" onclick="Main.preview3D()">
							<div class="ds_button_icon" style="color:red;"><i class="fa fa-fw fa-cube"></i></div>
							<div class="ds_button_name">Preview 3D</div>
						</div>
						<div class="ds_button" onclick="Main.preview()">
							<div class="ds_button_icon" style="color:red;"><i class="fa fa-fw fa-eye"></i></div>
							<div class="ds_button_name" title="Preview with background">Preview</div>
						</div>
						<input type="text" id="img-link" style="display:none" value="">
					</div>
					<div id="zoom_bt" class="ds_tool_group ds_border_left right" style="display:block">
						<div class="ds_button" id="reset_zoom" onclick="Design.resetZoom()" style="display:none">
							<div class="ds_button_icon"><img src="{{URL}}/assets/designonline/images/zoom-reset.png" style="max-width:16px;" /></div>
							<div class="ds_button_name">Reset Zoom</div>
						</div>
						<div class="ds_button" onclick="Design.zoomInAll()">
							<div class="ds_button_icon"><span class="glyph zoom-in"></span></div>
							<div class="ds_button_name">Zoom In all</div>
						</div>
						<div class="ds_button" onclick="Design.zoomOutAll()">
							<div class="ds_button_icon"><span class="glyph zoom-out"></span></div>
							<div class="ds_button_name">Zoom Out all</div>
						</div>
					</div>
					<div id="zoom_bt2" class="ds_tool_group ds_border_left right" style="display:none">
						<div class="ds_button" onclick="Main.zoomInPreview()">
							<div class="ds_button_icon"><span class="glyph zoom-in"></span></div>
							<div class="ds_button_name">Zoom in</div>
						</div>
						<div class="ds_button" onclick="Main.zoomOutPreview()">
							<div class="ds_button_icon"><span class="glyph zoom-out"></span></div>
							<div class="ds_button_name">Zoom out</div>
						</div>
					</div>
				</div>
				<div id="editAreaWorkArea" class="content" style="min-height:400px;max-height:569px;overflow:auto;">
					<div class="canvas_img_thum" style="display:none;height: 100%; width: 100%; padding:0 2% 0 2%;">
						<canvas id="canvas_imgs"></canvas>
					</div>
					<div id="svg_div" style="height: 100%; width: 100%; padding:0 2% 0 2%"></div>
				</div>
				<div id="preview_box" style="display:none; padding:0; overflow: auto">
					<button onclick="Main.preview(false)" style="position: absolute;right: 5%;bottom: 15%;z-index:60;">Close</button>
					<img id="loading-image" src="{{URL}}/assets/designonline/images/loading.gif" alt="title" style="max-height:500px;margin-top: 50px;" />
					<div id="preview_content" style="margin:0;padding:0;border:0px; cursor: pointer;">
					</div>
				</div>
				<div id="tmp_svg" style="display:none; padding:0;/*width:800px;height:400px;position: absolute;background: white;top: 0;left: 0;z-index: 500;*/">
				</div>
			</div>
		</section>
		<section id="picturestripContainer">
			<div id="picturestrip">
				<div class="picturestripBackground">
					<div id="slider_image">
						@foreach($userImages as $image)
						<div class="image_content">
							<img class="photo" src="{{ URL.'/'.$image }}" alt="" onclick="Design.changeImage('{{ URL.'/'.$image }}');">
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</section>
		<div id="dynamicColorOptionsWrapper" class="dynamicColorPopup invisible"></div>
		<div id="dynamicColorTooltip" class="dynamicColorPopup invisible">
			<div class="arrow left"></div>
			<span id="message"><span class="title">Custom Color Palette</span><br>Click a color swatch to choose your own color.</span><span class="close"></span>
		</div>
	</article>
</div>
<div style="display:none">
	<canvas id="main-canvas"></canvas>
	<div id="canvas-collection"></div>
</div>
</div>
@section('pageCSS')
<link href="{{URL}}/assets/designonline/css/font.css" type="text/css" rel="stylesheet" />
<link href="{{URL}}/assets/designonline/css/iconfont.css" type="text/css" rel="stylesheet" />
<link href="{{URL}}/assets/designonline/css/style.css" type="text/css" rel="stylesheet" />
<link href="{{URL}}/assets/designonline/css/style2.css" type="text/css" rel="stylesheet" />
<link href="{{URL}}/assets/designonline/css/design.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="{{URL}}/assets/designonline/css/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="{{ URL::asset( 'assets/css/estimate.css' ) }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset( 'assets/css/nprogress.css' ) }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset( 'assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css' ) }}">

@stop
@section('pageJS')
<script src="{{ URL }}/assets/designonline/js/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript" src="{{URL}}/assets/designonline/js/jquery.filer.min.js"></script>
<script src="{{URL}}/assets/designonline/js/svgjs/svg.js" type="text/javascript" charset="utf-8"></script>
<script src="{{URL}}/assets/designonline/js/svgjs/svg.draggable/svg.draggable.js" type="text/javascript"></script>
<script src="{{URL}}/assets/designonline/js/svgjs/svg.filter/svg.filter.min.js" type="text/javascript"></script>
<script src="{{URL}}/assets/designonline/js/svgjs/svg.foreignobject.js/svg.foreignobject.js" type="text/javascript"></script>
<script src="{{URL}}/assets/designonline/js/pms.js" type="text/javascript" charset="utf-8"></script>
<script src="{{URL}}/assets/designonline/js/rgbcolor.js" type="text/javascript" charset="utf-8"></script>
<script src="{{URL}}/assets/designonline/js/StackBlur.js" type="text/javascript" charset="utf-8"></script>
<script src="{{URL}}/assets/designonline/js/canvg.js" type="text/javascript" charset="utf-8"></script>
<script src="{{URL}}/assets/designonline/js/canvas3d/three.min.js" type="text/javascript" charset="utf-8"></script>
<script src="{{URL}}/assets/designonline/js/canvas3d/requestAnimFrame.js" type="text/javascript" charset="utf-8"></script>
<script src="{{URL}}/assets/designonline/js/canvas3d/OrbitControls.js" type="text/javascript" charset="utf-8"></script>
<script src="{{URL}}/assets/designonline/js/canvas3d/Detector.js" type="text/javascript" charset="utf-8"></script>
<script src="{{ URL::asset( 'assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js' ) }}" type="text/javascript"></script>
<script src="{{ URL::asset( 'assets/js/nprogress.js' ) }}" type="text/javascript" charset="utf-8"></script>
@include('frontend.design.js.main')
@include('frontend.design.js.design')
@include('frontend.design.js.pointer')
@include('frontend.design.js.color_picker')
@include('frontend.design.js.preview_3d')
@include('frontend.design.js.path')
<script type="text/javascript">
	Main.bind();
	ColorPicker.bind();
	Design.setFont({{ json_encode($fonts) }});
</script>
@stop