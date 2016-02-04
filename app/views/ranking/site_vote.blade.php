@extends('layout.master')

@section('head')
	@parent
	{{ HTML::style('css/ranking/ranking.css'); }}
	{{ HTML::style('css/ranking/vote.css'); }}	
@stop

@section('js')
	@parent
	{{ HTML::script('https://www.google.com/recaptcha/api.js'); }}
	{{ HTML::script('javascript/directives/site-directives.js'); }}
	{{ HTML::script('javascript/controllers/vote-controller.js'); }}
	{{ HTML::script('javascript/controllers/site-controller.js'); }}
@stop

@section('title_postfix')
	Vote
@stop

@section('content')
	<div class='container' data-ng-controller='voteController' data-ng-init='site = {{ $site_data }}'>
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


			<div class='row'>
				<div id='vote-container'>	
					<div class='col-md-4'>
						<form name='voteData' method='post'>
							<div data-ng-model='voteData.vote_captcha' class="g-recaptcha" data-sitekey="<% $root.siteKey %>"></div>
						</form>
						<div id='robot_field'></div>
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
		</div>
	</div>
@stop



