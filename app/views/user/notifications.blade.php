@extends('layout.user')

@section('js')
	@parent
	{{ HTML::script("javascript/controllers/notification-controller.js"); }}
@stop

@section('user_content')
	<div data-ng-controller='notificationController'>

	</div>
@stop
