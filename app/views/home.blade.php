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

<div data-ng-controller='mainController'>
<button data-ng-click='open()'>Click</button>
</div>
@stop
