<div class="lwebPage">
    <div style="padding-bottom: 20px; font-size: 14px; background-color: white;" class="left-margin right-margin fixed-div-size">
        <div style="padding-top:20px;padding-bottom: 20px">
            <h1>My profile</h1>
            <h2>Update your personal information.</h2>
        </div>
        {{ Form::open(['method' => 'post', 'id' => 'contact-detail']) }}
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-xs-12" style="padding:0">
                        <div class="form-group">
                            <div class="col-xs-5" style="padding:0">
                                <label class="control-label" for="EmailAddress">E-mail address</label>
                            </div>
                            <div class="col-xs-7" style="padding:0">
                                <input class="form-control" name="email" value="{{ $user['email'] }}" >
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12" style="padding-left:10%">
                        <div class="checkbox">
                            <input type="checkbox" name="subscribe" @if($user['subscribe']) checked @endif>
                            <label>
                                I wish to subscribe to Anvy Digital's newsletter.
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-xs-12" style="padding:0">
                        <div class="form-group">
                            <div class="col-xs-5" style="padding:0">
                                <label class="control-label">New password</label>
                            </div>
                            <div class="col-xs-7" style="padding:0">
                                <input class="form-control" name="password" id="password" type="password" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5" style="padding:0">
                                <label class="control-label">Confirm password</label>
                            </div>
                            <div class="col-xs-7" style="padding:0">
                                <input class="form-control" name="password_confirm" type="password" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div>
                        <div class="col-xs-12" style="padding:0">
                            <div class="form-group">
                                <div class="col-xs-5" style="padding:0">
                                    <label class="control-label">First Name</label>
                                </div>
                                <div class="col-xs-7" style="padding:0">
                                    <input class="form-control" name="first_name" value="{{ $user['first_name'] }}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-5" style="padding:0">
                                    <label class="control-label" for="Contact_Surname">Last Name</label>
                                </div>
                                <div class="col-xs-7" style="padding:0">
                                    <input class="form-control" name="last_name" value="{{ $user['last_name'] }}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-5" style="padding:0">
                                    <label class="control-label">Company Name</label>
                                </div>
                                <div class="col-xs-7" style="padding:0" >
                                    <input class="form-control" name="company_name" value="{{ $user['company_name'] }}" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="fixed-div-size">
            <div class="col-md-12">
                <div>
                    <div class="linkbutton-spacing">
                        <input class="inputButton pull-right" type="submit" value="Update">
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
@section('pageCSS')
<style type="text/css" media="screen">
h1, .h1 {
    font-size: 28px;
    font-family: 'Myriad W01 Light';
    color: #333333;
}
h2, .h2 {
    font-size: 16px;
    color: #666666;
}
</style>
@stop
@section('pageJS')
<script type="text/javascript" src="{{ URL::asset( 'assets/global/plugins/jquery-validation/js/jquery.validate.min.js' ) }}"></script>
<script type="text/javascript">
$("#contact-detail").validate({
    errorElement: 'span',
    errorClass: 'help-block help-block-error',
    focusInvalid: true,
    rules: {
        email: {
            required: true,
            email: true
        },
        password: {
            minlength: 6
        },
        password_confirm: {
            minlength: 6,
            equalTo: '#password'
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
        $(".alert-danger","#contact-detail").hide();
        this.submit();
    }
});
</script>
@stop