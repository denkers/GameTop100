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
	{{ HTML::script('javascript/ranking/ranking.js'); }}	
@stop


@section('content')
	<div id='home_content'>
		<div id='game_nav'>
			<ul id='games_list' class='list-group'>
				<?php $game_list = GamesModel::getGames(); ?>
				@if(isset($game_list))
					@foreach($game_list as $game)
						<div data-gameid='{{ $game["id"]; }}' class='list-group-item game_list_item clearfix'>
							<div class='game_item_container'>
								<a href='{{ URL::route("getRankingList", [$game["id"]]); }}' class='game_item_link'><h4>{{ $game['name'] }}</h4></a>
							</div>
						</div>
					@endforeach	
				@endif
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
						<?php $ranking_test_list = SitesModel::getSitesForGame(1); ?>
						<div class='list-group'>
							@if(isset($ranking_test_list))
								@foreach($ranking_test_list as $ranking_test_item)				
									<div class='list-group-item clearfix ranking_item'>
										<div class='rank_profile col-md-9'>
											<!-- RANK NUMBER -->
											<div class='col-md-2 rank_details'>
												<h5 class='rank_display'>
													1
												</h5>
											</div>
		
											<!-- SITE DETAILS -->
											<div class='col-md-10 site_details'>
												<!-- SITE IMAGE -->
												<div class='site_profile_image'>

												</div>

												<!-- SITE DESCRIPTION -->
												<div class='site_content'>
													<a href='{{ $ranking_test_item["address"]; }}' class='site_link'>
														{{ $ranking_test_item['title'] }}
													</a>

													<div class='site_description'>
														{{ $ranking_test_item['description']; }}
													</div>
												</div>
											</div>
										</div>

										<div class='vote_details' class='col-md-3'>
											<h3 class='vote_text'>
												<span class='site_in'>5</span> <span class='glyphicon glyphicon-arrow-up'></span>
												<span class='site_out'>10</span> <span class='glyphicon glyphicon-arrow-down'></span>
											</h3>
										</div> 
									</div>
								@endforeach
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> 

@stop
