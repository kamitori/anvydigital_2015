<div class="col-md-10 col-md-offset-1 probox ">
    <div class="tab-content">
        <div class="tab-content" style="margin-top:40px;">
            <form id="contact-forgot" method="post">
            <div class="tab-content div-left">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Forgot password</h4>
                        <h5>Please provide your account email.</h5>
                        <hr>
                        <div class="forgot-right">
                            <div style="vertical-align: middle; padding-left:0; padding-right:0;" class="col-xs-4">
                                <label class="control-label" for="Email_EmailAddress">E-mail address</label>*
                            </div>
                            <div class="col-xs-8">
                                {{ Form::text('email', null, [
                                        'class' => 'form-control input-maxwidth-default',
                                        'style' => '',
                                        'type'  => 'text',
                                        'autofocus' => true
                                    ]) }}
                            </div>
                        </div>
                        <div class="forgot-right">
                            <div class="col-xs-10 col-xs-offset-2 linkbutton-spacing" style="">
                                <button type="submit" class="button-link" style="float:right;">Get Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
			<div class="div-right" style="margin-top: 20px;">
				<div>
					<p style="font-size:18px;">Why you'll love Anvydigital</p>
					<p>There's so much to discover.</p>
					<div class="form-horizontal">
						<div class="row" style="width:100%; margin-bottom:10px;">
							<div class="col-xs-1">
								<img src="/assets/images/tick-box.png">
							</div>
							<div class="col-xs-10">
								Unrestricted access to pricing and product details.
							</div>
						</div>
						<div class="row" style="width: 100%; margin-bottom:10px;">
							<div class="col-xs-1">
								<img src="/assets/images/tick-box.png">
							</div>
							<div class="col-xs-10">
								Manage your account, payment information and track orders.
							</div>
						</div>
						<div class="row" style="width:100%; margin-bottom:10px;">
							<div class="col-xs-1">
								<img src="/assets/images/tick-box.png">
							</div>
							<div class="col-xs-10">
								Be the first to hear about the latest offers.
							</div>
						</div>
						<div class="row" style="width: 100%; margin-bottom:10px;">
							<div class="col-xs-1">
								<img src="/assets/images/tick-box.png">
							</div>
							<div class="col-xs-10">
								Spam-free. We only send you email if you want.
							</div>
						</div>
                        <div class="row" style="width:100%; padding-left:15px;">
                        	Don't worry, your details are safe with us. We won't ever share your information with third parties. We may e-mail you from time to time to keep you posted on information and offers, but only if you want us to.
                        </div>
						
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
            .closest('.forgot-right').addClass('has-error');
    },
    unhighlight: function (element) {
        $(element)
            .closest('.forgot-right').removeClass('has-error');
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