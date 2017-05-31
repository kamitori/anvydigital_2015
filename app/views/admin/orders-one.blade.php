<div class="row">
	<div class="col-md-12">
		<!-- Begin: life time stats -->
		<div class="portlet">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-shopping-cart"></i>Order #{{$order['id']}} <span class="hidden-480">
					| {{$order['created_at']}} </span>
				</div>
				<div class="actions">
					<a href="javascript:;" class="btn default yellow-stripe">
					<i class="fa fa-angle-left"></i>
					<span class="hidden-480">
					Back </span>
					</a>
					<div class="btn-group">
						<a class="btn default yellow-stripe dropdown-toggle" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-cog"></i>
						<span class="hidden-480">
						Tools </span>
						<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="javascript:;">
								Export to Excel </a>
							</li>
							<li>
								<a href="javascript:;">
								Export to CSV </a>
							</li>
							<li>
								<a href="javascript:;">
								Export to XML </a>
							</li>
							<li class="divider">
							</li>
							<li>
								<a href="javascript:;">
								Print Invoice </a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="portlet-body">
				<div class="tabbable">
					<ul class="nav nav-tabs nav-tabs-lg">
						<li class="active">
							<a href="#info" data-toggle="tab">
							Info </a>
						</li>
						<li>
							<a href="#details" data-toggle="tab">
							Details <span class="badge badge-success">
							{{ count($order['order_details']) }} </span>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="info">
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="portlet yellow-crusta box">
										<div class="portlet-title">
											<div class="caption">
												<i class="fa fa-cogs"></i>Order Info
											</div>
											<div class="actions">
												<a href="javascript:;" class="btn btn-default btn-sm">
												<i class="fa fa-pencil"></i> Edit </a>
											</div>
										</div>
										<div class="portlet-body">
											<div class="row static-info">
												<div class="col-md-5 name">
													Order #:
												</div>
												<div class="col-md-7 value">
													{{$order['id']}} <span class="label label-info label-sm">
													Email confirmation was sent </span>
												</div>
											</div>
											<div class="row static-info">
												<div class="col-md-5 name">
													Order Date &amp; Time:
												</div>
												<div class="col-md-7 value">
													{{$order['created_at'] }}
												</div>
											</div>
											<div class="row static-info">
												<div class="col-md-5 name">
													Order Status:
												</div>
												<div class="col-md-7 value">
													<span class="label label-success">
													{{$order['status']}} </span>
												</div>
											</div>
											<div class="row static-info">
												<div class="col-md-5 name">
													Grand Total:
												</div>
												<div class="col-md-7 value">
													{{number_format($order['sum_amount'],2)}}
												</div>
											</div>
											{{-- <div class="row static-info">
												<div class="col-md-5 name">
													Payment Information:
												</div>
												<div class="col-md-7 value">
													Credit Card
												</div>
											</div> --}}
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="portlet blue-hoki box">
										<div class="portlet-title">
											<div class="caption">
												<i class="fa fa-cogs"></i>Customer Information
											</div>
											<div class="actions">
												<a href="javascript:;" class="btn btn-default btn-sm">
												<i class="fa fa-pencil"></i> Edit </a>
											</div>
										</div>
										<div class="portlet-body">
											<div class="row static-info">
												<div class="col-md-5 name">
													Customer Name:
												</div>
												<div class="col-md-7 value">
													{{$order['user']['first_name']}} {{$order['user']['last_name']}}
												</div>
											</div>
											<div class="row static-info">
												<div class="col-md-5 name">
													Email:
												</div>
												<div class="col-md-7 value">
													{{$order['user']['email']}}
												</div>
											</div>
											<div class="row static-info">
												<div class="col-md-5 name">
													State / Province:
												</div>
												<div class="col-md-7 value">
													{{$order['billing_address']['province']}}
												</div>
											</div>
											<div class="row static-info">
												<div class="col-md-5 name">
													Phone Number:
												</div>
												<div class="col-md-7 value">
													{{$order['billing_address']['phone']}}
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="portlet green-meadow box">
										<div class="portlet-title">
											<div class="caption">
												<i class="fa fa-cogs"></i>Billing Address
											</div>
											<div class="actions">
												<a href="javascript:;" class="btn btn-default btn-sm">
												<i class="fa fa-pencil"></i> Edit </a>
											</div>
										</div>
										<div class="portlet-body">
											<div class="row static-info">
												<div class="col-md-12 value">
													{{$order['billing_address']['first_name']}} {{$order['billing_address']['last_name']}}<br>
													{{$order['billing_address']['address1']}} {{$order['billing_address']['address2']}}<br>
													{{$order['billing_address']['city']}}<br>
													{{$order['billing_address']['province_id']}}<br>
													{{$order['billing_address']['province_id']}}<br>
													Tel: {{$order['billing_address']['phone']}}<br>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="portlet red-sunglo box">
										<div class="portlet-title">
											<div class="caption">
												<i class="fa fa-cogs"></i>Shipping Address
											</div>
											<div class="actions">
												<a href="javascript:;" class="btn btn-default btn-sm">
												<i class="fa fa-pencil"></i> Edit </a>
											</div>
										</div>
										<div class="portlet-body">
											<div class="row static-info">
												<div class="col-md-12 value">
													{{$order['shipping_address']['first_name']}} {{$order['shipping_address']['last_name']}}<br>
													{{$order['shipping_address']['address1']}} {{$order['shipping_address']['address2']}}<br>
													{{$order['shipping_address']['city']}}<br>
													{{$order['shipping_address']['province_id']}}<br>
													{{$order['shipping_address']['province_id']}}<br>
													Tel: {{$order['shipping_address']['phone']}}<br>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
								</div>
								<div class="col-md-6">
									<div class="well">
										<div class="row static-info align-reverse">
											<div class="col-md-8 name">
												 Sub Total:
											</div>
											<div class="col-md-3 value">
												 ${{number_format($order['sum_sub_total'],2)}}
											</div>
										</div>
										<div class="row static-info align-reverse">
											<div class="col-md-8 name">
												 Tax:
											</div>
											<div class="col-md-3 value">
												  ${{number_format($order['sum_tax'],2)}}
											</div>
										</div>
										<div class="row static-info align-reverse">
											<div class="col-md-8 name">
												 Grand Total:
											</div>
											<div class="col-md-3 value">
												 ${{number_format($order['sum_amount'],2)}}
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="details">
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="portlet grey-cascade box">
										<div class="portlet-title">
											<div class="caption">
												<i class="fa fa-cogs"></i>Order Details
											</div>
										</div>
										<div class="portlet-body">
											<div class="table-responsive">
												<table class="table table-hover table-bordered table-striped">
												<thead>
												<tr>
													<th>
														 #
													</th>
													<th>
														 Product
													</th>
													<th>
														 Preview
													</th>
													<th class="text-right">
														 Price
													</th>
													<th class="text-right">
														 Quantity
													</th>
													<th class="text-right">
														 Tax Percent
													</th>
													<th class="text-right">
														 Tax Amount
													</th>
													<th class="text-right">
														 Discount Amount
													</th>
													<th class="text-right">
														 Total
													</th>
												</tr>
												</thead>
												<tbody>
												@foreach($order['order_details'] as $key => $detail)
												<tr>
													<td>
														<a href="{{ URL.'/collections/'.$detail['category'].'/'.$detail['short_name'] }}" target="_blank">
															{{ $key+1 }}
														</a>
													</td>
													<td>
														<a href="{{ URL.'/admin/products/edit-product/'.$detail['product_id'] }}" target="_blank">
														  {{ $detail['name'] }} </a>
													</td>
													<td class="text-center" style="max-width: 10%;">
														{{ file_get_contents(URL.'/get-svg?path='.$detail['svg_file'].'&width=100&height=100') }}<br />
                                        				<a href="{{	URL.'/admin/orders/export-pdf/'.$detail['id'] }}" target="_blank">Export PDF</a>
													</td>
													<td class="text-right">
														 {{number_format($detail['sell_price'],2)}}
													</td>
													<td class="text-right">
														 {{$detail['quantity']}}
													</td>
													<td class="text-right">
														 {{number_format($detail['tax'],2)}}%
													</td>
													<td class="text-right">
														 {{number_format($detail['sum_tax'],2)}}
													</td>
													<td class="text-right">
														 {{$detail['discount']}}%
													</td>
													<td class="text-right">
														 {{number_format($detail['sum_amount'],2)}}
													</td>
												</tr>
												@endforeach
												</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
								</div>
								<div class="col-md-6">
									<div class="well">
										<div class="row static-info align-reverse">
											<div class="col-md-8 name">
												 Sub Total:
											</div>
											<div class="col-md-3 value">
												 ${{number_format($order['sum_sub_total'],2)}}
											</div>
										</div>
										<div class="row static-info align-reverse">
											<div class="col-md-8 name">
												 Tax:
											</div>
											<div class="col-md-3 value">
												  ${{number_format($order['sum_tax'],2)}}
											</div>
										</div>
										<div class="row static-info align-reverse">
											<div class="col-md-8 name">
												 Grand Total:
											</div>
											<div class="col-md-3 value">
												 ${{number_format($order['sum_amount'],2)}}
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>