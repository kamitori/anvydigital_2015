<div id="font-add-div" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Font</h4>
            </div>
            <div class="modal-body form">
                <form id="font-add-form" action="javascript:void(0)" method="POST" class="form-horizontal form-row-seperated">
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
                                <input type="text" id="name" name="name" value="" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">
                            Source
                        </label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                <i class="fa fa-info"></i>
                                </span>
                                <input type="file" name="source" class="form-control" accept="application/font-woff"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group last">
                        <ul class="list-group" id="source-preview" style="font-size: 25px;">
                            <li class="list-group-item">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                            <li class="list-group-item" style="font-style: italic; ">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                            <li class="list-group-item" style="font-weight: bold; ">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                        </ul>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="font-add-submit" class="btn btn-primary"><i class="fa fa-check"></i>Save change</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa icon-notebook"></i>Fonts
                </div>
                <div class="actions">
                    <a href="#font-add-div" class="btn default yellow-stripe" data-toggle="modal">
                        <i class="fa fa-plus"></i>
                        <span class="hidden-480">New Font</span>
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-container">
                    <table class="table table-striped table-hover table-bordered" id="list-fonts">
                        <thead>
                            <tr role="row" class="heading">
                                <th>#</th>
                                <td>Id</td>
                                <th>Name</th>
                                <th>Preview</th>
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
                                <td>
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

@stop
@section('pageJS')
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/jquery-validation/js/jquery.validate.min.js' ) }}"></script>
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/datatables/media/js/jquery.dataTables.min.js' ) }}"></script>
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js' ) }}"></script>
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js' ) }}"></script>
<script type="text/javascript">
var columnDefs = [
        {
            "targets": 2,
            "name"  : "name",
        },
        {
            "targets": 3,
            "name"  : "source",
            "data" : function(row, type, val, meta) {
                if( !$('head #font-'+ row[1]).length ) {
                    $('head').append('<style id="font-'+ row[1] +'" type="text/css">' +
                                    '@font-face {' +
                                        'font-family: "'+ row[2] +'";' +
                                        'src: url('+ row[3] +');' +
                                    '}' +
                                    '</style>');
                }
                return '<ul class="list-group" style="font-family: \''+ row[2] +'\'; font-size: 25px;">' +
                            '<li class="list-group-item">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>' +
                            '<li class="list-group-item" style="font-style: italic; ">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>' +
                            '<li class="list-group-item" style="font-weight: bold; ">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>' +
                        '</ul>';
            }
        },
    ];
listRecord({
    url: "{{ URL.'/admin/design-fonts/list-font' }}",
    delete_url: "{{ URL.'/admin/design-fonts/delete-font' }}",
    table_id: "#list-fonts",
    columnDefs: columnDefs,
    pageLength: 30,
});

$('#font-add-submit').click(function() {
    $("#font-add-form").submit();
});

$("#font-add-form").validate({
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
            required: true,
            minlength: 6
        },
    },
    invalidHandler: function (event, validator) {
        $(".alert-danger","#font-add-form").show();
        Metronic.scrollTo($(".alert-danger","#font-add-form"), -200);
    },
    errorPlacement: function(error, element) {
        element.parent().parent().append(error);
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
        $(".alert-danger","#font-add-form").hide();
        var files = $('#font-add-form [name=source]')[0].files;
        if( files && files.length ) {
            var data = new FormData();
            data.append("source", files[0]);
            data.append("name", $('#font-add-form [name=name]').val());
        } else {
            toastr.warning("Please upload font source to continue.", "Warning");
            return false;
        }
        $.ajax({
            url: "{{ URL.'/admin/design-fonts/update-font' }}",
            type: "POST",
            data: data,
            contentType: false,
            processData: false,
            success: function(result){
                if( result.status == "error" ) {
                    $("#content-message","#font-add-form").html(result.message);
                    $(".alert-danger","#font-add-form").show();
                } else {
                    $("#font-add-div").modal("hide");
                    $("input","#font-add-form").val("");
                    toastr.success(result.message, 'Message');
                    $("#cancel-button").trigger("click");
                    $('#source-preview').css('font-family', '');
                }
            }
        });
    }
});

$('#font-add-form [name=source]').change(function() {
    var reader = new FileReader();
    reader.readAsDataURL(this.files[0]);
    reader.onload = function(e){
        var src = e.target.result;
        var id = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                    var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
                    return v.toString(16);
                });
        $('head #font-temporaty').remove();
        $('head').append('<style id="font-temporaty" type="text/css">' +
                        '@font-face {' +
                            'font-family: "'+ id +'";' +
                            'src: url('+ src +');' +
                        '}' +
                        '</style>');
        $('#source-preview').css('font-family', '"'+ id +'"');
    };
});

</script>
@stop