<div class="container" style="margin-top:20px">
    <div class="row footer">
    	<div class="col-md-10 col-md-offset-1">
    		<div class="row footer_contain">
    			{{ $footerMenu or '' }}
                <div class="col-md-3 col-sm-12 col-xs-12" style="height:75px;">
                    <!-- <h3>Contact us</h3>
                    Tel: 403.291.2244<br />
                    Fax: 403.291.2246<br />
                    info@anvydigital.com<br /><br />
                    No. 103, 3016-10 Avenue N.E.<br />
                    Calgary, Alberta, Canada T2A 6A3<br /> -->
                    <div class="subscribe_box input_box">
                        <form class="form-inline" style="width:100%" action="javascript:void(0)">
                            <div class="form-group">
                                <input type="text" name="email_address" id="email_address" placeholder="Email address"  style="float:left"/>
                                <button type="submit" class="btn btn-default" style="float:left"> Subscribe </button>
                            </div>                            
                        </form>
                    </div>
                </div>
                @if( isset($footerSocial) && !empty($footerSocial) )
    			<div class="col-md-3 col-sm-6 col-xs-12">
    				<h3>Let's be friends!</h3>
    				{{ $footerSocial }}
    			</div>
                @endif
    		</div>
    	</div>
    	<div class="col-md-12 copyright">
    		&copy 2009 - 2016 Anvy Digital Imaging, All Rights Reserved.
    	</div>
    </div>
</div>