<div class="col-md-10 col-md-offset-1 probox ">
    <div class="tab-content">
        <div class="tab-content" style="margin-top:40px;">
            <form id="contact-forgot" method="post">
            <div class="tab-content div-left">
                <div class="row">
                    <div class="col-md-12" style="width:600px;">
                        <h4>Forgot password</h4>
                        <h5>Please provide your account email.</h5>
                        <hr>
                        <div class="form-group forgot-right" style="width:600px;">
                            <div style="position: absolute;text-align: right;vertical-align: middle; margin:0px;padding:0px; width:150px;" class="col-md-3">
                                <label class="control-label" for="Email_EmailAddress">E-mail address</label>*
                            </div>
                            <div class="col-md-8" style="float:right; width:370px;">
                                {{ Form::text('email', null, [
                                        'class' => 'form-control input-maxwidth-default',
                                        'style' => 'width: 340px;',
                                        'type'  => 'text',
                                        'autofocus' => true
                                    ]) }}
                            </div>
                        </div>
                        <div class="form-group forgot-right">
                            <div class="col-md-offset-2 col-md-10  linkbutton-spacing" style="margin-right:0px;padding-left:0px;margin-left:-46px;width:600px;">
                                <button type="submit" class="button-link" style="float:right;">Get Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <div class="div-right" style="width:456px;">
                <div style="padding:20px;">
                    <p style="font-size:18px;">Why you'll love Anvydigital</p>
                    <p>There's so much to discover.</p>
                    <div class="form-horizontal">
                        <div class="form-group" style="width:450px !important;">
                            <div class="col-md-1" style="width:37px;float: left;">
                                <img src="/assets/images/tick-box.png">
                            </div>
                            <div class="col-md-11" style="width:409px;float: left; padding-top: 2px;">
                                Unrestricted access to pricing and product details.
                            </div>
                        </div>
                        <!--div class="form-group" style="width:450px !important;">
                            <div class="col-md-1" style="width:37px;float: left;">
                                <img src="/assets/images/tick-box.png">
                            </div>
                            <div class="col-md-11" style="width:409px;float: left; padding-top: 2px;">
                                Manage your account, payment information and track orders.
                            </div>
                        </div-->
                        <div class="form-group" style="width:450px !important">
                            <div class="col-md-1" style="width:37px;float: left;">
                                <img src="/assets/images/tick-box.png">
                            </div>
                            <div class="col-md-11" style="width:409px;float: left; padding-top: 2px;">
                                Be the first to hear about the latest offers.
                            </div>
                        </div>
                        <div class="form-group" style="width:450px !important;">
                            <div class="col-md-1" style="width:37px;float: left;">
                                <img src="/assets/images/tick-box.png">
                            </div>
                            <div class="col-md-11" style="width:409px;float: left; padding-top: 2px;">
                                Spam-free. We only send you email if you want.
                            </div>
                        </div>
                        Don't worry; your details are safe with us. We won't ever share your information with third parties.We may e-mail you from time to time to keep you posted on information and offers, but only if you want us to.
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@section('pageJS')
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/jquery-validation/js/jquery.validate.min.js' ) }}"></script>
<script type="text/javascript">
$("#contact-forgot").validate({
    errorElement: 'span',
    errorClass: 'help-block help-block-error',
    focusInvalid: true,
    rules: {
        email: {
            required: true,
            email: true
        },
    },
    highlight: function (element) {
        $(element)
            .closest('.form-group').addClass('has-error');
    },
    unhighlight: function (element) {
        $(element)
            .closest('.form-group').removeClass('has-error');
    },
    submitHandler: function (form) {
        var button = $(form).find('[type=submit]');
        var email = $(form).find('[name=email]').val();
        button.prop('disabled', true).css('background', '#000');
        $.ajax({
            type: 'POST',
            data: {
                'email': email
            },
            success: function(result) {
                alert(result.message);
                button.prop('disabled', false).css('background', '#0055AA');
            }
        });
        event.preventDefault();
    }
});
</script>
@stop