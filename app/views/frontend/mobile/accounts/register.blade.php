<div class="col-md-10 col-md-offset-1 probox ">
	<div class="tab-content">
		<div class="tab-content" style="margin-top:40px;">
			<form id="contact-register" method="post">
			<div class="tab-content div-left">
				<div class="row">
					<div class="col-xs-12" style="font-size:0.9em">
						<h4>Contact details</h4>
						<h5>Please provide your contact details.</h5>
						<hr>
						<div class="row form-register" style="width:100%">
							<div style="vertical-align: middle; padding-right:0" class="col-xs-5">
								<label class="control-label" for="Email_EmailAddress">E-mail address</label>*
							</div>
							<div class="col-xs-7">
								{{ Form::text('email', null, [
										'class' => 'form-control input-maxwidth-default',
										'style' => '',
										'type'	=> 'text',
										'autofocus' => true
									]) }}
							</div>
						</div>
						<div class="row form-register" style="width:100%">
							<div style="vertical-align: middle; padding-right:0" class="col-xs-5">
								<label class="control-label" for="Contact_FirstName">First Name</label>
							</div>
							<div class="col-xs-7">
								{{ Form::text('first_name', null, [
										'class' => 'form-control input-maxwidth-default',
										'style' => '',
										'type'	=> 'text',
									]) }}
							</div>
						</div>
						<div class="row form-register" style="width:100%">
							<div style="vertical-align: middle; padding-right:0" class="col-xs-5">
								<label class="control-label" for="Contact_Surname">Lastname</label>
							</div>
							<div class="col-xs-7">
								{{ Form::text('last_name', null, [
										'class' => 'form-control input-maxwidth-default',
										'style' => '',
										'type'	=> 'text',
									]) }}
							</div>
						</div>
						<div class="row form-register" style="width:100%">
							<div style="vertical-align: middle; padding-right:0" class="col-xs-5">
								<label class="control-label" for="Contact_Company">Company Name</label>
							</div>
							<div class="col-xs-7">
								{{ Form::text('company_name', null, [
										'class' => 'form-control input-maxwidth-default',
										'style' => '',
										'type'	=> 'text',
									]) }}
							</div>
						</div>
						<div class="row form-register" style="width:100%">
							<div style="vertical-align: middle; padding-right:0" class="col-xs-5">
								<label class="control-label" for="Contact_Mobile">Phone</label>
							</div>
							<div class="col-xs-7">
								{{ Form::text('phone', null, [
										'class' => 'form-control input-maxwidth-default',
										'style' => '',
										'type'	=> 'text',
									]) }}
							</div>
						</div>
						<div class="row form-register" style="width:100%">
							<div style="vertical-align: middle; padding-right:0" class="col-xs-5">
								<label class="control-label" for="Contact_Password">Password</label>*
							</div>
							<div class="col-xs-7">
								<input class="form-control input-maxwidth-default" id="password_input" name="password" type="password">
							</div>
						</div>
						<div class="row form-register" style="width:100%">
							<div style="vertical-align: middle; padding-right:0" class="col-xs-5">
								<label class="control-label" for="Contact_ConfirmPassword">Confirm password</label>*
							</div>
							<div class="col-xs-7">
								<input class="form-control input-maxwidth-default" name="password_confirmation" type="password">
							</div>
						</div>
						<div class="row form-register" style="width:100%">
							<div style="vertical-align: middle;" class="col-xs-12">
								<label class="control-label" for="subscribe" style="text-align:left">
									<input class="" name="subscribe" id="subscribe" type="checkbox">
									I want to receive news and updates about products and sales
								</label>
							</div>
						</div>
						<div class="row form-register" style="width:100%">
							<div class="row col-xs-12 linkbutton-spacing">
								<button type="submit" class="button-link" style="float:right;">Continue</button>
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
$("#contact-register").validate({
    errorElement: 'span',
    errorClass: 'help-block help-block-error',
    focusInvalid: true,
    rules: {
        email: {
            required: true,
            email: true
        },
        first_name: {
            required: true,
        },
        last_name: {
            required: true,
        },
        password: {
            required: true,
            minlength: 6
        },
        password_confirmation: {
        	required : true,
            equalTo: '#password_input'
        },
    },
    highlight: function (element) {
        $(element)
            .closest('.form-register').addClass('has-error');
    },
    unhighlight: function (element) {
        $(element)
            .closest('.form-register').removeClass('has-error');
    },
    submitHandler: function (form) {
        $(".alert-danger","#contact-register").hide();
        $("#contact-register")[0].submit();
    }
});
</script>
@stop