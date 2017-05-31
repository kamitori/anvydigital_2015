@if( !is_object($user) )
<div id="login" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="{{ URL}}/assets/images/closebox.png" />
            </button>
            <div class="modal-header">
                <h4 class="modal-title" style="color:#333333; font-family: 'Myriad W01 Light'; font-size:28px;">Login</h4>
                <p style="color: #666666; font-size: 16px;">Provide your login credentials.</p>
            </div>
            <div class="modal-body">
                <form id="loginForm" action="javascript:void(0)">
                    <section style="width:100%;">
                        <div class="validation-summary-errors"></div>
                        <div style="height: 150px;">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="UserName">E-mail address</label>
                                <div class="col-md-7">
                                    <input class="form-control" data-val="true" data-val-required="The E-mail address field is required." id="email" name="email" style="max-width: 360px; width: 360px;" type="email" value="">
                                    <span class="field-validation-valid" data-valmsg-for="email" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="Password">Password</label>
                                <div class="col-md-7">
                                    <input class="form-control" data-val="true" data-val-required="The Password field is required." id="password" name="password" style="max-width: 360px; width: 360px;" type="password">
                                    <span class="field-validation-valid" data-valmsg-for="password" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="checkbox" id="checkBoxDiv">
                                <input data-val="true" data-val-required="The Remember me? field is required." id="RememberMe" name="RememberMe" type="checkbox" value="true">
                                <input name="RememberMe" type="hidden" value="false">
                                <div style="margin-top:2px;">
                                    <label for="RememberMe" style="font-weight: bold;">Remember me?</label>
                                    <span class="anchor-color">
                                        &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ URL }}/account/forgot" class="anchor-color" id="passwordLink" style="text-decoration:underline;">Forgot password?</a>
                                    </span>
                                </div>
                            </div>
                            <div id="verificationMsgDiv" style="display:none; text-align:center;">
                                <p style="font-size: 14px">An email containing the  verification link has been sent to your email address.</p>
                            </div>
                        </div>
                        <div class="modal-footer login-modal-footer" id="loginFooterDiv">
                            <div style="padding-top: 15px;">
                                <input type="submit" value="Log in" class="button-link inputButton" id="submitLogin">
                                <span>&nbsp;&nbsp;
                                    <input type="button" value="Cancel" class="button-link-nocolour inputNoColourButton" data-dismiss="modal" aria-hidden="true">
                                </span>
                                <br/>
                                
                            </div>
                            <div style="padding-top: 15px;">
                                <button type="button" value="" onclick="checkLoginState()" class="button-link inputButton" style="width:280px; margin-left:-3px;">
                                    <i class="fa fa-facebook-square"></i>&nbsp;&nbsp;Login with Facebook
                                </button>
                            </div>
                            <div style="margin-top: 15px;">
                                <text style="font-weight: bold;">Not registered?</text>
                                <text style="padding-left: 5px;"><a href="{{ URL }}/account/register" class="anchor-color" style="text-decoration: underline; color: #0055aa;">Click here to join AnvyDigital</a></text>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal_register" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="{{ URL}}/assets/images/closebox.png" />
            </button>
            <div class="modal-header">
                <h4 class="modal-title" style="color:#333333; font-family: 'Myriad W01 Light'; font-size:28px;">Register</h4>
                <p style="color: #666666; font-size: 16px;">Please provide your contact details.</p>
            </div>
            <div class="modal-body" style="padding: 15px 20px;">
                <form id="contact-register-modal" method="post" novalidate="novalidate" action="/account/register">
                    <input type="hidden" name="fb_id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group register-right">
                                <div style="position: absolute;text-align: right;vertical-align: middle; margin:0px;padding:0px; width:150px;" class="col-md-3">
                                    <label class="control-label" for="Email_EmailAddress">E-mail address</label>*
                                </div>
                                <div class="col-md-8" style="float:right; width:370px;">
                                    <input class="form-control input-maxwidth-default" style="width: 340px;" type="text" autofocus="1" name="email">
                                </div>
                            </div>
                            <div class="form-group register-right">
                                <div style="position: absolute;text-align: right;vertical-align: middle; margin:0px;padding:0px;width:150px;" class="col-md-3">
                                    <label class="control-label" for="Contact_FirstName">First Name</label>
                                </div>
                                <div class="col-md-8" style="float:right;width:370px;">
                                    <input class="form-control input-maxwidth-default" style="width: 340px;" type="text" name="first_name">
                                </div>
                            </div>
                            <div class="form-group register-right">
                                <div style="position: absolute;text-align: right;vertical-align: middle; margin:0px;padding:0px;width:150px;" class="col-md-3">
                                    <label class="control-label" for="Contact_Surname">Last Name</label>
                                </div>
                                <div class="col-md-8" style="float:right;width:370px;">
                                    <input class="form-control input-maxwidth-default" style="width: 340px;" type="text" name="last_name">
                                </div>
                            </div>
                            <div class="form-group register-right">
                                <div style="position: absolute;text-align: right;vertical-align: middle; margin:0px;padding:0px;width:150px;" class="col-md-3">
                                    <label class="control-label" for="Contact_Company">Company Name</label>
                                </div>
                                <div class="col-md-8" style="float:right;width:370px;">
                                    <input class="form-control input-maxwidth-default" style="width: 340px;" type="text" name="company_name">
                                </div>
                            </div>
                            <div class="form-group register-right">
                                <div style="position: absolute;text-align: right;vertical-align: middle; margin:0px;padding:0px;width:150px;" class="col-md-3">
                                    <label class="control-label" for="Contact_Mobile">Phone</label>
                                </div>
                                <div class="col-md-8" style="float:right;width:370px;">
                                    <input class="form-control input-maxwidth-default" style="width: 340px;" type="text" name="phone">
                                </div>
                            </div>
                            <div class="form-group register-right">
                                <div style="position: absolute;text-align: right;vertical-align: middle; margin:0px;padding:0px;width:150px;" class="col-md-3">
                                    <label class="control-label" for="Contact_Password">Password</label>*
                                </div>
                                <div class="col-md-8" style="float:right;width:370px;">
                                    <input class="form-control input-maxwidth-default" id="password_input_modal" name="password" type="password">
                                </div>
                            </div>
                            <div class="form-group register-right">
                                <div style="position: absolute;text-align: right;vertical-align: middle; margin:0px;padding:0px;width:150px;" class="col-md-3">
                                    <label class="control-label" for="Contact_ConfirmPassword">Confirm password</label>*
                                </div>
                                <div class="col-md-8" style="float:right;width:370px;">
                                    <input class="form-control input-maxwidth-default" name="password_confirmation" type="password">
                                </div>
                            </div>
                                                    <div class="form-group register-right">
                                <div style="position: absolute;text-align: right;vertical-align: middle; margin:0px;padding:0px;width:150px;" class="col-md-3">
                                    <label class="control-label" for="Contact_Capcha">Answer this question</label>*
                                </div>
                                <div class="col-md-8" style="float:right;width:370px;">
                                    <div class="col-md-6" style="padding-left: 0 !important;">
                                        <img id="image-captcha" src="{{ URL }}/image-captcha" />
                                    </div>
                                    <div class="col-md-4" style="padding-right: 0 !important;">
                                        <input class="form-control contactUs-textField" id="captcha" name="captcha" type="text" style="text-align: right; font-weight: bold; color: #fff; background-color: #000;" tabindex="6" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group register-right">
                                <div style="text-align: right;vertical-align: middle; margin:0px;padding:0px;" class="col-md-12">
                                    <label class="control-label" for="subscribe">
                                        <input class="" name="subscribe" id="subscribe" type="checkbox">
                                        I want to receive news and updates about products and sales
                                    </label>
                                </div>
                            </div>
                            <div class="form-group register-right">                    
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
                </form>
            </div>
        </div>
    </div>
</div>
@endif
<div class="row header">
    <div class="col-md-2 col-md-offset-1 alignfix">
        <a href="/">
            <img src="{{ isset($metaInfo['main_logo']) && !empty($metaInfo['main_logo']) ? URL.'/'.$metaInfo['main_logo'] : 'http://anvydigital.com/images/logo.png' }}" alt="logo" class="logo" />
        </a>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12 text-right">
                <div class="row">
                    <ul class="nav nav-tabs menu-top">
                        @if( is_object($user) )
                        <li role="presentation"><a href="http://ftp.anvydigital.com/login.html?lang=english" data-toggle="modal">Send Files</a></li><li class="divider-vertical"></li>
                        <li role="presentation"><a href="http://parkland.anvyonline.com/" data-toggle="modal">WorkTraq</a></li><li class="divider-vertical"></li>
                        <li role="presentation"><a href="{{ URL.'/account' }}">My account</a></li><li class="divider-vertical hidden"></li>
                        <li role="presentation"><a href="{{ URL.'/account/logout' }}">Log off</a></li><li class="divider-vertical hidden"></li>
                        <!--li role="presentation"><a href="{{ URL.'/cart' }}">Basket (<span id="cart-quantity">{{ $cartQuantity or 0 }}</span>)</a></li-->
                        @else
                        <li role="presentation"><a href="http://ftp.anvydigital.com/login.html?lang=english" data-toggle="modal">Send Files</a></li><li class="divider-vertical"></li>
                        <li role="presentation"><a href="http://parkland.anvyonline.com/" data-toggle="modal">WorkTraq</a></li><li class="divider-vertical"></li>
                        <li role="presentation"><a href="#login" data-toggle="modal">Login</a></li><li class="divider-vertical"></li>
                        <li role="presentation"><a href="{{ URL.'/pages/join-the-family' }}">New Customer? Start here</a></li><li class="divider-vertical hidden"></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-12">
                {{ $headerMenu['default'] or '' }}
            </div>
        </div>
    </div>
</div>

<div class="row mobile-menu">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation 1</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a href="/">
                <img src="{{ isset($metaInfo['main_logo']) && !empty($metaInfo['main_logo']) ? URL.'/'.$metaInfo['main_logo'] : 'http://anvydigital.com/images/logo.png' }}" alt="logo" class="logo" />
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                {{ $productMenu['mobile'] or '' }}
                {{ $headerMenu['default'] or '' }}
            </div>
        </div>
    </nav>
</div>

<div class="row menu">
    <div class="col-md-12 alignfix">
    	<div class="navbar navbar-inverse navbar-inverse-decoration navbar-left no-print" id="navbar">
    		{{ $productMenu['default'] or '' }}
            <div class="search_box input_box">
                <form action="{{ URL.'/product-search' }}" class="form-inline search-form">
                    <div class="form-group">
                        <input name="s" class="form-control" id="s" placeholder="Search product" style="width: 149px;" value="{{ $search or '' }}" />
                    </div>
                    <button type="button" id="search-submit" class="btn btn-default"> Search </button>
                </form>
            </div>
    	</div>
    </div>
</div>
@if( isset($breakcrumb) )
<div class="row breadcrumb">
    <div class="col-md-10 col-md-offset-1 alignfix">
        <span class="breadcumb-links"><a href="{{ URL }}">Home</a></span>
        @foreach($breakcrumb as $link => $text)
        <span class="caret-right" style="margin-bottom: 2px"></span>
        <span class="breadcumb-links"><a href="{{ is_string($link) ? $link : '#" style="text-decoration: none;'  }}">{{ $text }}</a></span>
        @endforeach
    </div>
</div>
@endif