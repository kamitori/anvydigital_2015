<?php

class FrontendPagesController extends BaseController {

	public function index($pageName)
	{
		if( $pageName === 'contact-us' ) {
			$breakcrumb = 'Contact Us';
			$content = View::make('frontend'.$this->mobiledir.'.pages.contact-us');
		} else if( $pageName === 'about-us' ){
			$breakcrumb = 'About Us';
			$content = View::make('frontend'.$this->mobiledir.'.pages.about-us');
		} else if( $pageName === 'site-map' ){
			$breakcrumb = 'Site Map';
			$content = View::make('frontend'.$this->mobiledir.'.pages.sitemap')->with([
                                                                'sitemap' => Home::getSitemap()
                                                            ]);
		} else {
			$page = Page::where('short_name', 'like', '%'.$pageName.'%')
							->where('type', 'Default')
							->first();
			if( !is_object($page) ) {
				return App::abort(404);
			}
			if( $page->short_name !== $pageName ) {
				return Redirect::to(URL.'/pages/'.$page->short_name);
			}
			$breakcrumb = $page->name;
			$content = View::make('frontend.pages.index')->with(['page' => $page]);
			if( $page->meta_title ) {
				$this->layout->metaInfo['title_site'] = $page->meta_title;
			}
			if( $page->meta_description ){
				$this->layout->metaInfo['meta_description'] = $page->meta_description;
			}
		}
		$this->layout->breakcrumb = [$breakcrumb];
		$this->layout->content = $content;
	}

	public function businessPages($pageName = '')
	{
		if( !empty($pageName) ) {
			$page = Page::where('short_name', 'like', '%'.$pageName.'%')
							->where('type', 'Business')
							->first();
		} else {
			$page = Page::where('type', 'Business')
							->orderBy('id', 'desc')
							->first();
			$pageName = $page->short_name;
		}
		if( !is_object($page) ) {
			return App::abort(404);
		}
		if( $page->short_name !== $pageName ) {
			return Redirect::to(URL.'/pages/business-solutions/'.$page->short_name);
		}
		if( $page->meta_title ) {
			$this->layout->metaInfo['title_site'] = $page->meta_title;
		}
		if( $page->meta_description ){
			$this->layout->metaInfo['meta_description'] = $page->meta_description;
		}
		$this->layout->breakcrumb = ['Business Solutions', $page->name];
		$this->layout->content = View::make('frontend.pages.business-solutions')->with(['page' => $page]);
	}
	public function register(){
		$this->layout->content = View::make('frontend.pages.register')->with(['page' => 'test']);
	}
}