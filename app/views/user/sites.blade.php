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
	<!-- MAIN SITE CONTROLS -->
	<div id='site_controls'>
		<div class='button-group'>
			<!-- ADD SITE CONTROL -->
			<button id='add_site_btn' class='btn btn-default'>
				<a href='{{ URL::route("postAddSite"); }}'>
					<span class='glyphicon glyphicon-plus'></span> Add
				</a>
			</button>

			<!-- PREMIUM SITE CONTROL -->
			<button id='premium_site_btn' class='btn btn-default'>
				<span class='glyphicon glyphicon-star'></span> Premium
			</button>
		</div>
	</div>


	<!-- SITE LIST -->
	<div class='list-group site_group'>
		@foreach($site_list as $site)
			<a class='list-group-item list_site_item clearifx' href='{{ URL::route("getSite", $site->id); }}'>
				<div class='list_site_item_container'>
					<!-- SITE DETAILS -->
					<div class='site_item_details col-md-8'>
						<h5 class='list_site_title'>{{ $site->title; }}
							<br><small>{{ $site->description; }}</small>
						</h5>					
					</div>

					<!-- SITE CONTROLS -->
					<div class='site_item_controls col-md-4'>

						<!-- REMOVE SITE CONTROl -->
						<a class='site_control_link' id='remove_site_control' href='{{ URL::route("postRemoveSite", $site->id); }}'>
							<span class='glyphicon glyphicon-remove'></span>
						</a>
	
						<!-- EDIT SITE CONTROL -->	
						<a class='site_control_link' id='edit_site_control' href='{{ URL::route("postEditSite", $site->id); }}'>
							<span class='glyphicon glyphicon-pencil'></span>
						</a>
					</div>
				</div>
			</a>
		@endforeach
	</div>
</div>

@stop
