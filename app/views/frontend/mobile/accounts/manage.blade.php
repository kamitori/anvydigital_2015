<div class="lwebPage">
    <div style="padding-bottom: 80px; padding-top: 20px; width: 100%; background-color: white; text-align:center" class="left-margin">
        <h1>My account</h1>
        <a href="{{ URL.'/account/detail' }}" class="myAccountTile-section-links" style="text-decoration:none;">
            <div class="myAccountTile">
                <img src="/assets/images/my-profile-black.png" data-attribute-hover="/Images/myAccount/my-profile-white.png" data-attribute-out="/Images/myAccount/my-profile-black.png" width="34" height="34" style="margin-top: 30px">
                <p class="myAccountTileTitle">My profile</p>
                <p class="myAccountTileDesc">Amend your details</p>
            </div>
        </a>
		<!--<a href="{{ URL.'/account/order' }}" class="myAccountTile-section-links" style="text-decoration:none;">
            <div class="myAccountTile">
                <img src="/assets/images/order-placed-black.png" data-attribute-hover="/Images/myAccount/order-placed-white.png" data-attribute-out="/Images/myAccount/order-placed-black.png" width="34" height="34" style="margin-top: 30px">
                <p class="myAccountTileTitle">My orders</p>
                <p class="myAccountTileDesc">Open and completed orders</p>
            </div>
        </a>-->
        
    </div>
</div>
@section('pageCSS')
<style type="text/css" media="screen">
.myAccountTile {
    background-color: #EEEEEE;
    width: 270px;
    height: 170px;
    margin: 8px 10px 0px 0px;
    text-align: center;
    display: inline-block;
    overflow: auto;
}
.myAccountTileTitle {
    padding-top: 10px;
    font-size: 28px;
    font-family: 'Myriad W01 Light';
    color: #333333;
}
.myAccountTileDesc {
    font-size: 16px;
    color: #666666;
}
</style>
@stop