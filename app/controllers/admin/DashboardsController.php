<?php

class DashboardsController extends AdminController {

    public function index()
    {
        $min_date = '01/01/2015';
    	$max_date = date('m/d/Y');

        $data = ['admin_id' => Auth::admin()->get()->id];

        $arrData = [];
        if( URL == 'http://vi-demo.anvyonline.com' ) {
            $arrData['sync'] = (object)DB::connection('jobtraq-demo.anvyonline.com')
                                            ->collection('tb_stuffs')
                                            ->select('sync_time', 'date_modified')
                                            ->where('name', 'last_sync_date')
                                            ->first();
        } else {
            $arrData['sync'] = JTStuff::select('sync_time', 'date_modified')
                                        ->where('name', 'last_sync_date')
                                        ->first();
        }
        $arrData['notifications'] = [
                                    'users'         => Notification::getNew( 'User', $data ),
                                    'products'      => Notification::getNew( 'Product', $data ),
                                    'orders'        => Notification::getNew( 'Order', $data ),
                                ];
        $arrData['filters'] = [
                                'categories'        => ProductCategory::getSource(),
                                'order_status'      => ['New', 'Submitted', 'In production', 'Partly shipped', 'Completed', 'Cancelled'],
                            ];
        $arrData['date'] = [
                            'min_date'      => $min_date,
                            'max_date'      => $max_date,
                            'current_date'  => new DateTime(),
                            'start_date'    => new DateTime('7 days ago')
                        ];

        $this->layout->title = 'Dashboard';
        $this->layout->content = View::make('admin.dashboard')->with( $arrData );
    }

    public function getOrderStatistic()
    {
    	if( !Request::ajax() ) {
    		return App::abort(404);
    	}
    	$fromDate  = Input::has('date_start') ? Input::get('date_start') : date('m/d/Y');
    	$toDate    = Input::has('date_end') ? Input::get('date_end') : date('m/d/Y');
    	$status    = Input::has('order_status') ? Input::get('order_status') : '';
    	$category  = Input::has('product_category') ? Input::get('product_category') : '';
    	$groupBy   = Input::has('range_filter') ? Input::get('range_filter') : 'day';

    	return Dashboard::getOrders([
    							'fromDate' 	=> $fromDate,
    							'toDate' 	=> $toDate,
    							'status' 	=> $status,
    							'category' 	=> $category,
    							'groupBy' 	=> $groupBy,
    						]);

    }

    public function getVisitStatistic(){
         if( !Request::ajax() ) {
             return App::abort(404);
         }
        $fromDate   = Input::has('date_start') ? Input::get('date_start') : date('m/d/Y');
        $toDate     = Input::has('date_end') ? Input::get('date_end') : date('m/d/Y');
        $groupBy    = Input::has('range_filter') ? Input::get('range_filter') : 'day';
        return Dashboard::getVisitStatistic([
                                'fromDate'  => $fromDate,
                                'toDate'    => $toDate,
                                'groupBy'   => $groupBy,
                            ]);
    }
}
