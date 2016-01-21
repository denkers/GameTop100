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
@stop


@section('content')
<div class='container col-md-12'>
	<div class='center-block col-md-8' id='user_container'> 
		<!-- USER MANAGE CONTROLS -->
		<div id='user_manage_controls' class='col-md-4'>
			<div class='list-group'>
				<a href='#' class='list-group-item'><h4>Manage sites</h4></a>
				<a href='#' class='list-group-item'><h4>Premium</h4></a>
				<a href='#' class='list-group-item'><h4>Subscriptions</h4></a>
				<a href='#' class='list-group-item'><h4>Notifications</h4></a>
				<a href='#' class='list-group-item'><h4>Settings</h4></a>
			</div>
		</div>

		<!-- USER MANAGE CONTENT -->
		<div id='user_manage_content' class='col-md-8'>
			@yield('user_content')
		</div>
	</div>
</div>
@stop
