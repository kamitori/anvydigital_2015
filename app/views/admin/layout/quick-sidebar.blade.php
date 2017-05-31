<!--BEGIN QUICK SIDEBAR -->
<a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-close"></i></a>
<div class="page-quick-sidebar-wrapper">
	<div class="page-quick-sidebar">
		<div class="nav-justified">
			<ul class="nav nav-tabs nav-justified">
				<li class="active">
					<a href="#chatbox" data-toggle="tab">
					Chat Box
					</a>
				</li>

				<li>
					<a href="#alert" data-toggle="tab">
					Alerts {{-- <span class="badge badge-success">7</span> --}}
					</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active page-quick-sidebar-chat" id="chatbox">
					<div class="page-quick-sidebar-chat-users" data-rail-color="#ddd" data-wrapper-class="page-quick-sidebar-list">
						<?php $messages = []; ?>
						<h3 class="list-heading">Staffs</h3>
						<ul id="staff-chatters" class="media-list list-items">
							@if( isset($messages['admin']) )
							@foreach($messages['admin'] as $message)
							<li class="media" data-chatter-id="{{ $message['from_id'] }}">
								<div class="media-status">
									@if($message['new_message'])
									<span class="badge badge-success">{{ $message['new_message'] }}</span>
									@endif
								</div>
								<img class="media-object" src="{{ URL.'/'.$message['avatar'] }}" alt="...">
								<div class="media-body">
									<h4 class="media-heading">
										{{ $message['from'] }}
									</h4>
									<div class="media-heading-sub">
										{{ $message['position'] }}
									</div>
									<div class="media-heading-small">
										{{ date('h:i d M, Y', $message['time']) }}
									</div>
								</div>
							</li>
							@endforeach
							@endif
						</ul>
						<h3 class="list-heading">Customers</h3>
						<ul id="customer-chatters" class="media-list list-items">
							@if( isset($messages['customer']) )
							@foreach($messages['customer'] as $message)
							<li class="media" data-chatter-id="{{ $message['from_id'] }}">
								<div class="media-status">
									@if($message['new_message'])
									<span class="badge badge-success">{{ $message['new_message'] }}</span>
									@endif
								</div>
								<img class="media-object" src="{{ URL.'/'.$message['avatar'] }}" alt="...">
								<div class="media-body">
									<h4 class="media-heading">
										{{ $message['from'] }}
									</h4>
									<div class="media-heading-sub">
										{{ $message['company'] }}
									</div>
									<div class="media-heading-small">
										{{ date('h:i d M, Y', $message['time']) }}
									</div>
								</div>
							</li>
							@endforeach
							@endif
						</ul>
					</div>
					<div class="page-quick-sidebar-item">
						<div class="page-quick-sidebar-chat-user">
							<div class="page-quick-sidebar-nav">
								<a href="javascript:;" class="page-quick-sidebar-back-to-list"><i class="icon-arrow-left"></i>Back</a>
							</div>
							<div class="page-quick-sidebar-chat-user-form">
								<div class="input-group">
									<textarea id="message-content" class="form-control" placeholder="Type a message here..." style="resize: none;"></textarea>
									<div class="input-group-btn">
										<button type="button" class="btn blue" style="height: 50px;width: 15px;"></button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="tab-pane page-quick-sidebar-alerts" id="alert">
					<div class="page-quick-sidebar-alerts-list">
						<h3 class="list-heading">General</h3>
						<ul class="feeds list-items" id="general-alert"></ul>
						<h3 class="list-heading">System</h3>
						<ul class="feeds list-items" id="system-alert"></ul>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<!-- END QUICK SIDEBAR