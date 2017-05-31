
<div class="row">
    <div class="col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa icon-users"></i>{{ 'User Listing' }}
                </div>
                <div class="actions">
                    <span id="loading_data" style="display:none"> <img src="/images/fancybox_loading@2x.gif" style="max-height:25px;"/> LOADING.... PLEASE WAIT</span>
                    <a id="export_users" class="btn default yellow-stripe">
                        <i class="fa fa-export"></i>
                        <span class="hidden-480">Export User</span>
                    </a>
                    <a href="{{ URL.'/admin/users/add-user' }}" class="btn default yellow-stripe">
                        <i class="fa fa-plus"></i>
                        <span class="hidden-480">New User</span>
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-container">
                    <table class="table table-striped table-hover table-bordered" id="list-user">
                        <thead>
                            <tr role="row" class="heading">
                                <th>
                                    #
                                </th>
                                <td>Id</td>
                                <th>
                                    First name
                                </th>
                                <th>
                                    Last name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Avatar
                                </th>
                                <th>
                                    Active
                                </th>
                                <th>
                                    VIP
                                </th>
                                <th>
                                    Subscribe at
                                </th>
                                <th>
                                    Last login
                                </th>
                                <th class="text-center" width="18%">
                                     {{'Tools'}}
                                </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td></td>
                                <td></td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="search[first_name]">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="search[last_name]">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="search[email]">
                                </td>
                                <td></td>
                                <td>
                                    <select name="search[active]" class="form-control form-filter input-sm">
                                        <option value=""></option>
                                        <option value="yes">{{ 'Yes' }}</option>
                                        <option value="no">{{ 'No' }}</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="search[vip]" class="form-control form-filter input-sm">
                                        <option value=""></option>
                                        <option value="yes">{{ 'VIP' }}</option>
                                        <option value="no">{{ 'Normal' }}</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="search[subscribe]" class="form-control form-filter input-sm">
                                        <option value=""></option>
                                        <option value="yes">{{ 'Yes' }}</option>
                                        <option value="no">{{ 'No' }}</option>
                                    </select>                                    
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
$(function(){
    $("#export_users").on('click',function(){        
        var ajaxConfig  = {
            url : "{{ URL }}/admin/users/ExportUser",
            type: "POST",
            beforeSend:function(){
                $("#loading_data").show();
                $("#export_users").attr('disabled',true);
            },
            success: function(result) {
                $("#loading_data").hide();
                $("#export_users").attr('disabled',false);
                if( result.status == "ok" ) {
                    location.href= result.message;
                } else {
                    toastr.error(result.message, "Error");
                }
            },error:function(){
                $("#loading_data").hide();
                $("#export_users").attr('disabled',false);
            }
        };
        $.ajax(ajaxConfig);
    });
});
var columnDefs = [
        {
            "targets": 2,
            "name"  : "first_name"
        },
        {
            "targets": 3,
            "name"  : "last_name"
        },
        {
            "targets": 4,
            "name"  : "email"
        },
        {
            "targets": 5,
            "className" : "text-center",
            "orderable": false,
            "name"  : "avatar",
            "data" : function(row, type, val, meta) {
                var html = '<img src="{{ URL }}/assets/images/noimage/110x110.gif" style="width: 110px;" />';
                if( row[5] ){
                    html = '<img src="{{ URL }}/'+row[5]+'" style="width: 110px; " />';
                }
                return html;
            }
        },
        {
            "targets": 6,
            "className" : "text-center",
            "name"  : "active",
            "data" : function(row, type, val, meta) {
                var html = '';
                if( row[6]==1 ) {
                    html = '<span class="label label-sm label-success">Yes</span>';
                } else {
                    html = '<span class="label label-sm label-danger">No</span>';
                }
                return '<a href="javascript:void(0)" class="xeditable-select" data-escape="true" data-name="active" data-type="select" data-value="'+row[6]+'" data-pk="'+row[1]+'" data-url="{{ URL.'/admin/users/update-user' }}" data-title="Active">'+html+'</a>';
            }
        },

        {
            "targets": 7,
            "className" : "text-center",
            "name"  : "vip",
            "data" : function(row, type, val, meta) {
                var html = '';
                if( row[7]==1 ) {
                    html = '<span class="label label-sm label-success">VIP</span>';
                } else {
                    html = '<span class="label label-sm label-danger"></span>';
                }
                return '<a href="javascript:void(0)" class="xeditable-select" data-escape="true" data-name="vip" data-type="select" data-value="'+row[7]+'" data-pk="'+row[1]+'" data-url="{{ URL.'/admin/users/update-user' }}" data-title="User VIP">'+html+'</a>';
            }
        },
        {
            "targets": 8,
            "name"  : "subscribe_at"
        },
         {
            "targets": 9,
            "name"  : "last_login"
        },
    ];
listRecord({
    url: "{{ URL.'/admin/users/list-user' }}",
    edit_url: "{{ URL.'/admin/users/edit-user' }}",
    delete_url: "{{ URL.'/admin/users/delete-user' }}",
    table_id: "#list-user",
    columnDefs: columnDefs,
    pageLength: 20,
    fnDrawCallback: function(){
        $(".xeditable-select[data-name=active]","#list-user").editable({
            source: [{value: 1, text: "Yes"},{value: 0, text: "No"}],
            success: function(result) {
                if (result.message) {
                    if (result.status == 'ok') {
                        toastr.success(result.message, 'Message');
                    } else {
                        toastr.error(result.message, 'Error');
                    }
                }
            }
        });
    },
});
</script>
@stop