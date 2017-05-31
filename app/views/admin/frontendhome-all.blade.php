@section('body')
<body class="page-header-fixed page-header-fixed-mobile page-quick-sidebar-over-content page-style-square pace-done page-sidebar-closed">
@stop
@section('sideMenu')
<ul id="sidebar-menu" class="page-sidebar-menu page-sidebar-menu-closed {{ isset($currentTheme['sidebar']) && $currentTheme['sidebar'] == 'fixed' ? 'page-sidebar-menu-fixed' : 'page-sidebar-menu-default' }}" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
@stop
<div id="image-home-div" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body form">
                <form class="form-horizontal form-row-seperated">
                    <div class="form-group">
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
                                    </span>
                                    <a href="javascript:void(0)" class="btn red fileinput-exists" data-dismiss="fileinput">
                                    Remove </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Link</label>
                        <div class="col-sm-8">
                            <input id="item-link" class="form-control" type="text" placeholder="link" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="image-home-submit" class="btn btn-primary"><i class="fa fa-check"></i>Save change</button>
            </div>
        </div>
    </div>
</div>
<div id="category-div" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="overflow-y: auto !important;">
            <div class="modal-body">
                <table class="table table-striped table-hover table-bordered" id="list-category">
                    <thead>
                        <tr role="row" class="heading">
                            <th>#</th>
                            <td>Id</td>
                            <th>Name</th>
                            <th><i href="#" data-toggle="tooltip" title="Cover of lastest product">Image</i></th>
                            <th>Home Description</th>
                            <th class="text-center" width="3%">
                                 {{'Tools'}}
                            </th>
                        </tr>
                        <tr role="row" class="filter">
                            <td><input type="hidden" name="extra[call_from]" value="homes"></td>
                            <td></td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="search[name]">
                            </td>
                            <td></td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="search[home_description]">
                            </td>
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
<div id="social-home-div" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body form">
                <form class="form-horizontal form-row-seperated">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Name</label>
                        <div class="col-sm-8">
                            <input id="item-name" class="form-control" type="text" placeholder="Facebook" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Link</label>
                        <div class="col-sm-8">
                            <input id="item-link" class="form-control" type="text" placeholder="{{ URL }}" />
                            <input id="item-id" class="form-control" type="hidden" value="" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="social-home-submit" class="btn btn-primary"><i class="fa fa-check"></i>Save change</button>
                <button type="button" id="social-home-delete" class="btn red"><i class="fa fa-times"></i>Delete</button>
            </div>
        </div>
    </div>
</div>
<div id="frontend-home" class="portlet light">
    <div class="portlet-title tabbable-line">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#main" data-toggle="tab" aria-expanded="true">
                Main </a>
            </li>
        </ul>
    </div>
    <div class="portlet-body">
        <div class="tab-content">
            <div class="tab-pane active" id="main">
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-credit-card"></i>Main
                        </div>
                        <div class="actions">
                            <button type="button" onclick="submitHome()" class="btn green"><i class="fa fa-check"></i> Save</button>
                        </div>
                    </div>
                    {{ Form::open(array('url'=>URL.'/admin/frontend-home/update-home', 'method'=> 'POST', 'class'=> 'form-horizontal', 'files' => true, 'id' => 'home-form') ) }}
                    <div class="portlet-body">
                        <div class="row home-title graybg">
                            <textarea class="title" name="home[header_title]" placeholder="title">{{ $configure['home']['header_title'] or '' }}</textarea>
                            <textarea class="description autosizeme" name="home[header_description]" placeholder="description">{{ $configure['home']['header_description'] or '' }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1 probox">
                                <div id="home-link" class="row homeproduct">
                                    @foreach($homes as $home)
                                    <div class="item col-md-3" data-id="{{ $home['id'] }}">
                                        <span class="closeimg" onclick="deleteFrontend(this)"></span>
                                        <img src="{{ !empty($home['image']) ? URL.'/'.$home['image'] : URL.'/assets/images/noimage/247x185.gif' }}" alt="" class="proimg" style="width: 250px;" />
                                        <input type="file" name="homes[{{ $home['id'] }}][image]" style="display: none;" />
                                        <input type="hidden" name="homes[{{ $home['id'] }}][id]" value="{{ $home['id'] }}" />
                                        <input type="hidden" class="delete" name="homes[{{ $home['id'] }}][delete]" value="0" />
                                        <input type="hidden" class="item-link" name="homes[{{ $home['id'] }}][link]" value="{{ $home['link'] }}" />
                                        <input type="text" name="homes[{{ $home['id'] }}][name]" placeholder="title" value="{{ $home['name'] }}" />
                                        <textarea name="homes[{{ $home['id'] }}][description]" placeholder="description">{{ $home['description'] }}</textarea>
                                    </div>
                                    @endforeach
                                    <div class="item btn col-md-3">
                                        <a onclick="addHomeLink()" data-toggle="modal">
                                            <span aria-hidden="true" class="icon-plus" style="font-size: 60px; margin-top: 62%;"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row home-title graybg">
                            <textarea class="title" name="home[main_title]" placeholder="title">{{ $configure['home']['main_title'] or '' }}</textarea>
                            <textarea class="description autosizeme" name="home[main_description]" placeholder="description">{{ $configure['home']['main_description'] or '' }}</textarea>
                        </div>
                        <div id="category-list" class="row hotproduct" style="background-color: #EEEEEE; ">
                            <div class="col-md-10 col-md-offset-1 probox">
                                <div class="row homeproduct">
                                    @foreach($categories as $category)
                                    <div class="item col-md-3">
                                        <span class="closeimg" onclick="deleteFrontend(this)"></span>
                                        <img src="{{ !empty($category['image']) ? URL.'/'.$category['image'] : URL.'/assets/images/noimage/247x185.gif' }}" alt="" class="proimg" style="width: 250px;" />
                                        <input class="category-id" type="hidden" name="categories[{{ $category['id'] }}][id]" value="{{ $category['id'] }}" />
                                        <input type="hidden" class="delete" name="categories[{{ $category['id'] }}][delete]" value="0" />
                                        <h2>{{ $category['name'] }}</h2>
                                        <textarea name="categories[{{ $category['id'] }}][description]" placeholder="description">{{ $category['description'] }}</textarea>
                                    </div>
                                    @endforeach
                                    <div class="item btn col-md-3">
                                        <a href="#category-div" data-toggle="modal">
                                            <span aria-hidden="true" class="icon-plus" style="font-size: 60px; margin-top: 62%;"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row home-title graybg" style="background-color:white; padding-bottom: 20px;">
                            <textarea class="title" name="home[footer_title]" placeholder="title">{{ $configure['home']['footer_title'] or '' }}</textarea>
                            <textarea class="description autosizeme" name="home[footer_description]" placeholder="description">{{ $configure['home']['footer_description'] or '' }}</textarea>
                            <div class="text-center" id="socials">
                                @foreach($socials as $social)
                                <a href="javascript:void(0)" class="item social" data-id="{{ $social['id'] }}">
                                    <img src="{{ URL }}/{{ $social['image'] }}" alt="" class="iconimg">
                                    <input type="hidden" name="socials[{{ $social['id'] }}][delete]" value="0" />
                                    <input type="hidden" name="socials[{{ $social['id'] }}][id]" value="{{ $social['id'] }}" />
                                    <input type="hidden" name="socials[{{ $social['id'] }}][link]" value="{{ $social['link'] }}" />
                                    <input type="hidden" name="socials[{{ $social['id'] }}][name]" value="{{ $social['name'] }}" />
                                </a>
                                @endforeach
                                <a id="social-add" data-toggle="popover">
                                    <span aria-hidden="true" class="icon-plus " style="width: 40px; height: 40px;" ></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

@section('pageCSS')
<link href="{{ URL::asset( 'assets/global/css/plugins.css' ) }}" rel="stylesheet" type="text/css"/>

<link href="{{ URL::asset( 'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css' ) }}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset( 'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css' ) }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset( 'assets/css/fonts.css' ) }}" />
<style type="text/css">
#category-div .modal-body{
    height: 550px;
    overflow-y: auto !important;
}
#frontend-home #main {
    font-family: 'Myriad W01 Regular';
    font-size: 14px;
    margin: 0 auto 0 auto;
    background-repeat: repeat;
    background-color: #fff;
    line-height: 1.42857143;
}
#frontend-home #main .closeimg {
    right: 6px;
}
#frontend-home #main .graybg {
    background-color: #EEEEEE;
}
#frontend-home #main .home-title textarea.title {
    width: 100%;
    border: none;
    resize: none;
    background: none;
    overflow: hidden !important;
    text-align: center;
    padding: 20px 0 5px 0;
    margin: 0;
    font-size: 28px;
    line-height: 35px;
    color: #333333;
    font-family: 'Myriad W01 Light';
}
#frontend-home #main .home-title textarea.description {
    width: 100%;
    border: none;
    resize: none;
    background: none;
    overflow: hidden !important;
    color: rgb(102, 102, 102);
    display: block;
    font-family: 'Myriad W01 Regular';
    font-size: 16px;
    height: 22px;
    line-height: 23px;
    text-align: center;
    padding-bottom: 45px;
}
#frontend-home #main .probox {
    padding-right: 0px;
    padding-left: 0px;
}
#frontend-home #main .homeproduct {
    text-align: center;
    margin: auto;
    margin-bottom: 25px;
    margin-top: 1%;
}
#frontend-home #main .homeproduct .item {
    padding-right: 5px;
    padding-left: 5px;
    margin-bottom: 35px;
}
#frontend-home #main .homeproduct .item.btn {
    border:dashed 2px;
    height: 284px;
    width: 250px;
}

#frontend-home #main .homeproduct .item h5 {
    padding-top: 10px;
    font-size: 24px;
    font-family: 'Myriad W01 Light';
    color: #333333;
}
#frontend-home #main .homeproduct .item .proimg {
    height: 184px;
    width: 276px;
}
#frontend-home #main input {
    border: none;
    padding-top: 10px;
    font-size: 24px;
    font-family: 'Myriad W01 Light';
    color: #333333;
    width: 250px;
    text-align: center;
}
#frontend-home #main .item textarea {
    background: none;
    border: none;
    resize: none;
    overflow: hidden;
    min-height: 50px;
    text-align: center;
    font-size: 16px;
    font-family: 'Myriad W01 Regular';
    padding: 0px 5px 0px 5px;
    width: 250px;
    color: #666666;
}
#frontend-home #main .iconimg {
    width: 40px;
    height: 40px;
    margin: 0px 5px 0px 5px;
}
</style>
@stop
@section('pageJS')
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/datatables/media/js/jquery.dataTables.min.js' ) }}"></script>
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js' ) }}"></script>
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js' ) }}"></script>
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/autosize/autosize.min.js' ) }}"></script>
<script src="{{ URL::asset( 'assets/global/plugins/fuelux/js/spinner.js' ) }}"></script>
<script type="text/javascript">
$('[data-toggle=tooltip]').tooltip();
$("#category-div").parent().css("overflow", "scroll !important");
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
                    html = '<img src="{{ URL }}/'+row[3]+'" style="width: 110px;" />';
                }
                return html;
            }
        },
        {
            "targets": 4,
            "name"  : "home_description",
        },
    ];
listRecord({
    url: "{{ URL.'/admin/product-categories/list-product-category' }}",
    table_id: "#list-category",
    columnDefs: columnDefs,
    pageLength: 10,
    fnDrawCallback: function(){
        $("tr[role=row]", "#list-category > tbody").click(function(){
            var row = $("#list-category").DataTable().row($(this)).data();
            var exists = false;
            $('#category-list .item:not(:hidden) [name*="[id]"]').each(function(){
                if( row[1] == $(this).val() ) {
                    exists = true;
                    return false;
                }
             });
            if( !exists ) {
                var url = '';
                if( row[3] ) {
                    url = '{{ URL }}/' + row[3];
                } else {
                    url = '{{ URL }}/assets/images/noimage/247x185.gif';
                }
                if( row[4] == null ) {
                    row[4] = '';
                }
                addCategory({id: row[1], name: row[2], image: url, description: row[4]});
                $("#category-div").modal("hide");
            } else {
                toastr.error('This category existed. Choose another one.', 'Error');
            }
        });
    },
});
autosize($('#frontend-home #main textarea'));
$("#spinner-content").spinner({ value : 1, min: 1 });

$('#main #home-link').on('click', 'img', function() {
    var object = this;
    $('#image-home-div').modal('show');
    $('#image-home-div img').attr('src', $(this).attr('src'));
    $('#image-home-div #item-link').val($(this).parent().find('.item-link').val());
    $('#image-home-div span.fileinput-new').unbind('click').click(function(){
        console.log($(object).parent());
        $(object).parent().find('input[type=file]').click();
    });
    $('#image-home-div [data-dismiss="modal"]').click(function(){
        $(object).parent().find('[type=file]').val('');
    });
    $('#image-home-div #image-home-submit').click(function(){
        $(object).attr('src', $('#image-home-div img').attr('src') );
        $(object).parent().find('.item-link').val($('#image-home-div #item-link').val());
        $('#image-home-div').modal('hide');
    });
}).on('change', 'input[type=file]', function() {
    var file = $(this)[0].files[0];
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function(e){
        var src = e.target.result;
        $('#image-home-div img').attr('src', src);
    };
});

function addHomeLink()
{
    var key = $('#frontend-home #main #home-link .item').not('.btn').not(':hidden').length;
    var html = '<div class="item col-md-3" data-id="'+ key +'">'
            +      '<span class="closeimg" onclick="deleteFrontend(this)"></span>'
            +      '<img src="{{ URL }}/assets/images/noimage/247x185.gif" alt="" class="proimg" style="width: 250px;" />'
            +       '<input type="file" style="display: none;" name="homes['+ key +'][image]" value="" />'
            +       '<input type="hidden" class="item-link" name="homes['+ key +'][link]" value="" />'
            +       '<input type="text" name="homes['+ key +'][name]" placeholder="title" value="" />'
            +       '<textarea name="homes['+ key +'][description]" placeholder="description"></textarea>'
            +  '</div>';
    $('#frontend-home #main #home-link .item.btn').before(html);
}

function deleteFrontend(object)
{
    var parent = $(object).parents('.item');
    if( !$('.delete', parent) ) {
        $(parent).remove();
    } else {
        bootbox.confirm('Are you sure you want to delete this link?', function(result){
            if( result ) {
                $('.delete', parent).val(1);
                $(parent).hide();
            }
        });
    }
}

function addCategory(data)
{
    var id = data.id;
    var html = '<div class="item col-md-3" data-id="'+ id +'">'
            +      '<span class="closeimg" onclick="deleteFrontend(this)"></span>'
            +      '<img src="'+ data.image +'" alt="" class="proimg" style="width: 250px;" />'
            +      '<input name="categories['+ id +'][id]" type="hidden" value="'+ id +'" />'
            +       '<h2>'+ data.name +'</h2>'
            +       '<textarea name="categories['+ id +'][description]" placeholder="description">'+ data.description +'</textarea>'
            +  '</div>';
    $('#frontend-home #main #category-list .item.btn').before(html);
}

$('#main #socials #social-add').popover({
    content: '<ul class="list-inline"><li><img src="{{ URL }}/assets/images/social_icon/facebook.png" style="width: 100%" title="Facebook" /></li><li><img src="{{ URL }}/assets/images/social_icon/google.png" style="width: 100%" title="Google" /></li><li><img src="{{ URL }}/assets/images/social_icon/pinterest.png" style="width: 100%" title="Pinterest" /></li><li><img src="{{ URL }}/assets/images/social_icon/twitter.png" style="width: 100%" title="Twitter" /></li><li><img src="{{ URL }}/assets/images/social_icon/youtube.png" style="width: 100%" title="Youtube" /></li><li><img src="{{ URL }}/assets/images/social_icon/in.png" style="width: 100%" title="Linkin" /></li></ul>',
    html: true,
    placement: 'right',
    container: 'body',
    trigger: 'click'
}).on('shown.bs.popover', function(){
    var currentObject = this;
    var id = $(this).attr('aria-describedby');
    var object = $('#'+id);
    $(object).find('img').click(function(){
        var src = $(this).attr('src');
        var exist = false;
        $('#frontend-home #main #socials .social:not(:hidden) img').each(function(){
            if( src == $(this).attr('src') ) {
                exist = true;
                return false;
            }
        });
        if( exist ) {
            toastr.error('You cannot choose existed icon. Please choose another one.', 'Duplicate');
        } else {
            var key = src.replace('{{ URL }}/', '');
            var html = '<a href="javascript:void(0)" class="item social" data-id="'+ key +'">'
                    +       '<img src="'+ src +'" alt="" class="iconimg">'
                    +       '<input type="hidden" name="socials['+ key +'][delete]" value="0" />'
                    +       '<input type="hidden" name="socials['+ key +'][image]" value="'+ key +'" />'
                    +       '<input type="hidden" name="socials['+ key +'][link]" value="" />'
                    +       '<input type="hidden" name="socials['+ key +'][name]" placeholder="Facebook" value="" />'
                    +   '</a>';
            $('#frontend-home #main #socials #social-add').before(html);
            $(currentObject).popover('hide');
        }
    });
});
$('#main #socials').on('click', '.social', function(){
    $('#social-home-div #item-link').val( $(this).find('[name*="[link]"]').val() );
    $('#social-home-div #item-name').val( $(this).find('[name*="[name]"]').val() );
    $('#social-home-div #item-id').val( $(this).data('id') );
    $('#social-home-div').modal('show');
});
$('#social-home-div #social-home-submit').click(function(){
    var id = $('#social-home-div #item-id').val();
    $('#main #socials [data-id="'+ id +'"] [name*="[link]"]').val($('#social-home-div #item-link').val());
    $('#main #socials [data-id="'+ id +'"] [name*="[name]"]').val($('#social-home-div #item-name').val());
    $('#social-home-div').modal('hide');
});
$('#social-home-div #social-home-delete').click(function(){
    var id = $('#social-home-div #item-id').val();
    $('#main #socials [data-id="'+ id +'"] [name*="[delete]"]').val(1);
    $('#main #socials [data-id="'+ id +'"]').hide();
    $('#social-home-div').modal('hide');
});
function submitHome()
{
    $('#home-form').submit();
}
</script>
@stop

