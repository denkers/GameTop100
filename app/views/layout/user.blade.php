@extends('layout.master')

@section('head')
	@parent
	{{ HTML::style('css/user/user.css'); }}
	{{ HTML::style('css/user/sites_manage.css'); }}
@stop

@section('title_postfix')
	Manage sites
@stop

@section('js')
	@parent
	{{ HTML::script('javascript/controllers/site-management-controller.js'); }}
	{{ HTML::script('javascript/controllers/user-manage-controller.js'); }}
@stop


@section('content')
<div class='container col-md-12' data-ng-controller='userManagementController' 
data-ng-init='notificationCount={{ NotificationsModel::getNumNotifications(false); }}'>
	<div class='center-block col-md-8' id='user_container'> 
		<!-- USER MANAGE CONTROLS -->
		<div id='user_manage_controls' class='col-md-4'>
			<div class='list-group'>
				<a href='{{ URL::route("getMySites"); }}' class='list-group-item'><h4><span class='glyphicon glyphicon-signal'></span> Manage sites</h4></a>
				<a href='#' class='list-group-item'><h4><span class='glyphicon glyphicon-star'></span> Premium</h4></a>
				<a href='#' class='list-group-item'><h4><span class=' glyphicon glyphicon-heart'></span> Subscriptions</h4></a>
				<a href='{{ URL::route("getNotifications"); }}' class='list-group-item'>
					<h4>
						<span class='glyphicon glyphicon-bullhorn'></span> Notifications 
						<span class='badge'><% notificationCount %></span>
					</h4>
				</a>
				<a href='#' class='list-group-item'><h4><span class='glyphicon glyphicon-cog'></span> Settings</h4></a>
			</div>
		</div>

		<!-- USER MANAGE CONTENT -->
		<div id='user_manage_content' class='col-md-8'>
			@yield('user_content')
		</div>
	</div>
</div>
@stop
