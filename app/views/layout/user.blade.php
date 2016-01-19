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

@stop
