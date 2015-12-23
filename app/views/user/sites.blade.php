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

@stop
