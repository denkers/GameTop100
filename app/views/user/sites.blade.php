@extends('layout.master')

@section('head')
	@parent
	{{ HTML::style('css/user/site_manage.css'); }}	
@stop

@section('title_postfix')
	Manage sites
@stop

@section('js')
	@parent
	{{ HTML::script('javascript/user/site_management.js'); }}
@stop

@section('content')
<script>
	var site_fetch_url	=	'{{ URL::route("getMySiteList"); }}';
</script>

<div id='site_list_container'>
	<pre>{{ print_r($site_list); }}</pre>

	<ul class='list-group'>
	</ul>
</div>

@stop
