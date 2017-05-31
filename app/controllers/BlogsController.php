<?php
class BlogsController extends BaseController {

    public function index($blogYear = '', $blogMonth = '')
    {
        $redirectURL = '';
        if( !empty($blogYear) && !is_numeric($blogYear) ) {
            $redirectURL = URL.'/blogs';
        } else if( $blogYear < 0 && $blogYear > date('y') ) {
            $redirectURL = URL.'/blogs';
        } else if( empty($blogYear) && !empty($blogMonth)  ) {
            $redirectURL = URL.'/blogs/';
        }
        if( $redirectURL ){
            return Redirect::to($redirectURL);
        }
        $this->layout->content = View::make('frontend'.$this->mobiledir.'.blogs.index')->with([
                                                                    'blogYear'  => $blogYear,
                                                                    'blogMonth' => $blogMonth,
                                                                ]);
        //
    }
}