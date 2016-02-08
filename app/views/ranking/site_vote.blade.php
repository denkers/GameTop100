@extends('layout.master')

@section('head')
	@parent
	{{ HTML::style('css/ranking/ranking.css'); }}
	{{ HTML::style('css/ranking/vote.css'); }}	
@stop

@section('js')
	@parent
	{{ HTML::script('javascript/directives/site-directives.js'); }}
	{{ HTML::script('javascript/controllers/vote-controller.js'); }}
	{{ HTML::script('javascript/controllers/site-controller.js'); }}
@stop

@section('title_postfix')
	Vote
@stop

@section('content')
	<div class='container' data-ng-controller='voteController' 
	data-ng-init='site = {{ $site_data }}; initTimeFromResponse({{ $recent_vote }})'>
		<div class='col-md-9 center-x'>
			<div class='page-header'>
				<h4>Site vote<br><small>Vote for your site</small></h4>
			</div>

			<div class='row'>
				<div class='col-md-12' id='site-container'>
					<div class='list-group-item' data-ng-controller='siteController'> 
						<site site-data='<% site %>' 
							edit-url='{{ URL::route("postEditComment"); }}' 
							add-url='{{ URL::route("postAddSiteComment"); }}' 
							rate-url='{{ URL::route("postRateComment"); }}' 
							delete-url='{{ URL::route("postRemoveComment"); }}'>
						</site>
					</div>
				</div>
			</div>

			<!-- VOTE CONTROLS -->
			<div class='row' data-ng-show='voteTime == null'>
				<uib-alert data-ng-if='voteResponse.show' close='closeVoteResponse()' dismiss-on-timeout='2000'
				type='<% voteResponse.status? "success" : "danger" %>'>
					<span class='<% voteResponse.status? "glyphicon glyphicon-ok-sign" : "glyphicon glyphicon-remove-sign" %>'></span> 
					<% voteResponse.message  %>
				</uib-alert>	
		
				<div id='vote-container'>	
					<!-- ROBOT FIELD -->
					<div class='col-md-4'>
						<div vc-recaptcha key="$root.siteKey"></div>
					</div>

					<div class='col-md-2'></div>

					<div class='col-md-6'>
						<h4 id='terms-notice'><span class='glyphicon glyphicon-info-sign'></span> By voting, you agree to the <a href='#'>terms of service</a></h4>
						<button class='btn btn-lg btn-success col-md-3' data-ng-click='saveVote("{{ URL::route("postSiteVote") }}"); $event.preventDefault()'>
							<span class='glyphicon glyphicon-ok-sign'></span> Vote
						</button>
					</div>
				</div>
			</div>

			<!-- VOTE COUNTDOWN -->
			<div class='row' data-ng-show='voteTime != null'>
				<div class='col-md-12'>
					<h1><% voteTime %></h1>
				</div>
			</div>
		</div>
	</div>
@stop



