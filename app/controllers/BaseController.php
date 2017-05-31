<?php
use Jenssegers\Agent\Agent;
class BaseController extends Controller {

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected $layout = 'frontend.layout.default';
    protected $mobiledir = '';

    protected function setupLayout()
    {        
        $agent = new Agent();
        if($agent->isMobile() && !$agent->isTablet())
        {
            //Is Mobile Agent, not Tablet
            $this->mobiledir = '.mobile';
            $this->layout = 'frontend'.$this->mobiledir.'.layout.default';
        }
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
            $this->layout->metaInfo     = Home::getMetaInfo();
            $this->layout->headerMenu   = Menu::getCache(['header' => true]);
            $this->layout->productMenu  = Menu::getCache(['product' => true]);
            $this->layout->footerMenu   = Menu::getCache(['footer' => true]);
            $this->layout->footerSocial = Home::getFooterSocial();
            $this->layout->user         = Auth::user()->get();
            $this->layout->cartQuantity = Cart::count();
            View::share('google_analytic_id', Configure::get_google_analytic_id());
        }
    }
}
