<div class="portlet">
    {{ Form::open(array('url'=>URL.'/admin/product-categories/update-product-category', 'files'=>true , 'method'=>"POST", 'class'=>'form-horizontal', 'id' => 'category-form') ) }}
        <?php
            if(Session::has('_old_input')) {
                $category = Session::get('_old_input');
            }
        ?>
        <div class="portlet-title">
            <div class="actions btn-set text-right">
                <a class="btn default"  href="{{ URL.'/admin/product-categories' }}"><i class="fa fa-angle-left"></i> Back</a>
                <button class="btn default" type="reset"><i class="fa fa-reply"></i> Reset</button>
                <button class="btn green" type="submit"><i class="fa fa-check"></i> Save</button>
                <button class="btn green" type="submit" name="continue" value="continue"><i class="fa fa-check-circle"></i> Save &amp; Continue Edit</button>
                @if( isset($category['id']) )
                <div class="btn-group">
                    <a class="btn yellow dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-share"></i> More <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="javascript:void(0)">
                            Duplicate </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="deleteRecord({ 'deleteUrl' : '{{ URL.'/admin/product-categories/delete-product-category/'.$category['id'] }}', returnUrl : '{{ URL.'/admin/product-categories' }}' })">
                            Delete </a>
                        </li>
                        <li class="divider">
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                            Print </a>
                        </li>
                    </ul>
                </div>
                @endif
            </div>
        </div>
        <div class="portlet-body form">
            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#main" data-toggle="tab">
                        Main information </a>
                    </li>
                    <li>
                        <a href="#meta" data-toggle="tab">
                        Meta </a>
                    </li>
                    <li>
                        <a href="#home" data-toggle="tab">
                        On Home </a>
                    </li>
                </ul>
                <div class="tab-content no-space">
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        <div id="content-message">
                            You have some form errors. Please check below.
                        </div>
                    </div>
                    <div class="tab-pane active" id="main">
                        <div class="form-body">
                            @if( isset($category['id']) )
                            <input type="hidden" name="id" value="{{ $category['id'] }}" />
                            @endif
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label col-md-2">Name</label>
                                    <div class="col-md-10">
                                        <input type="text" name="name" class="form-control" placeholder="" value="{{ $category['name'] or '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label col-md-2">Parent Category</label>
                                    <div class="col-md-10">
                                        <?php
                                            if( !isset($category['parent_id']) ) {
                                                $category['parent_id'] = 0;
                                            }
                                        ?>
                                        <select name="parent_id" class="form-control">
                                            @foreach($parent as $cate)
                                            <option @if( $category['parent_id'] == $cate['value'] ) selected @endif value="{{$cate['value']}}">{{$cate['text']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="col-md-2 control-label">Order no</label>
                                    <div class="col-md-10">
                                        <div id="order_spinner">
                                            <div class="input-group input-small">
                                                <input type="text" class="spinner-input form-control" minlength="1" value="{{ $category['order_no'] or 1 }}" readonly id="order_no" name="order_no">
                                                <div class="spinner-buttons input-group-btn btn-group-vertical">
                                                    <button type="button" class="btn spinner-up btn-xs red">
                                                    <i class="fa fa-angle-up"></i>
                                                    </button>
                                                    <button type="button" class="btn spinner-down btn-xs red">
                                                    <i class="fa fa-angle-down"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label col-md-2">On Menu</label>
                                    <div class="col-md-10">
                                        <input type="checkbox" class="form-control" name="on_menu" {{ isset($category['menu_id']) && $category['menu_id'] ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label col-md-2">Color</label>
                                    <div class="col-md-10">
                                        <div class="input-group color colorpicker-default input-small " data-color="{{ $category['color'] or '#ffffff' }}">
                                            <input type="text" name="color" onchange="onchangeColor(this)" class="form-control " value="{{ $category['color'] or '#ffffff' }}" >
                                            <span class="input-group-btn">
                                            <button class="btn default" type="button" id="color_change"><i id="i_color" style="background-color: {{ $category['color'] or '#ffffff' }};"></i>&nbsp;</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label col-md-2">Active</label>
                                    <div class="col-md-10">
                                        <input type="checkbox" class="form-control" name="active" {{ !isset($category['active']) || $category['active'] ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Description</label>
                                <div class="col-md-10">
                                    <textarea class="form-control " id="description" name="description">{{ $category['description'] or '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="meta">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Meta Title</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control maxlength-handler" name="meta_title" value="{{ $category['meta_title'] or '' }}" maxlength="50" placeholder="">
                                    <span class="help-block">
                                    max 50 chars </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Meta Description</label>
                                <div class="col-md-10">
                                    <textarea class="form-control maxlength-handler" rows="8" name="meta_description" maxlength="255">{{ $category['meta_description'] or '' }}</textarea>
                                    <span class="help-block">
                                    max 255 chars </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="home">
                        <div class="form-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label col-md-2">On Home</label>
                                    <div class="col-md-10">
                                        <input type="checkbox" class="form-control" name="on_home" {{ isset($category['on_home']) && $category['on_home'] ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Home Description</label>
                                <div class="col-md-10">
                                    <textarea class="form-control maxlength-handler" id="home_description" name="home_description" style="resize: none; height: 150px;" maxlength="255">{{ $category['home_description'] or '' }}</textarea>
                                    <span class="help-block">
                                    max 255 chars </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{ Form::close() }}
</div>
@section('pageCSS')
<link rel="stylesheet" type="text/css" href="{{ URL::asset( 'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css' ) }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset( 'assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css' ) }}">
@stop
@section('pageJS')
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/jquery-validation/js/jquery.validate.min.js' ) }}"></script>
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js' ) }}"></script>
<script src="{{ URL::asset( 'assets/global/plugins/fuelux/js/spinner.js' ) }}"></script>
<script src="{{ URL::asset( 'assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js' ) }}" type="text/javascript"></script>
<script src="{{ URL::asset( 'assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js' ) }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/admin/js/plugin/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
CKEDITOR.replace("description", {height: 350});
$("#order_spinner").spinner("value", {{ $category['order_no'] or 1 }});
$("#category-form").validate({
    errorElement: 'span',
    errorClass: 'help-block help-block-error',
    focusInvalid: false,
    ignore: "",
    messages: {
        select_multi: {
            maxlength: $.validator.format("Max {0} items allowed for selection"),
            minlength: $.validator.format("At least {0} items must be selected")
        }
    },
    rules: {
        name: {
            required: true,
            minlength: 3
        },
    },
    invalidHandler: function (event, validator) {
        $(".alert-danger","#category-form").show();
        Metronic.scrollTo($(".alert-danger","#category-form"), -200);
    },
    highlight: function (element) {
        $(element)
            .closest('.form-group').addClass('has-error');
    },
    unhighlight: function (element) {
        $(element)
            .closest('.form-group').removeClass('has-error');
    },
    success: function (label) {
        label
            .closest('.form-group').removeClass('has-error');
    },
    submitHandler: function (form) {
        $(".alert-danger","#category-form").hide();
        this.submit();
    }
});
$(".maxlength-handler").maxlength({
    limitReachedClass: "label label-danger",
    alwaysShow: true,
    threshold: 5
});
$('.colorpicker-default').colorpicker({
    format: 'hex'
});
function restoreImageState(object)
{
    $("#choose_image", "#main").remove();
    $(".thumbnail > img", "#main").attr("src", $(".thumbnail > img", "#main").attr("data-origin-src"));
}
function onchangeColor(obj){
    var val = $(obj).val();
    val = val.replace("#","");    
    val = hexToRgb(val);
    $("#i_color").css('background-color','rgb('+val['r']+', '+val['g']+', '+val['b']+')');
}
function hexToRgb(hex) {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}
function chooseImage(object)
{
    var parent = $("#main");
    var id = parent.attr("data-id");
    if( $("#choose_image", parent).length ) {
        $("#choose_image", parent).val($(object).attr("data-id"));
    } else {
        parent.prepend('<input id="choose_image" type="hidden" name="choose_image" value="'+$(object).attr("data-id")+'" />');
    }
    var src = $("img", object).attr("src");
    $(".thumbnail > img", parent).attr("src", src);
    $(modal).modal("hide");
}
</script>
@stop
@extends('admin.layout.image-browser', ['controller' => 'product-categories', 'holder' => '#main', 'itemWidth' => 460])
