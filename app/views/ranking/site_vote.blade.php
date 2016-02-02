@extends('layout.master')

@section('js')
	@parent
	{{ HTML::script('javascript/controllers/vote-controller.js'); }}
@stop

@section('title_postfix')
	Vote
@stop

@section('content')
	<div class='container' data-ng-controller='voteController'>
		<div class='page-header'>
			<h4>Site vote<br><small>Vote for your site</small></h4>
		</div>

		<div class='row'>
		<div class='col-md-4'>	
			<div data-ng-model='voteData.vote_captcha' class="g-recaptcha" data-sitekey="<% $root.siteKey %>"></div>
		</div>

		<div class='col-md-8'>
			<h4><span class='glyphicon glyphicon-info-sign'></span> By voting, you agree to the <a href='#'>terms of service</a></h4>
			<button class='btn btn-lg btn-success col-md-3'><span class='glyphicon glyphicon-ok-sign'></span> Vote</button>
		</div>
		</div>
	</div>
@stop



