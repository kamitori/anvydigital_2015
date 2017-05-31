<div class="col-md-10 col-md-offset-1 probox ">
	<div class="tab-content">
		<div class="tab-content" style="margin-top:40px;">
			<form id="contact-register" method="post">
			<div class="tab-content div-left">
				<div class="row">
					<div class="col-md-12" style="width:600px;">
						<h4>Contact details</h4>
						<h5>Please provide your contact details.</h5>
						<hr>
						<div class="form-group register-right" style="width:600px;">
							<div style="position: absolute;text-align: right;vertical-align: middle; margin:0px;padding:0px; width:150px;" class="col-md-3">
								<label class="control-label" for="Email_EmailAddress">E-mail address</label>*
							</div>
							<div class="col-md-8" style="float:right; width:370px;">
								{{ Form::text('email', null, [
										'class' => 'form-control input-maxwidth-default',
										'style' => 'width: 340px;',
										'type'	=> 'text',
										'autofocus' => true
									]) }}
							</div>
						</div>
						<div class="form-group register-right" style="width:600px;">
							<div style="position: absolute;text-align: right;vertical-align: middle; margin:0px;padding:0px;width:150px;" class="col-md-3">
								<label class="control-label" for="Contact_FirstName">First Name</label>
							</div>
							<div class="col-md-8" style="float:right;width:370px;">
								{{ Form::text('first_name', null, [
										'class' => 'form-control input-maxwidth-default',
										'style' => 'width: 340px;',
										'type'	=> 'text',
									]) }}
							</div>
						</div>
						<div class="form-group register-right" style="width:600px;">
							<div style="position: absolute;text-align: right;vertical-align: middle; margin:0px;padding:0px;width:150px;" class="col-md-3">
								<label class="control-label" for="Contact_Surname">Last Name</label>
							</div>
							<div class="col-md-8" style="float:right;width:370px;">
								{{ Form::text('last_name', null, [
										'class' => 'form-control input-maxwidth-default',
										'style' => 'width: 340px;',
										'type'	=> 'text',
									]) }}
							</div>
						</div>
						<div class="form-group register-right" style="width:600px;">
							<div style="position: absolute;text-align: right;vertical-align: middle; margin:0px;padding:0px;width:150px;" class="col-md-3">
								<label class="control-label" for="Contact_Company">Company Name</label>
							</div>
							<div class="col-md-8" style="float:right;width:370px;">
								{{ Form::text('company_name', null, [
										'class' => 'form-control input-maxwidth-default',
										'style' => 'width: 340px;',
										'type'	=> 'text',
									]) }}
							</div>
						</div>
						<div class="form-group register-right" style="width:600px;">
							<div style="position: absolute;text-align: right;vertical-align: middle; margin:0px;padding:0px;width:150px;" class="col-md-3">
								<label class="control-label" for="Contact_Mobile">Phone</label>
							</div>
							<div class="col-md-8" style="float:right;width:370px;">
								{{ Form::text('phone', null, [
										'class' => 'form-control input-maxwidth-default',
										'style' => 'width: 340px;',
										'type'	=> 'text',
									]) }}
							</div>
						</div>
						<div class="form-group register-right" style="width:600px;">
							<div style="position: absolute;text-align: right;vertical-align: middle; margin:0px;padding:0px;width:150px;" class="col-md-3">
								<label class="control-label" for="Contact_Password">Password</label>*
							</div>
							<div class="col-md-8" style="float:right;width:370px;">
								<input class="form-control input-maxwidth-default" id="password_input" name="password" type="password">
							</div>
						</div>
						<div class="form-group register-right" style="width:600px;">
							<div style="position: absolute;text-align: right;vertical-align: middle; margin:0px;padding:0px;width:150px;" class="col-md-3">
								<label class="control-label" for="Contact_ConfirmPassword">Confirm password</label>*
							</div>
							<div class="col-md-8" style="float:right;width:370px;">
								<input class="form-control input-maxwidth-default" name="password_confirmation" type="password">
							</div>
						</div>
						@if ( 1 == 2 )
						<div class="g-recaptcha" data-sitekey="6LeMhQ4TAAAAAHyZrVzMrQfu08eNdf1nBbIXzdRI"></div>
						@endif
						<div class="form-group register-right" style="width:600px;">
							<div style="position: absolute;text-align: right;vertical-align: middle; margin:0px;padding:0px;width:150px;" class="col-md-3">
								<label class="control-label" for="Contact_Capcha">Answer this question</label>*
							</div>
							<div class="col-md-8" style="float:right;width:370px;">
								<div class="col-md-6" style="padding-left: 0 !important;">
			                        <img id="image-captcha" src="{{ URL }}/image-captcha" />
			                    </div>
			                    <div class="col-md-4" style="padding-right: 0 !important;">
			                        <input class="form-control contactUs-textField" id="captcha" name="captcha" type="text" style="text-align: right; font-weight: bold; color: #fff; background-color: #000;" tabindex="6" value="" />
			                    </div>
							</div>
						</div>

						<div class="form-group register-right" style="width:600px;">
							<div style="text-align: right;vertical-align: middle; margin:0px;padding:0px;" class="col-md-12">
								<label class="control-label" for="subscribe">
									<input class="" name="subscribe" id="subscribe" type="checkbox">
									I want to receive news and updates about products and sales
								</label>
							</div>
						</div>
						<div class="form-group register-right" style="width:600px;">					
							<div class="col-md-4">&nbsp;</div>
							<div class="col-md-8" style="float:right;width:370px;">
								* Before your new user registration is activated, you will be contacted by one of our Sales Representatives.
							</div>
						</div>
						<div class="form-group register-right">							
							<div class="col-md-offset-2 col-md-10  linkbutton-spacing" style="margin-right:0px;padding-left:0px;margin-left:-46px;width:600px;">
								<button type="submit" class="button-link" style="float:right;">Continue</button>
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
        captcha: {
            required: true,
            number: true,
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
        $(".alert-danger","#contact-register").hide();
        this.submit();
    }
});
</script>
@stop