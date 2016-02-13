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
						<span class='notification-subject'>
							<span class='glyphicon glyphicon-bullhorn'></span> 
							<% notification.subject %>
						</span> 

						<span class='notification-data'>
							<span class='glyphicon glyphicon-calendar'></span> 
							<% notification.created_at %>
						</span> 
	
						<span class='notification-read'>
							<span class='label label-<% notification.read? "default" : "success" %>'>
								<% notification.read? "new" : "old" %>
							</span>
						</span>
					</h3>
				</div>
			</div>
		</div>
	</div>
@stop
