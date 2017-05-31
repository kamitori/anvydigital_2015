<div class="row">
    <div class="col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa icon-screen-tablet"></i>{{ 'Layout Listing' }}
                </div>
                <div class="actions">
                    <a href="{{ URL.'/admin/layouts/add-layout' }}" class="btn default yellow-stripe" data-toggle="modal">
                        <i class="fa fa-plus"></i>
                        <span class="hidden-480">New Layout</span>
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-container">
                    <table class="table table-striped table-hover table-bordered" id="list-layout">
                        <thead>
                            <tr role="row" class="heading">
                                <th>#</th>
                                <td>Id</td>
                                <th>Name</th>
                                <th width="20%">Preview</th>
                                <th>Active</th>
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
                return '<a href="javascript:void(0)" class="xeditable-input" data-escape="true" data-name="name" data-type="text" data-pk="'+row[1]+'" data-url="{{ URL.'/admin/layouts/update-layout' }}">'+row[2]+'</a>';
            }
        },
        {
            "targets": 3,
            "className" : "text-center",
            "name"  : "svg_file",
            "data" : function(row, type, val, meta) {
                var html = '';
                if( row[3] ) {
                    var ratio = row[5],
                        width,
                        height,
                        defaultLength = 100;

                    if( ratio > 1 ) {
                        width = defaultLength;
                        height = width / ratio;
                    } else {
                        height = defaultLength;
                        width = height * ratio;
                    }
                    html = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="'+ width +'" height="'+ height +'"> \
                            <use xlink:href="{{ URL }}/'+ row[3]  +'"></use> \
                            </svg>';
                }
                return html;
            }
        },
        {
            "targets": 4,
            "className" : "text-center",
            "name"  : "active",
            "data" : function(row, type, val, meta) {
                var html = '';
                if( row[4] ) {
                    html = '<span class="label label-sm label-success">Yes</span>';
                } else {
                    html = '<span class="label label-sm label-danger">No</span>';
                }
                return '<a href="javascript:void(0)" class="xeditable-select" data-escape="true" data-name="active" data-type="select" data-value="'+row[4]+'" data-pk="'+row[1]+'" data-url="{{ URL.'/admin/layouts/update-layout' }}" data-title="Active">'+html+'</a>';
            }
        },
    ];
var objSVG = {};
listRecord({
    url: "{{ URL.'/admin/layouts/list-layout' }}",
    edit_url: "{{ URL.'/admin/layouts/edit-layout' }}",
    delete_url: "{{ URL.'/admin/layouts/delete-layout' }}",
    table_id: "#list-layout",
    columnDefs: columnDefs,
    pageLength: 20,
    fnDrawCallback: function(){
        $("a.xeditable-input","#list-layout").editable({
            success: function(response, newValue){
                if( response.status == "ok" ) {
                    toastr.success(response.message, 'Message');
                } else {
                    return response.message;
                }
            }
        });
        $(".xeditable-select[data-name=active]","#list-layout").editable({
            source: [{value: 1, text: "Yes"},{value: 0, text: "No"}]
        });
        $('use').each(function() {
            var url = $(this).attr('xlink:href');
            if( typeof objSVG[ url ] == 'undefined' ) {
                $.ajax({
                    url: url,
                    async: false,
                    success: function(svg) {
                        objSVG[ url ] = new XMLSerializer().serializeToString(svg.documentElement);;
                    }
                });
            }
            var parent = $(this).parent();
            $(parent).html(objSVG[ url ]);
            var svg = $(parent).find('svg')[0];
            var width = svg.getAttribute('width');
            var height = svg.getAttribute('height');
            svg.setAttribute('width', $(parent).attr('width'));
            svg.setAttribute('height', $(parent).attr('height'));
            svg.setAttribute('viewBox', '0 0 '+ width +' '+ height);
        });
    },
});
</script>
@stop