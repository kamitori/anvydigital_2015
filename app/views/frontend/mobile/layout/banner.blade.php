<div class="banner-header-holder">
    <div class="banner-header-container">
        <div class="banner-container">
            <div class="banner-slide-indicator" style="display: block;">
                <ul>
                    {{ $banner['indicator'] or '' }}
                </ul>
            </div>
            <div class="side_btns_holder no-js-hidden">
                <div class="banner-control-bar-prev" data-banner-indicator="" style="display: none;">
                    <a>Previous</a>
                </div>
                <div class="banner-control-bar-next" data-banner-indicator="" style="display: none;">
                    <a>Next</a>
                </div>
            </div>
            <div style="overflow: hidden; max-height: 400px;background-repeat:no-repeat; background-size: 100% 100%;" id="banner_div" data-attr-target="_self" data-attr-url="/presentation-desktop/framed-desk-print/frameddeskprint">
                <div class="bannerImages">
                    {{ $banner['bannerImage'] or '' }}
                </div>
            </div>
        </div>
    </div>
</div>