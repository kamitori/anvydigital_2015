<div id="image-div" class="modal " role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="overflow-y: auto !important;">
            <div class="modal-body">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 200px;">
                        <img data-origin-src="{{ URL::asset( 'assets/images/noimage/247x185.gif' ) }}" src="{{ URL::asset( 'assets/images/noimage/247x185.gif' ) }}"/>
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 150px;">
                    </div>
                    <div>
                        <span class="btn default btn-file">
                            <span class="fileinput-new">
                                Select image
                            </span>
                            <span class="fileinput-exists">
                                Change
                            </span>
                            <input name="file" id="file" accept="image/*" type="file">
                            <input type="hidden" name="choose" value="0" />
                            <input type="hidden" name="id" value="0" />
                        </span>
                        <a href="javascript:void(0)" class="btn green fileinput-new" onclick="openImage(this)">Choose</a>
                        <a href="javascript:void(0)" class="btn red fileinput-exists" data-dismiss="fileinput">
                        Remove </a>
                    </div>
                </div>
                <div class="editable-buttons"><button type="submit" class="btn blue editable-submit"><i class="fa fa-check"></i></button><button type="button" class="btn default editable-cancel"><i class="fa fa-times"></i></button></div>
            </div>
        </div>
    </div>
</div>
<div id="option-add-div" class="modal fade bs-modal-lg" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Option Group</h4>
            </div>
            <div class="modal-body form">
                <form id="option-add-form" action="javascript:void(0)" method="POST" class="form-horizontal form-row-seperated">
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        <div id="content-message">
                            You have some form errors. Please check below.
                        </div>
                    </div>
                    {{ Form::token(); }}
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Name</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                <i class="fa fa-file-text-o"></i>
                                </span>
                                <input type="text" id="name" name="name" value="" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-sm-4 control-label">Image</label>
                        <div class="col-sm-8">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                    <img data-origin-src="{{ URL::asset( 'assets/images/noimage/247x185.gif' ) }}" src="{{ URL::asset( 'assets/images/noimage/247x185.gif' ) }}"/>
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 150px;">
                                </div>
                                <div>
                                    <span class="btn default btn-file">
                                        <span class="fileinput-new">
                                            Select image
                                        </span>
                                        <span class="fileinput-exists">
                                            Change
                                        </span>
                                        <input name="image" accept="image/*" type="file">
                                        <input type="hidden" name="choose" value="0" />
                                    </span>
                                    <a href="javascript:void(0)" class="btn green fileinput-new" onclick="openImage(this)">Choose</a>
                                    <a href="javascript:void(0)" class="btn red fileinput-exists" data-dismiss="fileinput">
                                    Remove </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Description</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                <i class="fa fa-info"></i>
                                </span>
                                <textarea id="description" name="description" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group last">
                        <label class="col-sm-4 control-label">Option Group</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                <i class="fa fa-info"></i>
                                </span>
                                <select id="option_group_id" name="option_group_id" class="form-control"></select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="option-add-submit" class="btn btn-primary"><i class="fa fa-check"></i>Save change</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa icon-layers"></i>{{ 'Product Option Listing' }}
                </div>
                <div class="actions">
                    <a href="#option-add-div" class="btn default yellow-stripe" data-toggle="modal">
                        <i class="fa fa-plus"></i>
                        <span class="hidden-480">{{ 'New Product Option' }}</span>
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-container">
                    <table class="table table-striped table-hover table-bordered" id="list-product-options">
                        <thead>
                            <tr role="row" class="heading">
                                <th>#</th>
                                <td>Id</td>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Option Group</th>
                                <th class="text-center" width="18%">
                                     {{'Tools'}}
                                </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td></td>
                                <td></td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="search[name]">
                                </td>
                                <td></td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="search[description]">
                                </td>
                                <td>
                                    <select class="form-control form-filter input-sm" name="search[option_group_id]"></select>
                                </td>
                                <td class="text-center">
                                    <button id="search-button" class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i>{{ 'Search' }}</button>
                                    <button id="cancel-button" class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i>{{ 'Reset' }}</button>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@section('pageCSS')
<link href="{{ URL::asset( 'assets/global/css/plugins.css' ) }}" rel="stylesheet" type="text/css"/>
<link href="{{ URL::asset( 'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css' ) }}" rel="stylesheet" type="text/css"/>
<link href="{{ URL::asset( 'assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css' ) }}" rel="stylesheet" type="text/css" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset( 'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css' ) }}" />
<style type="text/css">
#image-div{
    width: 25%;
    margin-left: -10%;
    overflow-y: auto;
}
#image-div .modal-dialog, #option-add-div .modal-dialog{
    width: 100%;
    margin: 0;
}
</style>
@stop
@section('pageJS')
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/jquery-validation/js/jquery.validate.min.js' ) }}"></script>
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/datatables/media/js/jquery.dataTables.min.js' ) }}"></script>
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js' ) }}"></script>
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js' ) }}"></script>
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js' ) }}"></script>
<script type="text/javascript">
var optionGroup = {{ $option_group }};
$("#option-add-form").validate({
    errorElement: 'span',
    errorClass: 'help-block help-block-error',
    focusInvalid: false,
    messages: {
        select_multi: {
            maxlength: $.validator.format("'Max {0} items allowed for selection"),
            minlength: $.validator.format("'At least {0} items must be selected")
        }
    },
    rules: {
        name: {
            minlength: 3
        },
    },
    invalidHandler: function (event, validator) {
        $(".alert-danger","#option-add-form").show();
        Metronic.scrollTo($(".alert-danger","#option-add-form"), -200);
    },
    errorPlacement: function(error, element) {
        element.parent().append(error);
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
        var form = $("#option-add-form");
        $(".alert-danger", form).hide();
        var choose      = parseInt($("[name=choose]", form).val());
        var name        = $("[name=name]", form).val();
        var description    = $("[name=description]", form).val();
        var option_group_id    = $("[name=option_group_id]", form).val();
        var ajaxConfig  = {
                            url : "{{ URL }}/admin/product-options/update-product-option",
                            type: "POST",
                            success: function(result) {
                                if( result.status == "error" ) {
                                    $("#content-message", form).html(result.message);
                                    $(".alert-danger", form).show();
                                } else {
                                    $("#option-add-div").modal("hide");
                                    $("img", form).attr("src", $("img", form).attr("data-origin-src"));
                                    $("[name=name], [name=image], [name=option_group_id]", form).val("");
                                    $("[name=choose]", form).val(0);
                                    toastr.success(result.message, 'Message');
                                    $("#cancel-button").trigger("click");
                                }
                            }
                        };
        var files = $("[name=image]", "#option-add-form")[0].files;
        var process = false;
        if( choose ) {
            var data = {};
            data.name       = name;
            data.choose     = choose;
            data.description   = description;
            data.option_group_id   = option_group_id;
            if( active ) {
                data.active = 1;
            }
            process      = true;
        } else if( files && files.length ) {
            var data = new FormData();
            data.append("image", files[0]);
            data.append("name", name);
            data.append("description", description);
            data.append("option_group_id", option_group_id);
            ajaxConfig["contentType"] = false;
            ajaxConfig["processData"] = false;
            process      = true;
        }
        if( process ) {
            ajaxConfig["data"] = data;
            $.ajax(ajaxConfig);
        } else {
            toastr.warning("Please upload or choose image to continue.", "Warning");
        }
    }
});
$(".editable-submit", "#image-div").click(function(){
    var id          = parseInt($("[name=id]", "#image-div").val());
    var choose      = parseInt($("[name=choose]", "#image-div").val());
    var ajaxConfig  = {
                        url : "{{ URL }}/admin/product-options/update-product-option",
                        type: "POST",
                        success: function(result) {
                            if( result.status == "ok" ) {
                                $("img[data-id="+ id +"]", "#list-product-options").attr("src", result.path);
                                $("a.fileinput-exists", "#image-div").trigger("click");
                                $(".editable-cancel", "#image-div").trigger("click");
                                toastr.success(result.message, "Message");
                            } else {
                                toastr.error(result.message, "Error");
                            }
                        }
                    };
    var files = $("[name=file]", "#image-div")[0].files;
    var process = false;
    if( choose ) {
        var data = {};
        data.choose  = choose;
        data.pk      = id;
        data.name    = "image";
        process      = true;
    } else if( files && files.length ) {
        var data = new FormData();
        data.append("image", files[0]);
        data.append("pk", id);
        data.append("name", "image");
        ajaxConfig["contentType"] = false;
        ajaxConfig["processData"] = false;
        process      = true;
    }
    if( process ) {
        ajaxConfig["data"] = data;
        $.ajax(ajaxConfig);
    } else {
        $("a.fileinput-exists", "#image-div").trigger("click");
        $(".editable-cancel", "#image-div").trigger("click");
    }

});
$(".editable-cancel", "#image-div").click(function(){
    $("[name=choose]", "#image-div").val(0);
    $("[name=file]", "#image-div").val("");
    $("#image-div").modal("hide");
});
var columnDefs = [
        {
            "targets": 2,
            "name"  : "name",
            "data" : function(row, type, val, meta) {
                return '<a href="javascript:void(0)" class="xeditable-input" data-escape="true" data-name="name" data-type="text" data-pk="'+row[1]+'" data-url="{{ URL.'/admin/product-options/update-product-option' }}">'+row[2]+'</a>';
            }
        },
        {
            "targets": 3,
            "className" : "text-center",
            "orderable": false,
            "name"  : "image",
            "data" : function(row, type, val, meta) {
                var html = '<img onclick="imageEditable(this)" data-id="'+row[1]+'" src="{{ URL }}/assets/images/noimage/110x110.gif" style="width: 200px;" />';
                if( row[3] ){
                    html = '<img onclick="imageEditable(this)" data-id="'+row[1]+'" src="{{ URL }}/'+row[3]+'" style="width: 200px;" />';
                }
                return html;
            }
        },
        {
            "targets": 4,
            "name"  : "description",
            "data" : function(row, type, val, meta) {
                return '<a href="javascript:void(0)" class="xeditable-input" data-escape="true" data-name="description" data-type="textarea" data-pk="'+row[1]+'" data-url="{{ URL.'/admin/product-options/update-product-option' }}">'+row[4]+'</a>';
            }
        },
        {
            "targets": 5,
            "name"  : "option_group",
            "data" : function(row, type, val, meta) {
                return '<a href="javascript:void(0)" class="xeditable-select" data-escape="true" data-name="option_group_id" data-type="select" data-pk="'+row[1]+'" data-value="'+row[5]+'" data-url="{{ URL.'/admin/product-options/update-product-option' }}">'+row[6]+'</a>';
            }
        },
    ];
listRecord({
    url: "{{ URL.'/admin/product-options/list-product-option' }}",
    delete_url: "{{ URL.'/admin/product-options/delete-product-option' }}",
    delete_message: "Delete this group will also delete all of options belong to it.<br />Are you sure to do this?",
    table_id: "#list-product-options",
    columnDefs: columnDefs,
    pageLength: 20,
    fnDrawCallback: function(){
        $("a.xeditable-input","#list-product-options").editable({
            success: function(response, newValue){
                if( response.status == "ok" ) {
                    toastr.success(response.message, 'Message');
                } else {
                    return response.message;
                }
            }
        });
        $("a.xeditable-select","#list-product-options").editable({
            source: optionGroup
        });
    },
});
var optionGroupSelect = function() {
    var html = "";
    for(var i in optionGroup) {
        html += '<option value="'+optionGroup[i].value+'">'+optionGroup[i].text+'</option>';
    }
    $("#option_group_id", "#option-add-form").html(html);
    $("[name='search[option_group_id]'").html(html);
}
optionGroupSelect();
$("#option-add-submit").click(function(){
    $("#content-message","#option-add-form").html("You have some form errors. Please check below.");
    $("#option-add-form").submit();
});

function imageEditable(object)
{
    var src = $(object).attr("src");
    var id = $(object).attr("data-id");
    $("img", "#image-div").attr("src", src);
    $("[name=choose]", "#image-div").val(0);
    $("[name=id]", "#image-div").val(id);
    $("#image-div").modal("show");
}

function restoreImageState(object)
{
    var parent = $("#image-div").is(":visible") ? $("#image-div") : $("#option-add-div");
    $("[name=choose]", parent).val(0);
    $(".thumbnail > img", parent).attr("src", $(".thumbnail > img", "#image-div").attr("data-origin-src"));
}
function chooseImage(object)
{
    var parent = $("#image-div").is(":visible") ? $("#image-div") : $("#option-add-div");
    $("[name=choose]", parent).val($(object).attr("data-id"));
    var src = $("img", object).attr("src");
    $(".thumbnail > img", parent).attr("src", src);
    $(modal).modal("hide");
}
</script>
@stop

@extends('admin.layout.image-browser',['controller' => 'product-options', 'holder' => '#image-div', 'itemWidth' => 150, 'modalWidth' => 90])