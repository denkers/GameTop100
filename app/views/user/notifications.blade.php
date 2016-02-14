@extends('layout.user')

@section('head')
	@parent
	{{ HTML::style("css/user/notifications.css"); }}
@stop

@section('js')
	@parent
	{{ HTML::script("javascript/controllers/notification-controller.js"); }}
@stop

@section('user_content')
<script>
	var fetchNotifyUrl	=	'{{ URL::route("getNotificationsList"); }}';
</script>

	<div data-ng-controller='notificationController' data-ng-init='notifications = {{ $notifications}}'>
		<div id='notification-container'>
			<uib-alert data-ng-if='notificationResponse.show' close='closeManageResponseAlert()' dismiss-on-timeout='2000'
			type='<% notificationResponse.status? "success" : "danger" %>'>
				<span class='<% notificationResponse.status? "glyphicon glyphicon-ok-sign" : "glyphicon glyphicon-remove-sign" %>'></span> 
				<% notificationResponse.message  %>
			</uib-alert>
			<div class='panel panel-default' data-ng-repeat='notification in notifications'>
				<div class='panel-heading notification-heading' data-ng-click='toggleNotification($index)'>
					<h3 class='panel-title'>
						<span class='notification-subject notification-header'>
							<span class='glyphicon glyphicon-bullhorn'></span> 
							<% notification.subject %>
						</span> 

						<span class='notification-data notification-header'>
							<span class='glyphicon glyphicon-calendar'></span> 
							<% notification.created_at %>
						</span> 
	
						<span class='notification-read notification-header'>
							<span class='label label-<% notification.isRead? "success" : "default" %>'>
								<% notification.isRead? "old" : "new" %>
							</span>
						</span>
					</h3>
				</div>

				<div class='panel-body notification-body' uib-collapse='selectedNotification != $index'>
					<div class='notification-content'>
						<div class='form-group notify-content-group'>
							<h3><strong>Subject:</strong> <% notification.subject %></h3>
						</div>

						<div class='form-group notify-content-group'>
							<h3><strong>Date sent:</strong> <% notification.created_at %></h3>
						</div>

						<div class='form-group notify-content-group'>
							<h3><strong>Referral link:</strong> 
							<a ng-if='notification.url != null' href='<% notification.url %>'><% notification.url %></a>
							<span ng-if='notification.url == null'>None</span>
						</div>

						<div class='form-group notify-content-group'>
							<h3><strong>Content:</strong></h3>
							<div class='notify-content-container'>
								<% notification.content %>
							</div>	
						</div>
					</div>

					<div class='notification-controls'>
						<div class='btn-group'>
							<button class='btn btn-default'
							data-ng-click='toggleNotification($index)'>
								<span class='glyphicon glyphicon-arrow-left'></span> Close
							</button>

							<button class='btn btn-danger' 
							data-ng-click='removeNotification("{{ URL::route("postDeleteNotification"); }}")'>
								<span class=' glyphicon glyphicon-remove'></span> Remove
							</button>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
