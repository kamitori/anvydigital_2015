@if( !is_object($user) )
<div id="login" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 95vw;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="{{ URL}}/assets/images/closebox.png" />
            </button>
            <div class="modal-header" style="padding-left: 15px;">
                <h4 class="modal-title" style="color:#333333; font-family: 'Myriad W01 Light'; font-size:28px;">Login</h4>
                <p style="color: #666666; font-size: 16px;">Provide your login credentials.</p>
            </div>
            <div class="modal-body">
                <form id="loginForm" action="javascript:void(0)">

                        <div class="validation-summary-errors"></div>
                        <div>
                            <div class="form-group">
                                <label class="col-xs-5 control-label" for="email" style="text-align:left">E-mail address</label>
                                <div class="col-xs-7">
                                    <input class="form-control" data-val="true" data-val-required="The E-mail address field is required." id="email" name="email" style="max-width: 360px;" type="email" value="">
                                    <span class="field-validation-valid" data-valmsg-for="email" data-valmsg-replace="true" style="color:#f00;"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-5 control-label" for="password" style="text-align:left">Password</label>
                                <div class="col-xs-7">
                                    <input class="form-control" data-val="true" data-val-required="The Password field is required." id="password" name="password" style="max-width: 360px;" type="password">
                                    <span class="field-validation-valid" data-valmsg-for="password" data-valmsg-replace="true" style="color:#f00;"></span>
                                </div>
                            </div>
                            <div class="checkbox" id="checkBoxDiv">                                
                                <input name="RememberMe" type="hidden" value="false">
                                <div style="margin-top:2px; text-align:left;">
                                	<label for="RememberMe" style="font-weight: bold; text-align:left; padding-left:15px;">Remember me?</label>
                                    
                                    <span><input data-val="true" data-val-required="The Remember me? field is required." id="RememberMe" name="RememberMe" type="checkbox" value="true" style="margin-left:0;"></span>
                                    <span class="anchor-color" style="margin-left: 10px;">
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

                </form>
            </div>
        </div>
    </div>
</div>
@endif
<!-- <div class="row header">
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
                        @else
                        <li role="presentation"><a href="http://ftp.anvydigital.com/login.html?lang=english" data-toggle="modal">Send Files</a></li><li class="divider-vertical"></li>
                        <li role="presentation"><a href="http://parkland.anvyonline.com/" data-toggle="modal">WorkTraq</a></li><li class="divider-vertical"></li>
                        <li role="presentation"><a href="#login" data-toggle="modal">Login</a></li><li class="divider-vertical"></li>
                        <li role="presentation"><a href="{{ URL.'/pages/join-the-family' }}">Register</a></li><li class="divider-vertical hidden"></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="row mobile-menu" style="display:block">    
    <div class="nav-side-menu">
        <i class="fa fa-bars fa-2x toggle-btn btn-menu-top" data-toggle="collapse" data-target="#menu-header" style="left:10px !important;"></i>
        <div class="brand"><a href="/">
                <img src="{{ isset($metaInfo['main_logo']) && !empty($metaInfo['main_logo']) ? URL.'/'.$metaInfo['main_logo'] : 'http://anvydigital.com/images/logo.png' }}" alt="logo" class="logo" />
                </a></div>
        <i class="fa fa-bars fa-2x toggle-btn btn-menu-top" data-toggle="collapse" data-target="#menu-content"></i>      
        <div class="menu-list">      
            <ul id="menu-content" class="menu_mobile_mode menu-content collapse out" style="right: 0; left: auto;">    
                {{ $productMenu['menumobile'] or '' }}
            </ul>            
        </div>
        <div class="menu-list"> 
            <ul id="menu-header" class="menu_mobile_mode menu-content collapse out" style="right: 0; left: auto;">
                @if( is_object($user) )
                <li><a href="http://ftp.anvydigital.com/login.html?lang=english"><i class="fa fa-angle-double-right fa-lg" style="color:#000"></i> Send Files</a></li><li class="divider-vertical"></li>
                <li><a href="http://parkland.anvyonline.com/"><i class="fa fa-angle-double-right fa-lg" style="color:#000"></i> WorkTraq</a></li><li class="divider-vertical"></li>
                <li><a href="{{ URL.'/account' }}"><i class="fa fa-angle-double-right fa-lg" style="color:#000"></i> My account</a></li><li class="divider-vertical hidden"></li>
                <li><a href="{{ URL.'/account/logout' }}"><i class="fa fa-angle-double-right fa-lg" style="color:#000"></i> Log off</a></li><li class="divider-vertical hidden"></li>
                @else
                <li><a href="http://ftp.anvydigital.com/login.html?lang=english"><i class="fa fa-angle-double-right fa-lg" style="color:#000"></i> Send Files</a></li><li class="divider-vertical"></li>
                <li><a href="http://parkland.anvyonline.com/"><i class="fa fa-angle-double-right fa-lg" style="color:#000"></i> WorkTraq</a></li><li class="divider-vertical"></li>
                <li><a href="#login"><i class="fa fa-angle-double-right fa-lg" style="color:#000"></i> Login</a></li><li class="divider-vertical"></li>
                <li><a href="{{ URL.'/pages/join-the-family' }}"><i class="fa fa-angle-double-right fa-lg" style="color:#000"></i> Register</a></li><li class="divider-vertical hidden"></li>
                @endif
                {{ $headerMenu['mobile'] or '' }}
            </ul> 
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