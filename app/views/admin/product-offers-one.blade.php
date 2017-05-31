<div id="product-div" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="overflow-y: auto !important;">
            <div class="modal-body">
                <table class="table table-striped table-hover table-bordered" id="list-product">
                    <thead>
                        <tr role="row" class="heading">
                            <th>#</th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th class="text-center" width="3%">
                                 {{'Tools'}}
                            </th>
                        </tr>
                        <tr role="row" class="filter">
                            <td><input type="hidden" name="extra[call_from]" value="offers"></td>
                            <td></td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="search[name]">
                            </td>
                            <td></td>
                            <td class="text-center">
                                <button id="search-button" class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i>{{ 'Search' }}</button>
                                <button id="cancel-button" class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i>{{ 'Reset' }}</button>
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div class="portlet">
    {{ Form::open(array('url'=>URL.'/admin/product-offers/update-offer', 'files'=>true , 'method'=>"POST", 'class'=>'form-horizontal', 'id' => 'offer-form') ) }}
        <?php
            if(Session::has('_old_input')) {
                $offer = Session::get('_old_input');
            }
        ?>
        <div class="portlet-title">
            <div class="actions btn-set text-right">
                <a class="btn default"  href="{{ URL.'/admin/product-offers' }}"><i class="fa fa-angle-left"></i> Back</a>
                <button class="btn default" type="reset"><i class="fa fa-reply"></i> Reset</button>
                <button class="btn green" type="submit"><i class="fa fa-check"></i> Save</button>
                <button class="btn green" type="submit" name="continue" value="continue"><i class="fa fa-check-circle"></i> Save &amp; Continue Edit</button>
                @if( isset($offer['id']) )
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
                            <a href="javascript:void(0)" onclick="deleteRecord({ 'deleteUrl' : '{{ URL.'/admin/product-offers/delete-product-offer/'.$offer['id'] }}', returnUrl : '{{ URL.'/admin/product-offers' }}' })">
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
                    <li>
                        <a href="#products" data-toggle="tab">
                        Products </a>
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
                            @if( isset($offer['id']) )
                            <input type="hidden" name="id" value="{{ $offer['id'] }}" />
                            @endif
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label col-md-2">Name</label>
                                    <div class="col-md-10">
                                        <input type="text" name="name" class="form-control" placeholder="" value="{{ $offer['name'] or '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label col-md-2">Image</label>
                                    <div class="col-md-10">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                @if( !empty($offer['image']) )
                                                <img data-origin-src="{{ URL::asset($offer['image']) }}" src="{{ URL::asset($offer['image']) }}" alt=""/>
                                                @else
                                                <img data-origin-src="{{ URL::asset( 'assets/images/noimage/247x185.gif' ) }}" src="{{ URL::asset( 'assets/images/noimage/247x185.gif' ) }}" alt=""/>
                                                @endif
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                            </div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new">
                                                    Select image </span>
                                                    <span class="fileinput-exists">
                                                        Change
                                                    </span>
                                                    <input type="file" name="image">
                                                </span>
                                                <a href="javascript:void(0)" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label col-md-2">On Menu</label>
                                    <div class="col-md-10">
                                        <input type="checkbox" class="form-control" name="on_menu" {{ isset($offer['menu_id']) && $offer['menu_id'] ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label col-md-2">Active</label>
                                    <div class="col-md-10">
                                        <input type="checkbox" class="form-control" name="active" {{ !isset($offer['active']) || $offer['active'] ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Description</label>
                                <div class="col-md-10">
                                    <textarea class="form-control " id="description" name="description">{{ $offer['description'] or '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="meta">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Meta Title</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control maxlength-handler" name="meta_title" value="{{ $offer['meta_title'] or '' }}" maxlength="50" placeholder="">
                                    <span class="help-block">
                                    max 50 chars </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Meta Description</label>
                                <div class="col-md-10">
                                    <textarea class="form-control maxlength-handler" rows="8" name="meta_description" maxlength="255">{{ $offer['meta_description'] or '' }}</textarea>
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
                                        <input type="checkbox" class="form-control" name="on_home" {{ isset($offer['home_id']) && $offer['home_id'] ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Home Description</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" id="home_description" style="height: 175px;" name="home_description" maxlength="255">{{ $offer['home_description'] or '' }}</textarea>
                                    <span class="help-block">
                                    max 255 chars </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="products">
                        <div class="form-body">
                            <div class="text-align-reverse margin-bottom-10">
                                <a class="btn green" href="#product-div" data-toggle="modal">
                                <i class="fa fa-plus"></i> Add Product </a>
                            </div>
                            <table id="product-table" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr role="row" class="heading">
                                    <th width="5%">
                                        #
                                    </th>
                                    <th width="25%">
                                        Name
                                    </th>
                                    <th width="15%" class="text-center">
                                        Image
                                    </th>
                                    <th width="25%">
                                        Offer Description
                                    </th>
                                    <th class="text-center" width="10%">
                                        Tool
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if( !isset($offer['products']) || empty($offer['products']) )
                                    <tr class="empty"><td class="text-center" colspan="5">No data available in table</td></tr>
                                @else
                                <?php $i = 0; ?>
                                @foreach($offer['products'] as $product)
                                <?php $key = $product['id'];  ?>
                                <tr role="row" class="{{ $i%2 == 0 ? 'even' : 'odd' }}" data-id="{{ $key }}">
                                    <td>
                                        {{ ++$i }}
                                    </td>
                                    <td>
                                        <input type="hidden" class="product-id" name="products[{{ $key }}][id]" value="{{ $key }}" />
                                        <input type="hidden" class="delete" name="products[{{ $key }}][delete]" value="0" />
                                        {{ $product['name'] }}
                                    </td>
                                    <td class="text-center">
                                        <img src="{{ $product['image'] }}" style="width: 110px;">
                                    </td>
                                    <td><textarea rows="5" resize="none" class="form-control" name="products[{{ $key }}][description]">{{ $product['description'] }}</textarea></td>
                                    <td class="text-center">
                                        <a class="btn btn-primary red btn-delete-button btn-sm" onclick="deleteRow(this)" href="javascript:void(0);" title="Delete"><i class="fa fa-times"></i>Delete </a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{ Form::close() }}
</div>
@section('pageCSS')
<link rel="stylesheet" type="text/css" href="{{ URL::asset( 'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css' ) }}">
<style type="text/css">
#product-div .modal-dialog{
    width: 100%;
    margin: 0;
}
#product-div .modal-body{
    height: 550px;
    overflow-y: auto !important;
}
</style>
@stop
@section('pageJS')
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/jquery-validation/js/jquery.validate.min.js' ) }}"></script>
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js' ) }}"></script>
<script src="{{ URL::asset( 'assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js' ) }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/datatables/media/js/jquery.dataTables.min.js' ) }}"></script>
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js' ) }}"></script>
<script type="text/javascript">
$("#product-div").parent().css("overflow", "scroll !important");
var columnDefs = [
        {
            "targets": 2,
            "name"  : "name",
        },
        {
            "targets": 3,
            "className" : "text-center",
            "orderable": false,
            "name"  : "image",
            "data" : function(row, type, val, meta) {
                var html = '<img src="{{ URL }}/assets/images/noimage/110x110.gif" style="width: 110px; height: 110px;" />';
                if( row[3] ){
                    html = '<img src="'+row[3]+'" style="width: 110px;" />';
                }
                return html;
            }
        },
    ];
listRecord({
    url: "{{ URL.'/admin/products/list-product' }}",
    table_id: "#list-product",
    columnDefs: columnDefs,
    pageLength: 10,
    fnDrawCallback: function(){
        $("tr[role=row]", "#list-product > tbody").click(function(){
            var row = $("#list-product").DataTable().row($(this)).data();
            var exists = false;
            $('#product-table .product-id').each(function(){
                if( row[1] == $(this).val() ) {
                    exists = true;
                    return false;
                }
             });
            if( !exists ) {
                addProduct({id: row[1], name: row[2], image: row[3]});
                $("#product-div").modal("hide");
            } else {
                toastr.error('This product existed. Choose another one.', 'Error');
            }
        });
    },
});
$("#offer-form").validate({
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
        $(".alert-danger","#offer-form").show();
        Metronic.scrollTo($(".alert-danger","#offer-form"), -200);
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
        $(".alert-danger","#offer-form").hide();
        this.submit();
    }
});
$(".maxlength-handler").maxlength({
    limitReachedClass: "label label-danger",
    alwaysShow: true,
    threshold: 5
});
function addProduct(data)
{
    var index = $("tbody > tr[class!=empty]", "#product-table").length;
    if( !index ){
        $("tr.empty", "#product-table").remove();
    }
    var key = $("tbody > tr:last", "#product-table").attr("data-id");
    if( key == undefined ) {
        key = 0;
    } else {
        key++;
    }
    var className = "odd";
    if( index%2 == 0 ) {
        className = "even";
    }
    var html = [
            '<tr class="'+className+'" data-id="'+key+'">',
                '<td>',
                    ++index,
                "</td>",
                '<td>',
                    '<input type="hidden" class="product-id" name="products['+key+'][id]" value="'+data.id+'" />',
                    '<input type="hidden" name="products['+key+'][new]" value="'+data.id+'" />',
                    data.name,
                "</td>",
                '<td class="text-center">',
                    '<img src="'+ data.image +'" style="width: 110px;">',
                "</td>",
                '<td>',
                    '<textarea rows="5" resize="none" class="form-control" name="products['+key+'][description]" ></textarea>',
                "</td>",
                '<td  class="text-center">',
                    '<a class="btn btn-primary red btn-delete-button btn-sm" onclick="deleteRow(this)" href="javascript:void(0);" title="Delete"><i class="fa fa-times"></i>Delete </a>',
                "</td>",
            "</tr>"
    ].join("");
    $("tbody", "#product-table").append(html);
}

function deleteRow(object)
{
    var tableID = '#product-table';
    var parent = $(object).parent().parent();
    if($(".delete", parent).length) {
        bootbox.confirm('Are you sure you want to delete this product?', function(result){
            if(result) {
                $("input.delete", parent).val(1);
                $(parent).hide();
                $("tr.details[data-id="+ $(object).closest("tr").attr("data-id") +"]", tableID).remove();
                resetIndexTable(tableID);
            }
        });
    } else {
        $(parent).fadeOut().remove();
        $("tr[data-id="+ $(object).closest("tr").attr("data-id") +"]", tableID).remove();
        resetIndexTable(tableID);
    }
}

function resetIndexTable(tableID)
{
    var i = 0;
    $(tableID +" tbody > tr").not(':hidden').each(function(){
        $(this).removeClass("odd").removeClass("even");
        className = "odd";
        if( i%2 == 0 ) {
            className = "even";
        }
        $(this).addClass(className);
        console.log($("td:first", this));
        $("td:first", this).text(++i);
    });
}
</script>
@stop
