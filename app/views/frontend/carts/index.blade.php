<div class="modal fade" id="request-quote" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
          <form action="{{ URL.'/cart/order' }}" method="POST">
          <div class="modal-header">
            <h4 class="modal-title">Convert to Order</h4>
          </div>
          <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-3">PO number</label>
                    <div class="col-md-9">
                        <input type="text" name="po_number" class="form-control" placeholder="" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Due Date</label>
                    <div class="col-md-9">
                        <input type="text" name="due_date" readonly="readonly" class="form-control datepicker" placeholder="" value="{{ date('M d, Y') }}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Delivery Method</label>
                    <div class="col-md-9">
                        <select class="form-control" name="delivery_method">
                            @foreach($methods as $methodKey => $method)
                            <option value="{{ $methodKey }}">{{ $method }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Address</label>
                    <div class="col-md-9">
                        {{-- <select class="form-control" onchange="chooseAddress(this)">
                            <option value=""></option>
                        </select> --}}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3"></label>
                    <div class="col-md-9">
                        <input type="text" name="address_1" class="form-control" placeholder="Address 1" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3"></label>
                    <div class="col-md-9">
                        <input type="text" name="address_2" class="form-control" placeholder="Address 2" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3"></label>
                    <div class="col-md-9">
                        <input type="text" name="address_3" class="form-control" placeholder="Address 3" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Town / City</label>
                    <div class="col-md-9">
                        <input type="text" name="town_city" class="form-control" placeholder="Town / City" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Province / State</label>
                    <div class="col-md-9">
                        <select class="form-control" name="province_state">
                            @foreach($arrProvinces as $provinceKey => $province)
                            <option {{ $provinceKey == 'AB' ? 'selected' : '' }} value="{{ $provinceKey }}">{{ $province }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Zip / Post code</label>
                    <div class="col-md-9">
                        <input type="text" name="zip_postcode" class="form-control" placeholder="Zip Postcode" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Country</label>
                    <div class="col-md-9">
                        <select class="form-control" name="country" onchange="changeCountry(this)">
                            @foreach($arrCountries as $countryKey => $country)
                            <option {{ $countryKey == 'CA' ? 'selected' : '' }} value="{{ $countryKey }}">{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
        </form>
      </div>
    </div>

<div class="row">
    <div class="col-md-10 col-md-offset-1 alignfix tab-pane active">
        <div class="header_product_cont" style="margin-bottom:35px;">
            <h1>Checkout</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-10 col-md-offset-1 alignfix">
        <div class="tab-content">
                <div class="">
                    <h5 style="font-weight:bold;">Order summary</h5><br>
                    <table id="tblOrderSummary">
                        <tr class="tableheader">
                            <th>Order</th>
                            <th>Name</th>
                            <th>Cost (ex. VAT)</th>
                            <th>Quantity</th>
                            <th>File</th>
                            <th>Remove</th>
                            <th>Total (ex.VAT)</th>
                        </tr>
                        @foreach($cartItems as $item)
                        <tr class="orderline" data-id="{{ $item['rowid'] }}">
                            <td><img src="{{ $item['options']['image'] }}" height="40" width="40"><br></td>
                            <td><label class="label-normal">{{ $item['name'] }}</label></td>
                            <td>
                                <label class="label-normal">$<span class="price">{{ number_format($item['price'], 2) }}</span></label>
                            </td>
                            <td class="spinner-td">
                                <input class="itemQty form-control" id="{{ $item['rowid'] }}" value="{{ $item['qty'] }}" minlength="1" />
                            </td>
                            <td>
                                @if( isset($item['options']['file']) )
                                <a href="#" onclick="changeFile('{{ $item['rowid'] }}')" >{{ substr($item['options']['file'], strrpos($item['options']['file'], DS)+1) }}</a>
                                @else
                                <a href="#" onclick="changeFile('{{ $item['rowid'] }}')">Add File</a>
                                @endif
                                <input type="file" class="upload-file" style="display: none;" id="file-{{ $item['rowid'] }}" />
                            </td>
                            <td>
                                <a href="#" onclick="removeItem('{{ $item['rowid'] }}')">
                                    <img src="{{ URL.'/assets/images/closebutton.png' }}" height="30" width="30" />
                                </a>
                            </td>
                            <td>
                                <label class="label-normal">$<span class="sub-total">{{ number_format($item['options']['sub_total'], 2) }}</span></label>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <div class="order-line-dark">
                        <div style="margin-right:20px; line-height:25px;vertical-align:middle;">
                            Discount:
                            <label for="Discount" id="DiscountAmount">$0.00</label>
                        </div>
                    </div>
                    <div class="order-line-gray">
                        <div style="margin-right: 20px; line-height: 25px; vertical-align: middle;">
                            Sub-total(ex. VAT):
                            <label>$<span id="cart-total">{{ number_format($cartTotal, 2) }}</span></label>
                        </div>
                    </div>
                    @if (!empty($cartItems))
                    <div style="width:98%; margin-bottom:10px; margin-top : 20px;">
                        <div class="form-group pull-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#request-quote">Quotation Request</button>
                        </div>
                    </div>
                    @endif
                </div>
        </div>
    </div>
</div>
@section('pageCSS')
<link rel="stylesheet" type="text/css" href="{{URL::asset( 'assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.css' ) }}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css') }}"></script>
<style type="text/css" media="screen">
.datepicker-dropdown {
    z-index: 100000 !important;
}
.datepicker-dropdown .table-condensed {
    font-size: 13px !important;
}
</style>
@stop
@section('pageJS')
<script src="{{ URL::asset( 'assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js ') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
var updateQuantity = null;
$(".itemQty").TouchSpin({
   verticalbuttons: true,
   min: 1,
   step: 1,
   width: 50
}).change(function(){
    var quantity = parseFloat($(this).val());
    if( quantity <= 0 ) {
        return false;
    }
    var object = this;
    if( updateQuantity != null ) {
        clearTimeout(updateQuantity);
        updateQuantity = null;
    }
    updateQuantity = setTimeout(function() {
        var id = $(object).attr('id');
        var parent = $(object).closest('tr');
        $.ajax({
            url: '{{ URL.'/cart/update' }}',
            type: 'POST',
            data: {
                itemId: id,
                quantity: quantity
            },
            success: function(result) {
                if( result.status == 'ok' ) {
                    parent.find('.price').text( result.sell_price );
                    parent.find('.sub-total').text( result.sub_total );
                    $('#cart-quantity').text( result.cart_quantity );
                    $('#cart-total').text( result.cart_total );
                } else {
                    toastr.error(result.message, 'Error');
                }
            }
        });
    }, 500);
});
function removeItem(itemId)
{
    $.ajax({
        url: '{{ URL.'/cart/delete' }}',
        type: 'POST',
        data: {itemId : itemId},
        success: function(result) {
            if( result.status == 'ok' ) {
                $('#tblOrderSummary tr[data-id='+ itemId +']').fadeOut();
                toastr.success(result.message, 'Message');
                $('#cart-quantity').text( result.cart_quantity );
                $('#cart-total').text( result.cart_total );
            } else {
                toastr.error(result.message, 'Error');
            }
        }
    });
}
function changeFile(itemId)
{
    $('#file-'+ itemId).trigger('click');
}
$("input.datepicker").datepicker({
    format: "M d, yyyy",
    startDate: "{{ date('m/d/Y') }}",
    autoclose: true,
    todayHighlight: true
});
function chooseAddress(obj)
{
    var address = $(obj).val();
    var form = $(obj).closest("form");
    if( address == "" ) {
        $("input[name^=address_], input[name='zip_postcode'], input[name='town_city']", form).val("");
        $("select[name=province_state]", form).val("AB");
        $("select[name=country]", form).val("ca");
    } else {
        address = $.parseJSON(address);
        var arr = [];
        arr['address_1'] = address.hasOwnProperty("address_1") ? address.address_1 : "";
        arr['address_2'] = address.hasOwnProperty("address_2") ? address.address_2 : "";
        arr['address_3'] = address.hasOwnProperty("address_3") ? address.address_3 : "";
        arr['town_city'] = address.hasOwnProperty("town_city") ? address.town_city : "";
        arr['zip_postcode'] = address.hasOwnProperty("zip_postcode") ? address.zip_postcode : "";
        arr['country'] = address.hasOwnProperty("country_id") ? address.country_id : "";
        arr['province_state'] = address.hasOwnProperty("province_state_id") ? address.province_state_id : "";
        for(i in arr){
            if( $.inArray(i, ["country", "province_state"]) != -1 ) {
                $("select[name='"+i+"']", form).val(arr[i]);
                if( i == "country" ) {
                    $("select[name='"+i+"']", form).trigger("change");
                }
            } else {
                $("input[name='"+i+"']", form).val(arr[i]);
            }
        }
    }
}
var arrProvinces = [];
function changeCountry(obj)
{
    var countryID = $(obj).val();
    if( arrProvinces.hasOwnProperty(countryID) ){
        renderProvince(arrProvinces[countryID]);
    } else {
        $.ajax({
            url : "{{ URL.'/get-province/' }}" + countryID,
            success : function(result) {
                arrProvinces[countryID] = result;
                renderProvince(arrProvinces[countryID]);
            }
        });
    }
}
function renderProvince(arr)
{
    var html = "";
    for(i in arr) {
        html += '<option value="'+i+'">'+arr[i]+'</option>';
    }
    $("select[name=province_state]").html(html);
}
$('.upload-file').change(function(){
    var itemId = $(this).attr('id').replace('file-', '');
    var data = new FormData();
    data.append('file', $(this)[0].files[0]);
    data.append('itemId', itemId);
    $.ajax({
        url: '{{ URL.'/cart/upload' }}',
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function(result) {
            if( result.status == 'ok' ) {
                $('#file-'+ itemId).prev().text(result.name);
                $('#file-'+ itemId).val('');
                toastr.success(result.message, 'Message');
            } else {
                toastr.error(result.message, 'Error');
            }
        }
    });
});
</script>
@stop