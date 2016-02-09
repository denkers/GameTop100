@extends('layout.master')

@section('head')
	@parent
	{{ HTML::style('css/ranking/ranking.css'); }}
@stop

@section('title_postfix')
Ranking
@stop

@section('js')
	@parent
	{{ HTML::script('javascript/directives/site-directives.js'); }}
	{{ HTML::script('javascript/controllers/ranking-controller.js'); }}
	{{ HTML::script('javascript/controllers/site-controller.js'); }}	
@stop


@section('content')
<script>
	var site_list_url	=	'{{ URL::route("getRankingSiteList"); }}';
	var game_list_url	=	'{{ URL::route("getGameList"); }}';
</script>

<div data-ng-controller='rankingController'>
	<div data-ng-controller='siteController'>
		<div id='home_content'>
			<div id='game_nav'>
				<ul id='games_list' class='list-group'>
					<div class='list-group-item game_list_item clearfix' data-ng-repeat='category in game_category_list'>

						<div class='category_item_container'>
							<h3><strong><% category.name %></strong></h3>
						</div>

						<ul class='list-group'>
							<div class='list-group-item game_item_container' data-ng-repeat='game in category.games'>
								<a href='' class='game_item_link'>
									<h4><% game.name %></h4>
								</a>
							</div>
						</ul>
					</div>
				</ul>
			</div>

			<div id='ranking_content'>
				<div class='container ranking_content_container'>
					<div class='page-header'>
						<h3>Game title
						<br>
						<h5>Game description</h5>
						</h3>
					</div>

					<div class='ranking_container panel panel-default col-md-9'>
						<div class='panel-body'>
							<div class='list-group'>
								<div class='list-group-item' data-ng-repeat='ranking_item in ranking_list'>
										<site site-data='<% ranking_item %>' 
											edit-url='{{ URL::route("postEditComment"); }}' 
											add-url='{{ URL::route("postAddSiteComment"); }}' 
											rate-url='{{ URL::route("postRateComment"); }}' 
											delete-url='{{ URL::route("postRemoveComment"); }}'
											redirect-url='{{ URL::route("postOutSiteVote"); }}'>
										</site>
								</div>
							</div>
						</div>
					</div>
				</div> 
			</div>
		</div>
	</div>
</div>
@stop
