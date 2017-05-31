<div class="row">
    <div class="col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa icon-grid"></i>{{ 'Product Category Listing' }}
                </div>
                <div class="actions">
                    <a href="{{ URL }}/admin/product-offers/add-offer" class="btn default yellow-stripe">
                        <i class="fa fa-plus"></i>
                        <span class="hidden-480">New Product Offer</span>
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-container">
                    <table class="table table-striped table-hover table-bordered" id="list">
                        <thead>
                            <tr role="row" class="heading">
                                <th>#</th>
                                <td>Id</td>
                                <th>Name</th>
                                <th class="text-center">Image</th>
                                <th>Description</th>
                                <th class="text-center">On Menu</th>
                                <th class="text-center">On Home</th>
                                <th class="text-center">Active</th>
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
                                    <select name="search[on_menu]" class="form-control form-filter input-sm">
                                        <option value=""></option>
                                        <option value="yes">{{ 'Yes' }}</option>
                                        <option value="no">{{ 'No' }}</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="search[on_home]" class="form-control form-filter input-sm">
                                        <option value=""></option>
                                        <option value="yes">{{ 'Yes' }}</option>
                                        <option value="no">{{ 'No' }}</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="search[active]" class="form-control form-filter input-sm">
                                        <option value=""></option>
                                        <option value="yes">{{ 'Yes' }}</option>
                                        <option value="no">{{ 'No' }}</option>
                                    </select>
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
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/datatables/media/js/jquery.dataTables.min.js' ) }}"></script>
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js' ) }}"></script>
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js' ) }}"></script>
<script type="text/javascript">
var columnDefs = [
        {
            "targets": 2,
            "name"  : "name",
            "data" : function(row, type, val, meta) {
                return '<a href="javascript:void(0)" class="xeditable-select" data-escape="true" data-name="name" data-type="text" data-value="'+row[2]+'" data-pk="'+row[1]+'" data-url="{{ URL.'/admin/product-offers/update-offer' }}" data-title="On Menu">'+row[2]+'</a>';
            }
        },
        {
            "targets": 3,
            "className" : "text-center",
            "orderable": false,
            "name"  : "image",
            "data" : function(row, type, val, meta) {
                var html = '<img src="{{ URL }}/assets/images/noimage/110x110.gif" style="width: 110px; height: 110px;" />';
                if( row[3] ){
                    html = '<img src="{{ URL }}/'+row[3]+'" style="width: 110px;" />';
                }
                return html;
            }
        },
        {
            "targets": 4,
            "name"  : "description",
            "data" : function(row, type, val, meta) {
                return '<a href="javascript:void(0)" class="xeditable-select" data-escape="true" data-name="description" data-type="textarea" data-value="'+row[4]+'" data-pk="'+row[1]+'" data-url="{{ URL.'/admin/product-offers/update-offer' }}" data-title="On Menu">'+row[4]+'</a>';
            }
        },
        {
            "targets": 5,
            "className" : "text-center",
            "name"  : "active",
            "data" : function(row, type, val, meta) {
                var html = '';
                if( row[5] ) {
                    html = '<span class="label label-sm label-success">Yes</span>';
                } else {
                    html = '<span class="label label-sm label-danger">No</span>';
                }
                return '<a href="javascript:void(0)" class="xeditable-select" data-escape="true" data-name="on_menu" data-type="select" data-value="'+row[5]+'" data-pk="'+row[1]+'" data-url="{{ URL.'/admin/product-offers/update-offer' }}" data-title="On Menu">'+html+'</a>';
            }
        },
         {
            "targets": 6,
            "className" : "text-center",
            "name"  : "active",
            "data" : function(row, type, val, meta) {
                var html = '';
                if( row[6] ) {
                    html = '<span class="label label-sm label-success">Yes</span>';
                } else {
                    html = '<span class="label label-sm label-danger">No</span>';
                }
                return '<a href="javascript:void(0)" class="xeditable-select" data-escape="true" data-name="on_home" data-type="select" data-value="'+row[6]+'" data-pk="'+row[1]+'" data-url="{{ URL.'/admin/product-offers/update-offer' }}" data-title="On Menu">'+html+'</a>';
            }
        },
        {
            "targets": 7,
            "className" : "text-center",
            "name"  : "active",
            "data" : function(row, type, val, meta) {
                var html = '';
                if( row[7] ) {
                    html = '<span class="label label-sm label-success">Yes</span>';
                } else {
                    html = '<span class="label label-sm label-danger">No</span>';
                }
                return '<a href="javascript:void(0)" class="xeditable-select" data-escape="true" data-name="active" data-type="select" data-value="'+row[7]+'" data-pk="'+row[1]+'" data-url="{{ URL.'/admin/product-offers/update-offer' }}" data-title="Active">'+html+'</a>';
            }
        },
    ];
listRecord({
    url: "{{ URL.'/admin/product-offers/list-offer' }}",
    edit_url: "{{ URL.'/admin/product-offers/edit-offer' }}",
    delete_url: "{{ URL.'/admin/product-offers/delete-offer' }}",
    table_id: "#list",
    columnDefs: columnDefs,
    pageLength: 20,
    fnDrawCallback: function(){
        $(".xeditable-select","#list").editable({
            source: [{value: 1, text: "Yes"},{value: 0, text: "No"}]
        });
    },
});
$('[data-toggle="tooltip"]').tooltip();
</script>
@stop