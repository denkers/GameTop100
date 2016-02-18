@extends('layout.master')

@section('title_postfix')
	Site view
@stop

@section('head')
	@parent
	{{ HTML::style('css/user/sites_manage.css');  }}
@stop

@section('js')
	@parent
	{{ HTML::script('javascript/controllers/site-controller.js'); }}	
@stop


<div data-ng-controller='siteController'>


</div>
