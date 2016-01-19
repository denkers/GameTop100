@extends('layout.master')

@section('head')
	@parent
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
<div class='container'>
	<div class='center-block user_container'>
		<!-- USER MANAGE CONTROLS -->
		<div id='user_manage_controls' class='col-md-4'>

		</div>

		<!-- USER MANAGE CONTENT -->
		<div id='user_manage_content' class='col-md-8'>
			@yield('user_content')
		</div>
	</div>
</div>
@stop
