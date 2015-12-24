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

<div id='site_list_container' class='container'>
	<!-- SITE LIST -->
	<ul class='list-group site_group'>
		@foreach($site_list as $site)
			<li class='list-group-item list_site_item clearifx'>
				<div class='list_site_item_container'>
					<!-- SITE DETAILS -->
					<div class='site_item_details col-md-8'>
						<h5 class='list_site_title'>{{ $site->title; }}
							<br><small>{{ $site->description; }}</small>
						</h5>					
					</div>

					<!-- SITE CONTROLS -->
					<div class='site_item_controls col-md-4'>
						<!-- ADD SITE CONTROl -->
						<a class='site_control_link' id='add_site_control' href='#'>
							<span class='glyphicon glyphicon-plus'></span>
						</a>
	
						<a class='site_control_link' id='remove_site_control' href='#'>
							<span class='glyphicon glyphicon-remove'></span>
						</a>
					</div>
				</div>
			</li>
		@endforeach
	</ul>
</div>

@stop
