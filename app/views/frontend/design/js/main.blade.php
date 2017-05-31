<script type="text/javascript">
var Main = function (){
	var previewZoom = 1;
	var backgroundImage = '{{ $systemBackgrounds[0] or '' }}';
	var objUpload = {};
	var inUpload = false;
	var uploadNumber = 0;
	var uploading;
	var images = [];


	var svgDesigns = {};
	function bind()
	{
		$("#dialog").on( "dialogclose", function( ) {
		    $("#dialog #search_dialog").hide();
		} );
		$('#fileup').filer({
			limit: 10
		});
		$('#bgfileup').filer({
			limit: 10
		});
		$('.jFiler-input').hide();

		$("#import_mpc").on('click',function(){
			$("#fileup").click();
		});
		$(".nicebt").on('click',function(){
			$("#bgfileup").click();
		});

		$(".dsbt").click(function(){
			var cont = $(this).attr('id');
			cont = cont.replace("dsbt_","content_");
			$(".ds_button").removeClass('ds_active');
			$(this).addClass('ds_active');
			$(".content_list").css("display","none");
			$("#"+cont).css("display","table");
		});

		$("#fileup").change(function(){
			Main.uploadFiles($(this)[0].files);
		});
		$("#bgfileup").change(function(){
			Main.uploadFiles($(this)[0].files);
		});

		$("#btnChooseColorFromImg").click(function(){
			ColorPicker.pick();
		});

		$('.paletteLabel').on('click',function(){
			$('.paletteContent').removeClass('active');
			$('.paletteLabel').removeClass('active');
			$(this).addClass('active');
			$("#"+$(this).attr('data-label-for')).addClass('active');
		});

		$("#getPicturesBtnLarge").on('click',function(){
			$("#dlg-container").show();
		});

		$("#dsbt_filter").on('click',function(){
			$('.paletteContent').removeClass('active');
			$('.paletteLabel').removeClass('active');
			$("#paletteContentFilters").addClass('active');
			$("#paletteLabelFilters").addClass('active');
		});

		$( "#slider-vertical" ).slider({
			orientation: "vertical",
			range: "max",
			step: 5,
			min: 0,
			max: 360,
			value: 0,
			slide: function( event, ui ) {
				$( "#amount" ).val( ui.value);
				Design.rotate(ui.value);
			}
		});
		$( "#amount" ).val( $( "#slider-vertical" ).slider( "value" ) );
		$( "#amount" ).change(function(){
			var val = $( "#amount" ).val();
			$( "#slider-vertical" ).slider('value', val);
			Design.rotate(val);
		});
		$("#zoom-slider").slider({
            orientation: "vertical",
            range: "max",
            step: 0.2,
            min: 1,
            max: 3.6,
            value: 1,
            slide: function( event, ui ) {
				Design.zoom(ui.value);
			}
        });
		$("#amount").keydown(function (e) {
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
				(e.keyCode == 65 && e.ctrlKey === true) ||
				(e.keyCode >= 35 && e.keyCode <= 39)) {
					 return;
			}
			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
			}
		});

		// TEXT
		$('.font-family').change(function(){
			Design.changeText("font", $(this).val());
		});
		$(".font-size").slider({
            orientation: "horizontal",
            range: "min",
            step: 1,
            min: 5,
            max: 80,
            value: 12,
            slide: function( event, ui ) {
				Design.changeText("size", ui.value);
				$(".font-size-value").html(ui.value);
			}
        });
        $(".font-weight").slider({
            orientation: "horizontal",
            range: "min",
            step: 100,
            min: 100,
            max: 900,
            value: 400,
            slide: function( event, ui ) {
				Design.changeText("weight", ui.value);
				$(".font-weight-value").html(ui.value);
			}
        });
        $(".stroke-width").slider({
            orientation: "horizontal",
            range: "min",
            step: 0.5,
            min: 0,
            max: 5,
            value: 0,
            slide: function( event, ui ) {
				Design.changeText("stroke-width",ui.value);
				$(".stroke-width-value").html(ui.value);
			}
        });

		$('#import_vi').click(function(){
		    getImages();
		});
		$('#searchByTag').submit(function(){
		    var tags = $('#searchlib_text').val();
		    getImages(tags);
		});

		$('#background-upload').change(function(){
			var data = new FormData();
			data.append('background', $(this)[0].files[0]);
			$.ajax({
				url: '{{ URL }}/design/put-background',
				type: 'POST',
				data: data,
				processData: false,
				contentType: false,
				success: function(result){
					if( result.url ) {
						$('.backgroundCategory.active').removeClass('active');
						var html = '<div class="backgroundCategory" onclick="Main.changeBackgound(this)" style="width:150px; height: auto !important;">' +
										'<div class="assetCategoryLabel"></div>' +
										'<img src="'+ result.url +'" class="paletteBgThumbnail" style="width:150px;height:auto;" />' +
									'</div>';
						$('#user-background').append(html);
						$('#user-background .backgroundCategory:last img').load(function(){
							$(this).parent().trigger('click');
						});
					}
				}
			})
		});

		$("#paletteContentProducts").on("click", "a", function(){
		    startLoading();
		    if( $(this).data('id') == undefined ){
		        stopLoading();
		        return false;
		    }
		    $("#paletteContentProducts a.active").removeClass('active');
		    $(this).addClass('active');
		    getProductInfo($(this).data('id'));
		});

		$('#paletteContentProducts a:first').trigger('click');

		$("#paletteContentDesigns").on("click", "a", function(){
		    startLoading();
			if( $("#paletteContentDesigns a.active").length ) {
				var currentId = $("#paletteContentDesigns a.active").data('id');
				if( svgDesigns[ currentId ] == undefined ) {
					svgDesigns[ currentId ] = {};
				}
				svgDesigns[ currentId ].svgSetup = Design.svgSetup();
			}
		    if( $(this).data('id') == undefined ){
		        stopLoading();
		        return false;
		    }
		    $("#paletteContentDesigns a.active").removeClass('active');
		    $(this).addClass('active');
		    var currentId = $(this).data('id');
		    if( svgDesigns[ currentId ].svgSetup ) {
		    	Design.svgSetup( svgDesigns[ currentId ].svgSetup );
		    	Design.draw();
		    } else {
		    	Design.resetSetup(svgDesigns[ currentId ].layout, svgDesigns[ currentId ].shapes);
		    }
		    stopLoading();
		});

		$('#paletteContentOptions .size').change(function(){
			var width = $('#paletteContentOptions #size-w').val();
			var height = $('#paletteContentOptions #size-h').val();
			if( !Object.keys(svgDesigns).length ) {
				Design.size(width, height);
			}
		});

		$("#option-list").on("change", "input[type=checkbox]", function(){
		    checkGroup(this);
		    hideExtraInput();
		    calculationProcess();
		});

		$("input[type!=checkbox]", "#product-infomation").change(function(){
		    calculationProcess();
		});

		$('#svg_div').click(function(event){
			var target = $(event.target);
			if( !target.is('text') && !target.is('tspan') ) {
				if( Design.addText ) {
					Design.addText = false;
				} else if( $('#paletteContentText').is(':visible') ) {
					Main.onOffText('off');
				}
			}
		});

		Main.textPanel.find('textarea').keyup(function(){
			Design.changeText('text', $(this).val());
		});

		// $('.colorpicker-default').colorpicker({
		//     format: 'hex',
		//     color: '#fff',
		// }).on('changeColor.colorpicker', function(event){
		// 	var color = event.color.toHex();
		// 	$(this).data('color', color)
		// 			.css('background-color', color);
		// 	if( !event.setValue ) {
		// 		Design.changeText($(this).data('id'), color);
		// 	}
		// });
		$('.choice-color').click(function(){
			$('.paletteContent').removeClass('active');
			$('#pick_color').addClass('active');
			$("#pick_color").attr("rel",$(this).data('text-id'));
		});
	}

	function getImages(tags)
	{
		var data = {};
	    if( tags ) {
	        data['tags'] = tags;
	    }
		 $.ajax({
			url: "{{ URL.'/design/get-images' }}",
			type: 'POST',
			data: data,
			success: function(result) {
				var html = '';
				if( result.length ) {
			  	for(var i in result) {
				  	html += '<div class="large-2 columns block_album">' +
							  '<div class="block_image" id="block_image_'+ result[i].id +'">' +
								  '<img class="cover_album" data-check="0" data-source="'+ result[i].link +'" src="'+ result[i].thumb +'" data-store="'+ result[i].store +'" onclick="Main.choice('+ result[i].id +')" data-ext="'+ result[i].ext +'" />' +
								  '<div class="icon_close5" onclick="Main.removeChoice('+ result[i].id +')"  style="display:none;"></div>'+
							  '</div>' +
						  '</div>';
			  	}
			}
			$("#loading_import").hide();
			$(".of_album").hide();
			$("[text ='List Album']").hide();
			$("#loading_import").hide();
			$("#dialog").dialog({width: 1200,height: 600,modal: true}).dialog("open");
			$("#search_dialog").show();
			$("#list_image").css('max-height','500px').css('height','478px')
					  .html(html);
			}
		});
	}

	function getWH()
	{
		var tmpImage = new Image();
		tmpImage.src = backgroundImage;
		var width = tmpImage.width;
		var height = tmpImage.height;
		var ratio = width / height;
		if( width > 1000 ) {
			width = 1000;
			height = width / ratio;
		}
		if( height > 450 ) {
			height = 450;
			width = height * ratio;
		}
		return {'width': width, 'height': height};
	}

	function preview(callBack, afterRenderCallBack)
	{
		ColorPicker.close();
		Main.previewRenderFinished = false;
		$(".slider_bt").hide();
		previewZoom = 1;
		$('#editAreaWorkArea').css({
			'position': 'absolute',
			'opacity': 0,
			'z-index': '-1000'
		});
		$('#svg-main')[0].instance.addClass('preview');
		if( $('#svg-main .shape-path.active').length ) {
			$('#svg-main .shape-path.active')[0].instance.removeClass('active');
		}
		$('#zoom_bt').hide();
		$('#preview_box').show();
		$('#preview_box #loading-image').show();
		$('#preview_content').html('').hide();
		callBack();
		var timeProcess = 0;
		var interval = setInterval(function() {
			console.log('--Rendering-- '+ (timeProcess/1000).toFixed(2));
			timeProcess+= 200;
			if( timeProcess > 60000 ) {
				clearInterval(interval);
				return false;
			}
			if(!Main.previewRenderFinished) {
				return false;
			}
			if( typeof afterRenderCallBack == 'function' ) {
				afterRenderCallBack();
			} else {
				$('#zoom_bt2').show();
				$('#preview_content').show();
				$('#preview_box #loading-image').hide();
			}
			clearInterval(interval);
		}, 200);
	}

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

	function resetInput()
	{
	    $("#size-w, #size-h, #_id, #size-h, #size-w").val("");
	    $("#quantity").val(1);
	    $("#name_price").text("00.00");
	    $("#estimate").prop("disabled", true);
	    $("#option-list").html("");
	}

	function addDesign(data)
	{
		var html = '';
		for(var i in data) {
			svgDesigns[ data[i].layout.id ] = { 'layout' : data[i].layout, 'shapes' : data[i].shapes  };
			html += '<a href="#" data-id="'+ data[i].layout.id +'">' +
						'<div id="bundle-203" class="bundle bundle_203 noHiRes" style="margin-top:0px;">' +
							'<div style="height:200px">' +
								'<img src="{{ URL }}/'+ data[i].layout.preview +'">' +
							'</div>' +
							'<label class="bundlename">'+ data[i].layout.name +'</label>' +
						'</div>' +
					'</a>';
		}
		$('#paletteContentDesigns').html(html);

		$('#paletteContentDesigns a:first').trigger('click');
	}

	function getProductInfo(id)
	{
	    resetInput();
	    $.ajax({
	        url: "{{ URL.'/product-info' }}",
	        type: "POST",
	        data: { product_id : id, pid: {{ $product['id'] }} },
	        success: function(result) {
	            var html = "";
	            if(result.status == "ok") {
	            	svgDesigns = {};
	            	if( result.product.design && result.product.design.length ) {
	            		addDesign(result.product.design);
	            		$('#paletteLabelDesigns').show().trigger('click');
	            	} else {
	            		$('#paletteLabelDesigns').hide();
	            		$('#paletteLabelOptions').trigger('click');
	            	}
	                $("#_id").val(result.product._id);
	                $("#size-h").val(result.product.sizeh);
	                $("#size-w").val(result.product.sizew);
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

	function calculationProcess()
	{
	    startLoading();
	    $("#unit-cost, #sub-total").text("00.00");
	    $(".option-price", "#option-list").text("00.00");
	    var data = $("input", "#product-infomation").serialize();
	    $.ajax({
	        url: "{{ URL.'/product-calculating' }}",
	        type: "POST",
	        data: data,
	        success: function(result) {
	            if( result.status == "ok" ) {
	                $("#name_price").text(result.data.sub_total);
	                for( i in result.data.prices ) {
	                    $(".option-price", "#li-"+i).text(result.data.prices[i]);
	                }
	            } else {
	                toastr.error(result.message, 'Error');
	            }
	            $("#estimate").prop("disabled", false);
	            stopLoading();
	        }
	    });
	}

	return {
		previewRenderFinished: false,
		textPanel: $('#paletteContentText'),
		bind : function() {
			bind();
			this.findWrap();
		},
		findWrap: function() {
			var wrapName = $('#paletteContentOptions input[type=radio][name=frame_style]:checked').attr('title');
			if( typeof wrapName != undefined ) {
				this.changeWrapName(wrapName);
			}
		},
		changeWrapName: function(wrapName) {
			$('span#name_wrap').text(wrapName);
		},
		changeWrap: function(wrapKey, wrapName) {
			if( wrapName == 'Spot Colour' ) {
				$('.paletteContent').removeClass('active');
				$('#pick_color').addClass('active');
			} else {
				Design.wrap(wrapKey);
			}
			this.changeWrapName(wrapName);
		},
		filter: function(filterKey) {
			$('#paletteContentFilters input[type=radio][name=filter_type][value='+ filterKey +']').prop('checked', true);
		},
		rotate: function(rotate) {
			$('#amount').val(rotate);
			$( "#slider-vertical" ).slider('value', rotate);
		},
		zoom: function(zoom) {
			$('#zoom-slider').slider('value', zoom);
		},
		showSlider: function(show) {
			if( show == false ) {
				$('.slider_bt').hide();
			} else {
				$('.slider_bt').show();
			}
		},
		zoomAll: function(zoom) {
			if( zoom != 1 ) {
				this.showResetZoom();
				$('#reset_zoom').show();
			} else {
				this.showResetZoom(false);
			}
			if( $('#pick_color').is(':visible') ) {
				ColorPicker.pick();
			}
		},
		showResetZoom: function(show) {
			if( show == false ) {
				$('#reset_zoom').hide();
			} else {
				$('#reset_zoom').show();
			}
		},
		preview: function(show) {
			if( show === false ) {
				return this.closePreview();
			}

			preview(function(){
				if( $('#svg-main.preview.preview-bg').length ) {
					$('#svg-main')[0].instance.removeClass('preview')
												.removeClass('preview-bg');
					$('#svg-main.preview.preview-bg .shape-path').each(function(){
						this.instance.unfilter(true);
					});
				}
				$('#paletteLabelBackgrounds, #zoom_bt2').hide();
				$('#paletteLabelArrangements').trigger('click');
				$('#preview_content').mouseover(function(){
					return false;
				});
				var svgSetup = Design.svgSetup();
				var previewAttribute = {
					'id': 'svg-preview',
					'width': svgSetup.main.width,
					'height': svgSetup.main.height,
					'viewBox': '0 0 '+ svgSetup.main.width +' '+ svgSetup.main.height
				};
				var useAttribute = {
					'id': 'use-preview',
					'x': 0,
					y: 0
				};
				Design.resetZoom();
				SVG('preview_content')
					.attr(previewAttribute)
					.use( SVG.get('svg-main') )
					.attr(useAttribute);
				Main.previewRenderFinished = true;
			});
		},
		previewBG: function() {
			preview(function(){
				$('#paletteLabelBackgrounds').show().trigger('click');
				$('#preview_content').unbind('mouseover');
				$('#svg-main')[0].instance.addClass('preview')
											.addClass('preview-bg');
				var size = getWH();
				var svgSetup = Design.svgSetup();
				Design.resetZoom();
				var previewDraw = SVG('preview_content').attr({'id': 'svg-preview', 'width': 1000, 'height': 450});

				$('#svg-main .shape-path').each(function(){
					var defs = SVG.get('main-defs');
					var id = $(this).attr('id').replace('shape-path-', '');
					var shapePath = this;
					if( !$('#shape-clip-'+ id).length ) {
						defs.add( previewDraw.clip()
											.add(
												shapePath.instance.clone()
																	.removeClass('shape-path')
																	.attr('fill', null)
											).attr('id', 'shape-clip-'+ id)
								)
					}
					SVG.get('group-image-'+ id)
						.attr('clip-path', 'url("#shape-clip-'+ id +'")');
				});
				var image = previewDraw.image(backgroundImage)
										.attr({
											'width': size.width,
											'height': size.height,
											'x': 0,
											'y': 0,
											'id': 'preview-background-image'
										})
										.loaded(function(){
											this.draggable();
										});
				previewDraw.add(image)
				var nested = previewDraw.nested()
										.attr({
											'id': 'svg-use',
											'width': svgSetup.main.width/3,
											'height': svgSetup.main.height/3,
											'viewBox': '0 0 '+ svgSetup.main.width +' '+ svgSetup.main.height,
											'x': size.width - svgSetup.main.width/3,
											'y': (size.height - svgSetup.main.height/3)/2,
										});
				nested.draggable({
					minX: 0,
					maxX: size.width,
					minY: 0,
					maxY: size.height
				});
				nested.add(
						nested.use( SVG.get('svg-main') )
						.on('click', function() {
							return false;
						})
						.filter(function(add) {
						  	var blur = add.offset(10, 10).in(add.sourceAlpha).gaussianBlur(5)
  							add.blend(add.source, blur)
						})
					);
				Main.previewRenderFinished = true;
			});
		},
		closePreview: function() {
			$('#paletteLabelBackgrounds, #zoom_bt2').hide();
			$('#paletteLabelArrangements').trigger('click');
			if( $('#svg-main.preview-bg').length ) {
				$('#svg-main')[0].instance.removeClass('preview-bg');
				$('#svg-main.preview.preview-bg .shape-path').each(function(){
					this.instance.unfilter(true);
				});
			}
			if( $('#svg-main.preview').length ) {
				$('#svg-main')[0].instance.removeClass('preview');
			}
			$('#svg-main .main-image').each(function(){
				var id = $(this).attr('id').replace('image-', '');
				SVG.get('group-image-'+ id).attr('clip-path', 'url("#clip-'+ id +'")');
			});
			$('#editAreaWorkArea').css({
				'position': 'relative',
				'opacity': 1,
				'z-index': 0
			});
			$('#preview_box').hide();
			$('#zoom_bt').show();
		},
		zoomInPreview: function() {
			this.zoomPreview(previewZoom+0.2);
		},
		zoomOutPreview: function() {
			this.zoomPreview(previewZoom-0.2);
		},
		zoomPreview: function(zoom) {
			if( zoom == undefined
				|| zoom < 0.5
				|| zoom > 3.6 ) {
				return false;
			}
			previewZoom = zoom;
			if( $('#svg-preview #preview-background-image').length ) {
				SVG.get('svg-preview')
					.attr({
						'width': 1000*zoom,
						'height': 450*zoom,
						'viewBox': '0 0 1000 450'
					});
			} else {
				var svgSetup = Design.svgSetup();
				var width = svgSetup.main.width;
				var height = svgSetup.main.height;
				SVG.get('svg-preview')
					.attr({
						'width': width*zoom,
						'height': height*zoom,
						'viewBox': '0 0 '+ width +' '+ height
					});
			}
		},
		changeBackgound: function(object) {
			$('.backgroundCategory.active').removeClass('active');
			$(object).addClass('active');
			backgroundImage = $('img', object).attr('src');
			var size = getWH();
			SVG.get('preview-background-image').attr({href: backgroundImage, x: 0, y: 0, 'width': size.width, 'height': size.height});
			var svgUse = SVG.get('svg-use');
			svgUse.attr({
				x: size.width - svgUse.width(),
				y: (size.height - svgUse.height())/2
			}).draggable({
				minX: 0,
				maxX: size.width,
				minY: 0,
				maxY: size.height
			});
		},
		choice: function(id) {
		    $("#block_image_"+ id +" .icon_close5").show();
		    $("#block_image_"+ id +" .cover_album").addClass("choice_image")
		    										.attr("data-check",1);

		},
		removeChoice: function(id) {
		    $("#block_image_"+ id +" .icon_close5").hide();
		    $("#block_image_"+ id +" .cover_album").removeClass("choice_image")
		    										.attr("data-check",0);
		},
		chooseImages: function() {
		    var html;
		    var d = new Date();
		    var arrImgs = [];
		    $.each($("[data-check=1]"),function( key, value ) {
		        var link = $( this ).attr("data-source");
		        var data = $(this).data();
		        if( data.store == 'google-drive' ) {
		            var ext = data.ext;
		            $.ajax({
		                url: '{{URL}}/socials/get-image',
		                type: 'POST',
		                async:false,
		                data:{
		                    link:link,
		                    ext: ext,
		                    data: data
		                },
		                async:false,
		                success: function(result){
		                    if(result.error==0){
		                        link = result.data;
		                    }else{
		                        link = false;
		                    }
		                }
		            })
		        }
		        if( !link ) {
		            return;
		        }
		        html = '<div class="image_content" id="img_upload_vi'+d.getTime()+'">'+
		               "<img class=\"photo\" src=\""+link+"\" alt=\"\" onclick=\"Design.changeImage('"+link+"');\">"+
		               '</div>';
		        $(html).prependTo("#slider_image");
		        images.push(link);
		    });
		    //save session
		    $.ajax({
		        url:"{{ URL }}/design/put-image-store",
		        type:"POST",
		        data:{ 'images': images },
		        success: function(){
		        }
		    });
		    $("#dialog" ).dialog({width: 1200}).dialog("close");

		},
		uploadFiles: function(files){
			for(var i = 0; i < files.length; i++) {
		        var data = new FormData();
		        var key = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
						    var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
						    return v.toString(16);
						});
		        files[i].key = key;
		        data.append('images['+ i +'][image]', files[i]);
		        data.append('images['+ i +'][id]', key);
		        $('<div class="image_content" id="img_upload_'+key+'"><div class="img_icon"><div class="imgthumb_loading"><div class="imgthumb_progress" style="width: 0%;"></div></div><div class="img_icon_complete" style="display:none;"><img src="{{URL}}/assets/images/others/ajax-loader.gif" /></div></div></div>').prependTo("#slider_image");
		        objUpload[key] = data;

			}
		    this.runUpload(files);
		},
		runUpload: function(files, position){
			if( position == undefined ) {
			    position = 0;
			}
			if( files[position] == undefined ) {
			    return false;
			}
		    var totalUpload = Object.keys(objUpload).length;
		    if( !inUpload ){
		        inUpload = true;
		        var uploadKey = files[position].key;
		        var data = objUpload[uploadKey];
		        uploadNumber++;
		        if( files != undefined ) {
		            var f = files[position];
		            position++;
		            var reader = new FileReader();
		            reader.readAsDataURL(f);
		            reader.onload = function(e){
		                var src = e.target.result;
		                var img = new Image();
		                img.src = src;
		                img.onload = function(){
		            		f.name = f.name.replace(/ /g, '');
		                    inUpload = false;
		                    $("#img_upload_"+uploadKey+" .imgthumb_progress").css("width","100%");
		                    $("#img_upload_"+uploadKey+" .imgthumb_loading").hide();
		                    $("#img_upload_"+uploadKey+" .img_icon_complete").css("display","block");
		                    $("<img class=\"photo\" src=\""+ src +"\" data-id=\""+uploadKey+"\" alt=\"\" onclick=\"Design.changeImage(this, '"+ f.name +"');\" />").appendTo("#img_upload_"+uploadKey);
		                    $("#img_upload_"+uploadKey+" .img_icon").remove();
		                    $("#img_upload_"+uploadKey+' [data-id="'+ f.name +'"]').trigger('click');
		                };
		            };
		        }
		        $.ajax({
		            url: '/design/put-images',
		            type: 'POST',
		            data: data,
		            dataType: 'json',
		            processData: false,
		            contentType: false,
		            success: function(result) {
		            	if(result.status == 'ok'){
		            		var _data = result.data;
		            	    for(var key in _data){
		            	        var img = new Image();
		                		img.src = _data[key].url;
		                		img.name = _data[key].files[0];
		                		img.onload = function() {
		                			var src = this.src;
		                			$('[data-id="'+ this.name +'"]').each(function(){
		                				$(this).attr('src', src);
		                				$(this).attr('href', src);
		                			});
		                		};
		            	    }
		            	}
		            }
		        });
		    }
		    if( uploadNumber<totalUpload ){
		        uploading = setTimeout(function(){
		          Main.runUpload(files, position);
		        },1000);
		    } else {//end upload
		        clearInterval(uploading);
		        inUpload = false;
		        uploadNumber = 0;
		        objUpload = {};
		    }
		},
		addCart: function() {
			this.preview3D(function() {
				$('#svg-main .shape-path').each(function(){
					var id = $(this).attr('id').replace('shape-path-', '');
					var bleedPath = SVG.get('bleed-'+ id);
					if( bleedPath.attr('fill-opacity') == 0.4 ) {
						opacity = true;
						bleedPath.attr('fill-opacity', 0);
					}
				});
				var svgSetup = Design.svgSetup();
				$.ajax({
					url: '{{ URL.'/cart/add' }}',
					type: 'POST',
					data: {
						img: $("#preview_content canvas")[0].toDataURL(),
						price_info: $("input", "#product-infomation").serializeArray(),
						svg_info: Design.svgSetup(),
						svg: $('#svg_div').html(),
						@if( isset($product['cart_id']) )
						cart_id: '{{ $product['cart_id'] }}'
						@endif
					},
					success: function(result){
						if( result.status == 'ok' ) {
							//Add cart via js
							console.log('JS Here');
						} else {
							toastr.error(result.message, 'Error');
						}
					}
				});
			});

		},
		preview3D: function(afterRenderCallBack) {
			Design.resetZoom();
			this.closePreview();
			preview(function(){
				var info = {};
				var svgSetup = Design.svgSetup();
				var opacity = false;
				var draw = Design.getDraw();
				var arrColor = ['red', 'green', 'yellow', 'gray', 'organe', 'blue'];
				$('#svg-main .shape-path').each(function(){
					var minX = null;
					var minY = null;
					var id = $(this).attr('id').replace('shape-path-', '');
					var pathArray = this.instance.array.value;
					var position = 0;
					for(var i in pathArray) {
						if( info[id+'.'+position] == undefined ) {
							info[id+'.'+position] = {
								'center': {
									'points': []
								}
							};
						}
						var array = pathArray[i];
						if( array.length != 3 ) {
							position++;
							var minX = null;
							var minY = null;
							continue;
						}
						var x = Number(array[1]);
						var y = Number(array[2]);
						if( minX == null || minX > x ) {
							minX = x;
						}
						if( minY == null || minY > y) {
							minY = y;
						}
						info[id+'.'+position].center.points.push({ x: x, y: y });
						info[id+'.'+position].center.minX = minX;
						info[id+'.'+position].center.minY = minY;
					}
					var bleedArray = SVG.get('bleed-'+ id).array.value;
					var j = 0;
					var position = 0;
					var minX = null;
					var minY = null;
					for(var i in bleedArray) {
						var array = bleedArray[i];
						if( info[id+'.'+position]['bleed_'+ j] == undefined ) {
							info[id+'.'+position]['bleed_'+ j] = {
								'points' : [],
								'angle': ''
							};
						}
						if( array.length != 3 ) {
							var point = svgSetup.elements[id].allPoints.points;
							var current = j;
							var next = current + 1;
							if( next > point['path_'+ position].length - 1 ) {
								next = next - point['path_'+ position].length;
							}
							prevPoint = {x: point['path_'+ position][current].x, y: point['path_'+ position][next].y};
							info[id+'.'+position]['bleed_'+ j].angle = -Pointer.angle(prevPoint, point['path_'+ position][current], point['path_'+ position][next]);
							/*draw.path(
								'M'+prevPoint.x+' '+prevPoint.y+
								'L'+point['path_'+ position][current].x+' '+point['path_'+ position][current].y+
								'L'+point['path_'+ position][next].x+' '+point['path_'+ position][next].y
								).attr({'stroke': arrColor[j], 'fill': 'none'});*/
							j++;
							if( j == point['path_'+ position].length ) {
								var minX = null;
								var minY = null;
								j = 0;
								position++;
							}
							continue;
						}
						var x = Number(array[1]);
						var y = Number(array[2]);
						if( minX == null || minX > x ) {
							minX = x;
						}
						if( minY == null || minY > y) {
							minY = y;
						}
						info[id+'.'+position]['bleed_'+ j].points.push({ x: x, y: y });
						info[id+'.'+position]['bleed_'+ j].minX = minX;
						info[id+'.'+position]['bleed_'+ j].minY = minY;
						var bleedPath = SVG.get('bleed-'+ id);
						if( bleedPath.attr('fill-opacity') == 0.4 ) {
							opacity = true;
							bleedPath.attr('fill-opacity', 0);
						}
					}
				});
				canvg('main-canvas', Design.get(), {
					renderCallback: function(){
						var draw = Design.getDraw();
						var mainCanvas = document.getElementById('main-canvas');
						var canvasCollection = $('#canvas-collection');
						canvasCollection.html('');
						var OBJECT = {
										'width' 	 : svgSetup.main.width,
										'height' 	 : svgSetup.main.height,
										'bleed' 	 : svgSetup.main.bleed,
										'imageTotal' : 0,
										'shapes'	 : {}
									};
						var imageWrap = $.inArray(svgSetup.main.wrap, ['natural', 'm_wrap']) != -1 ? true : false;

						if( !imageWrap ) {
							var color;
							if( svgSetup.main.wrap == 'white' ) {
								color = '#ffffff';
							} else if( svgSetup.main.wrap == 'black' ) {
								color = '#000000';
							} else if(  svgSetup.main.wrap.indexOf('#') !== -1 ) {
								color = svgSetup.main.wrap;
							} else {
								color = '#ffffff';
							}
							OBJECT.color = color;
						}
						for(var shapePosition in info) {
							var shapeInfo = info[ shapePosition ];
							for(var shapeName in shapeInfo) {
								var shape = shapeInfo[ shapeName ];
								if( OBJECT.shapes[shapePosition] == undefined ) {
									OBJECT.shapes[shapePosition] = {};
								}
								if( OBJECT.shapes[shapePosition][shapeName] == undefined ) {
									OBJECT.shapes[shapePosition][shapeName] = {};
								}
								OBJECT.shapes[shapePosition][shapeName].points = shape.points;
								var points = shape.points;
								if( shapeName != 'center' ) {
									continue;
								} else {
									var d = '';
									for( var p in points ) {
										if( p == 0 ) {
											d += 'M'+ points[p].x +' '+points[p].y;
										} else {
											d += 'L'+ points[p].x +' '+points[p].y;
										}
									}
									var path = draw.path(d +'Z');
									var minX = shape.minX;
									var minY = shape.minY;
									var w = path.width();
									var h = path.height();
									path.remove();
									canvasCollection.append('<canvas id="canvas-'+ shapePosition +'-'+ shapeName +'" width="'+ w +'" height="'+ h +'"></canvas>');

									var canvas = document.getElementById('canvas-'+ shapePosition +'-'+ shapeName);
									var ctx = canvas.getContext("2d");
									ctx.globalAlpha = 1.00;
								    ctx.drawImage(mainCanvas, minX, minY, w, h, 0, 0, w, h);
								    ctx.restore();
									OBJECT.shapes[shapePosition][shapeName].image = 'canvas-'+ shapePosition +'-'+ shapeName;
								}
							}
						}
						Preview3D.draw(OBJECT);
						Main.previewRenderFinished = true;
						if( opacity ) {
							$('#svg-main .group-bleed .bleed').each(function(){
								this.instance.attr('fill-opacity', 0.4);
							});
						}
					}
				});
				return false;
				var svg = $('#svg_div').html();
				if( opacity ) {
					$('#svg-main .group-bleed .bleed').each(function(){
						this.instance.attr('fill-opacity', 0.4);
					});
				}
				$.ajax({
					url: '{{ URL.'/wall-collage/preview-3d' }}',
					type: 'POST',
					data: {
						info: info,
						svg: svg,
						svg_setup: svgSetup.main,
						id: {{ $product['id'] }}
					},
					success: function(result) {
						Preview3D.draw(result);
					}
				});
			}, afterRenderCallBack);
		},
		changeText: function(options) {
			if( typeof options == 'undefined' ) {
				options = {};
			}
			if( options.text ) {
				this.textPanel.find('textarea').val(options.text);
			}
			if( options.font ) {
				this.textPanel.find('.font-family').val(options.font);
			}
			if( options.size ) {
				this.textPanel.find('.font-size').slider('value', options.size);
				$(".font-size-value").html(options.size);
			}
			if( options.weight ) {
				this.textPanel.find('.font-weight').slider('value', options.weight);
				$(".font-weight-value").html(options.weight);
			}
			if( options['stroke-width'] ) {
				this.textPanel.find('.stroke-width').slider('value', options['stroke-width']);
				$(".stroke-width-value").html(options['stroke-width']);
			}
			if( options.stroke ) {
				this.textPanel.find('[data-id=stroke]').colorpicker('setValue', options.stroke);
			}
			if( options.color ) {
				this.textPanel.find('[data-id=color]').colorpicker('setValue', options.color);
			}
			if( typeof options.textPath == 'undefined' ) {
				$('#remove-text-path').prop('disabled', true);
			} else {
				$('#remove-text-path').prop('disabled', false);
			}

		},
		onOffText: function(type){
			if( type == 'on' ){
				$('.paletteContent').removeClass('active');
				$('#paletteContentText').addClass('active');
			} else {
				$('.paletteLabel.active').trigger('click');
				if( $('#group-text text.active').length ) {
					$('#group-text text.active')[0].instance.removeClass('active');
				}
			}
		},
		resolution: function(){
			var selectedImage = Design.getSelectedImage();
			if( selectedImage ) {
				var url = selectedImage.node.getAttribute('href');
				if( url ) {
					$("#dialog_resolution").dialog({width: 900,height: 600}).dialog("open");
					$.ajax({
					    url:"{{URL}}/design/analyze-image",
					    type:"POST",
					    data:{img: url},
					    success: function(ret){
					        var html = '';
					        html += '<div id="content">';
					            html += '<div style="float:left; margin-right: 20px">';
					                html += '<img style="width: 385px " src="'+ ret.image +'" />';
					            html += '</div>';
					            html += '<div class="info">';
					            html += ' <ul >';
					                            html += '<li><h2>About your picture: </h2></li>';
					                            html += '<li>Your file size: <b>'+ret.size+'</b> MB </li>';
					                            html += '<li>Your file resolution: <b>'+ret.width+'</b> by <b>'+ret.height+'</b> pixels </li>';
					                            html += '<li><b>'+ret.mp+'</b> Megapixels</li>';
					                html += '</ul>';
					            html += '</div>';
					            html += '<div class="clear"></div>';
					            html += '<table id="result" border="0" cellpadding="0" cellspacing="0">';
					            for(var i in ret.dimensions){
					                html += '<tr>';
					                html += '<td width="220" valign="top" class="txmedium" style="padding:10px;spacing:5px">';
					                html += '<b>'+ret.dimensions[i][0]+'x</b><b>'+ret.dimensions[i][1]+' inches</b>';
					                html += '</td>';
					                html += '<td class="tx2" style="padding:10px;spacing:5px">';
					                html += ret.dimensions[i][3];
					                html += '</td>';
					                html += '</tr>';
					            }
					            html += '</table>';
					        html += '</div>'
					        $("#dialog_resolution").html(html);
					    }
					});
				}
			}
		}
	}
}();
</script>