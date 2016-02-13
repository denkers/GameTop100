@extends('layout.user')

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
			<div class='panel panel-default' data-ng-repeat='notification in notifications'>
				<div class='panel-heading'>
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
							<span class='label label-<% notification.read? "default" : "success" %>'>
								<% notification.read? "new" : "old" %>
							</span>
						</span>
					</h3>
				</div>

				<div class='panel-body notification-body' uib-collapse='selectedNotification != $index'>
					<div class='notification-content'>

					</div>

					<div class='notification-controls'>
						<div class='btn-group'>
							<button class='btn btn-default'><span class='glyphicon glyphicon-arrow-left'></span> Back</button>
							<button class='btn btn-danger'><span class=' glyphicon glyphicon-remove'></span> Remove</button>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
