<div class="row">
    <div class="col-md-12 alignfixall">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5015.090301114683!2d-113.98509010154422!3d51.061485941854784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x9c66042789ce65f4!2sAnvy+Digital+Imaging!5e0!3m2!1sen!2sca!4v1414011757410" frameborder="0" style="border:0; width: 100%; height: 400px;"></iframe>
    </div>
</div>
<form id="contact-form" action="javascript:void(0)">
    <div style="padding-left: 80px; margin-top: 20px; color:red">
    </div>
    <div style="float: right; margin-top: 20px; margin-bottom: 20px; width: 400px; font-size: 14px;  margin-right: 4%;" id="right-div" class="right-margin">
        <div id="right-div-pane">
            <div style="padding-left: 20px;">
                <div class="row" style="padding-top: 80px;">
                    <label class="control-label" for="message">Subject</label>
                </div>
                <div class="row">
                    <select class="form-control" name="subject" tabindex="4">
                        @foreach (['General question','Quote request','Order status','Technical problem','File setup questions','Product questions','Shipping questions','Mailing inquiries','Feedback review','Account billing','Business development','Other'] as $subject)
                        <option value="{{ $subject }}">{{ $subject }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br />
            <div style="padding-left: 20px;">
                <div class="row">
                    <label class="control-label" for="message">Message*</label>
                </div>
                <div class="row">
                    <textarea class="form-control" cols="10" id="message" name="message" rows="2" tabindex="5" style="min-width:395px; height:135px; border-color: #666; resize: none;"></textarea>
                </div>
                <br />
                @if ( 1 == 2 )
                <div class="g-recaptcha" data-sitekey="6LeMhQ4TAAAAAHyZrVzMrQfu08eNdf1nBbIXzdRI"></div>
                @endif
                <div class="row">
                    <label class="control-label" for="captcha">Answer this question*</label>
                </div>
                <div class="row col-md-8" style="padding-left: 0 !important;">
                    <div class="col-md-6" style="padding-left: 0 !important;">
                        <img id="image-captcha" src="{{ URL }}/image-captcha" />
                    </div>
                    <div class="col-md-4" style="padding-right: 0 !important;">
                        <input class="form-control contactUs-textField" id="captcha" name="captcha" type="text" style="text-align: right; font-weight: bold; color: #fff; background-color: #000;" tabindex="6" value="" />
                    </div>
                </div>
                <br />
                <div class="row">
                    <input class="inputButton" type="submit" tabindex="7" value="Submit" style="margin-left:265px" id="continueButton" />
                </div>
            </div>
        </div>
    </div>
    <div style="float: left; margin-top: 20px; margin-bottom: 20px; background-color: #EEEEEE;" id="left-div" class="left-margin">
        <div id="left-div-pane" style="height:563px !important; padding: 30px!important; margin-top:0px !important; margin-bottom:0px !important;">
            <div style="font-size: 14px">
                <p style="font-weight: bold; margin-bottom: 5px;">Anvydigital</p>
                <p style="margin-bottom: 5px;">No. 103, 3016-10 Avenue N.E.</p>
                <p style="margin-bottom: 5px;">Calgary, Alberta,</p>
                <p style="margin-bottom: 5px;">Canada T2A 6A3</p>
                <br />
                <br />
                <p style="font-weight: bold; margin-bottom: 5px;">Enquiries</p>
                <p style="margin-bottom: 5px;">Phone: 403.291.2244</p>
                <p style="margin-bottom: 5px;">Fax: 403.291.2246</p>
                <p style="margin-bottom: 5px;">E-mail: <a class="hyperlink" href="mailto:info@anvydigital.com">info@anvydigital.com</a></p>
                <br />
                <p style="margin-bottom: 5px;">Telephone and showroom open</p>
                <p style="margin-bottom: 5px;">Monday-Friday 8:00am - 5:00pm</p>
            </div>
        </div>
    </div>

    <div style="float: left; margin-top: 10px; margin-bottom: 20px; width: 440px;" id="right-div">
        <div id="right-div-pane">
            <div style="padding-left: 30px;">
                <h1>Contact us</h1>
                <br />
                <div class="row" style="padding-left: 20px; font-size: 14px">
                    <label class="control-label" for="name">Name*</label>
                </div>
                <div class="row" style="padding-left: 20px; font-size: 14px">
                    <div class="col-md-6" style="padding-left: 0 !important;">
                        <input class="form-control contactUs-textField" id="first_name" name="first_name" type="text" placeholder="First Name" tabindex="1" autofocus value="" />
                    </div>
                    <div class="col-md-6" style="padding-right: 0 !important;">
                        <input class="form-control contactUs-textField" id="last_name" name="last_name" type="text" tabindex="1" placeholder="Last Name" value="" />
                    </div>
                </div>
                <br />
                <div class="row" style="padding-left: 20px; font-size: 14px">
                    <label class="control-label" for="company">Company</label>
                </div>
                <div class="row" style="padding-left: 20px; font-size: 14px">
                    <input class="form-control contactUs-textField" id="company" name="company" type="text" tabindex="1"value="" />
                </div>
                <br />
                <div class="row" style="padding-left: 20px; font-size: 14px">
                    <label class="control-label" for="phone">Phone*</label>
                </div>
                <div class="row" style="padding-left: 20px; font-size: 14px">
                    <input class="form-control contactUs-textField" tabindex="2" id="phone" name="phone" type="text" value="" />
                </div>
                <br />
                <div class="row" style="padding-left: 20px; font-size: 14px">
                    <label class="control-label" for="email">E-mail address*</label>
                </div>
                <div class="row" style="padding-left: 20px; font-size: 14px">
                    <input class="form-control contactUs-textField" tabindex="3" id="email" name="email" type="text" value="" />
                </div>
                <br />
            </div>
        </div>
    </div>
</div>
</form>
@section('pageCSS')
<style type="text/css" media="screen">
.help-block-error {
    color: red;
    font-style: italic;
    font-size: 12px;
}
#captcha-error {
    width: 250px;
}
</style>
@stop
@section('pageJS')
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/jquery-validation/js/jquery.validate.min.js' ) }}"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script type="text/javascript">
$("#contact-form").validate({
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
        first_name: {
            required: true,
        },
        last_name: {
            required: true,
        },
        email: {
            required: true,
            email: true
        },
        phone: {
            required: true,
            maxlength: 10
        },
        message: {
            required: true,
            minlength: 20
        },
        captcha: {
            required: true,
            number: true,
        },
    },
    invalidHandler: function (event, validator) {
        $(".alert-danger","#offer-form").show();
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
        $(".alert-danger","#contact-form").hide();
        $('input[type=submit]', '#contact-form').prop('disabled', true);
        $.ajax({
            url: '{{ URL.'/submit-feedback' }}',
            type: 'POST',
            data: $('input,textarea,select', '#contact-form').serialize(),
            success: function(result){
                // grecaptcha.reset();
                $('img#image-captcha').attr('src', '{{ URL }}/image-captcha?t='+ new Date().getTime());
                if( result.status == 'ok' ) {
                    $('input[type!=submit], textarea', '#contact-form').val('');
                    toastr.success(result.message, 'Message');
                } else {
                    toastr.error(result.message, 'Error');
                }
                $('input[type=submit]', '#contact-form').prop('disabled', false);
            }
        });
    }
});
</script>
@stop