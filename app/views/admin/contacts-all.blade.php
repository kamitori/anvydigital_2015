<div class="row">
    <div class="col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-wechat"></i>Feedback Listing
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-container">
                    <table class="table table-striped table-hover table-bordered" id="list-contact">
                        <thead>
                            <tr role="row" class="heading">
                                <th>#</th>
                                <td>Id</td>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Company</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th class="text-center">Status</th>
                                <th>Created at</th>
                                <th class="text-center">
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
                                    <input type="text" class="form-control form-filter input-sm" name="search[company]">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="search[phone]">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="search[email]">
                                </td>
                                <td>
                                    <select name="search[subject]" class="form-control form-filter input-sm">
                                        <option value=""></option>
                                        @foreach (['General question','Quote request','Order status','Technical problem','File setup questions','Product questions','Shipping questions','Mailing inquiries','Feedback review','Account billing','Business development','Other'] as $subject)
                                            <option value="{{ $subject }}">{{ $subject }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="search[message]">
                                </td>
                                <td>
                                    <select name="search[read]" class="form-control form-filter input-sm">
                                        <option value=""></option>
                                        <option value="yes">{{ 'Read' }}</option>
                                        <option value="no">{{ 'Unread' }}</option>
                                    </select>
                                </td>
                                <td class="text-center"></td>
                                <td class="text-center">
                                	<button id="search-button" class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i>{{ 'Search' }}</button>
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
<style type="text/css" media="screen">
.limit-text{
	max-width: 250px;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}

.tooltip-inner{
	max-width:400px !important;
	font-size: 115%;
	text-align: justify !important;
}
</style>
@stop
@section('pageJS')
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/datatables/media/js/jquery.dataTables.min.js' ) }}"></script>
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js' ) }}"></script>
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js' ) }}"></script>
<script type="text/javascript">
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
            "name"  : "company"
        },
        {
            "targets": 5,
            "name"  : "phone"
        },
        {
            "targets": 6,
            "name"  : "email"
        },
        {
            "targets": 7,
            "name"  : "subject"
        },
        {
            "targets": 8,
            "className" : "limit-text",
            "name"  : "message",
            "data" : function(row, type, val, meta) {
                var html = '';
                html='<span data-title="'+row[8]+'">'+row[8].replace("<br />"," ")+'</span>'
                return html;
            }
        },
        {
            "targets": 9,
            "className" : "text-center",
            "name"  : "read",
            "data" : function(row, type, val, meta) {
                var html = '';
                if( row[9] ) {
                    html = '<span class="label label-sm label-success">Read</span>';
                } else {
                    html = '<span class="label label-sm label-danger">Unread</span>';
                }
                return '<a href="javascript:void(0)" class="xeditable-select" data-escape="true" data-name="read" data-type="select" data-value="'+row[9]+'" data-pk="'+row[1]+'" data-url="{{ URL.'/admin/contacts/update-contact'}}" data-title="On Menu">'+html+'</a>';
            }
        },
        {
            "targets": 10,
            "className" : "text-center",
            "name"  : "created_at",
        },
    ];
listRecord({
    url: "{{ URL.'/admin/contacts/list-contact' }}",
     delete_url: "{{ URL.'/admin/contacts/delete-contact' }}",
    table_id: "#list-contact",
    columnDefs: columnDefs,
    pageLength: 20,
    fnDrawCallback: function(){
        $("tbody td.limit-text","#list-contact").tooltip({
    		title: function(){
    			return $(this).find('span').attr("data-title");
    		},
    		container: 'body'
        });
        $(".xeditable-select","#list-contact").editable({
            source: [{value: 1, text: "Read"},{value: 0, text: "Unread"}],
            success: function(response, newValue){
                 if( response.status == "ok" ) {
                    toastr.success(response.message, 'Message');
                } else {
                    return response.message;
                }
            }
        });
    },
});

</script>
@stop