@extends('layout.master')

@section('head')
	@parent
	<title>MegaTop100 - Home</title>
@stop

@section('js')
	@parent
	{{ HTML::script('javascript/controllers/main-controller.js'); }}
@stop

@section('content')
@stop
