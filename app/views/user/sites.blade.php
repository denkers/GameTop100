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
<script>
	var site_list_url	=	'{{ URL::route("getMySiteList"); }}';
	var game_list_url	=	'{{ URL::route("getGameList"); }}';
</script>

<div data-ng-controller='siteManagementController'>
	<div id='site_list_container' class='container col-md-5'>
		<div class='page-header'>
			<h3>Manage sites
				<br><small>Add, remove and edit your sites</small>
			</h3>
		</div>
		<!-- MAIN SITE CONTROLS -->
		<div id='site_controls'>
			<div class='btn-group'>
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
		<br>

		<div class='alert alert-dismissable fade in' id='site_alert'>
			<strong>Site notice</strong>
			<p id='site_alert_msg'></p>
		</div>

		<!-- SITE LIST -->
		<ul class='list-group site_group'>
				<li data-ng-repeat='site in site_list' class='list-group-item list_site_item clearifx'>
					<div class='list_site_item_container row'>

						<!-- SITE BANNER -->
						<div class='site_banner col-md-12'>
		
						</div>

						<!-- SITE RANK DETAILS -->
						<div class='site_rank_details col-md-1'>
							<div class='rank_display'>
								2
							</div>
						</div>

						<!-- SITE DETAILS -->
						<div class='site_item_details col-md-7'>
							<h5 class='list_site_title'><% site.title %>
								<br><small><% site.description %></small>
							</h5>					
						</div>

						<!-- SITE CONTROLS -->
						<div class='site_item_controls col-md-4'>

							<!-- REMOVE SITE CONTROl -->
							<a class='site_control_link plain_link remove_site_control' href='{{ URL::route("postRemoveSite", 1); }}'>
								<span class='glyphicon glyphicon-remove'></span>
							</a>
		
							<!-- EDIT SITE CONTROL -->	
							<a data-ng-click='site.showViewContainer = !site.showViewContainer; $event.preventDefault()' class='site_control_link plain_link edit_site_control' href='{{ URL::route("getSite", 1) }}'>
								<span class='glyphicon glyphicon-pencil'></span>
							</a>

							<!-- PREMIUM SITE CONROL -->
							<a class='site_control_link plain_link premium_site_control' href='{{ URL::route("postMakePremiumSite",1); }}'>
								<span class='glyphicon glyphicon-star'></span>
							</a>

							<!-- VIEW SITE CONTROL -->
							<a class='site_control_link plain_link view_site_control' href='<% site.address %>'>
								<span class='glyphicon glyphicon-share-alt'></span>
							</a>
						</div>
					</div>

					<!-- SITE VIEW CONTAINER -->
					<div uib-collapse='!site.showViewContainer' class='site_view_container col-md-12'> 
						<form class='site_edit_form' action='{{ URL::route("postEditSite"); }}' method='post'>
							<input type='hidden' name='s_id' value='<% site.id %>' />
							<div class='input-group'>
								<label>Site title</label>
								<input class='form-control' type='text' name='s_title' required />
							</div>

							<div class='input-group'>
								<label>Site description</label>
								<textarea class='form-control' required name='s_desc'></textarea>
							</div>

							<div class='input-group'>
								<label>Site URL</label>
								<input class='form-control' type='text' name='s_add' required />
							</div>

							<div class='input-group'>
								<label>Game</label>
								<select name='s_game' class='form-control'>
									<option data-ng-repeat='game in game_list' value='<% game.id %>'><% game.name %></option>
								</select>
							</div>
							<button class='btn btn-default cancel_site_btn'>Back</button>
							<button class='btn btn-primary save_site_btn'>Save</button>
						</form>
					</div>
				</li>
		</ul>
	</div>

	<div class='modal fade confirm_modal' id='remove_site_modal' role='dialog'>
		<div class='modal-dialog'>
			<div class='modal-content'>
				<div class='modal-header'>
					<button class='close' data-dismiss='modal'>&times;</button>
					<h3 class='modal-title'>Confirm removal</h3>
				</div>

				<div class='modal-body'>
					<h4>Are you sure you want to remove this site?</h4>

					<div class='btn-group'>
						<button class='btn btn-default' data-dismiss='modal'>Cancel</button>
						<button class='btn btn-danger' id='remove_site_confirm'>Remove</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
