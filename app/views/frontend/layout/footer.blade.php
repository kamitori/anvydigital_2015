<div class="container">
    <div class="row footer">
    	<div class="col-md-10 col-md-offset-1">
    		<div class="row footer_contain">
    			<div class="col-md-3 col-sm-6 col-xs-12">
    				<h3>Contact us</h3>
    				Tel: 403.291.2244<br />
					Fax: 403.291.2246<br />
					info@anvydigital.com<br /><br />
					No. 103, 3016-10 Avenue N.E.<br />
					Calgary, Alberta, Canada T2A 6A3<br />
                    <div class="subscribe_box input_box" style="height:100%;text-align:center;width:200px;">
                        <form  style="width:100%" action="javascript:void(0)">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your name" style="float:none;width:100%;" />
                            <input type="text" name="email_address" class="form-control" id="email_address" placeholder="Email address" style="float:none;width:100%;" />
                            <button type="submit" class="btn btn-default btn-block" style="float:none; margin:auto;"> Subscribe </button>
                        </form>
                    </div>
    			</div>
    			{{ $footerMenu or '' }}
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
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', '{{$google_analytic_id}}', 'auto');
  ga('send', 'pageview');

</script>