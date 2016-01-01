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
	{{ HTML::script('javascript/controllers/ranking-controller.js'); }}	
@stop


@section('content')
<script>
	var site_list_url	=	'{{ URL::route("getRankingSiteList"); }}';
	var game_list_url	=	'{{ URL::route("getGameList"); }}';
</script>

<div data-ng-controller='rankingController'>
	<div id='home_content'>
		<div id='game_nav'>
			<ul id='games_list' class='list-group'>
				<div class='list-group-item game_list_item clearfix' data-ng-repeat='game in game_list'>
					<div class='game_item_container'>
						<a href='' class='game_item_link'>
							<h4><% game.name %></h4>
						</a>
					</div>
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
								<div class='list-group-item clearfix ranking_item' data-ng-repeat='ranking_item in ranking_list'>
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
												<a href='<% ranking_item.address %>' class='site_link'>
													<% ranking_item.title %>
												</a>

												<div class='site_description'>
													<% ranking_item.description; %>
												</div>
											</div>
										</div>
									</div>

									<div class='vote_details col-md-3'>
										<h3 class='vote_text'>
											<!-- SITE IN VOTES -->
											<span class='site_in_group' data-toggle='tooltip' data-placement='bottom' data-title='Site in-votes'>
												<span class='site_in'>5</span> <span class='glyphicon glyphicon-arrow-up'></span>
											</span>

											<!-- SITE OUT VOTES -->
											<span class='site_out_group' data-toggle='tooltip' data-placement='bottom' data-title='Site out-votes'>
												<span class='site_out'>10</span> <span class='glyphicon glyphicon-arrow-down'></span>
											</span>

											<!-- SITE COMMENTS -->
											<a class='site_comments_group plain_link' data-toggle='tooltip' data-placement='bottom' data-title='Site comments' data-ng-click='ranking_item.showComments = !ranking_item.showComments'>
												<span class='site_comments'><% ranking_item.comments.length %></span> <span class='glyphicon glyphicon-comment'></span>
											</a>
										</h3>
									</div> 

									<!-- SITE COMMENTS CONTAINER -->
									<div class='site_comments_container col-md-12' uib-collapse='!ranking_item.showComments'>
										<div class='show_comments_container'>
											<hr>
											<span class='show_comments_msg'>Showing <% ranking_item.comments.length %> comments</span>
										</div>
											<div class='row comment_item' data-ng-repeat='comment in ranking_item.comments'>
												<div class='col-md-1'>
													<a href='#' class='comment_writter'><% comment.writter_id %></a>
												</div>

												<div class='col-md-6'>
													<p class='comment_content'><% comment.content %></p>
												</div>

												<div class='col-md-5'>
													<div class='comment_rating_container col-md-6'>
														<div class='col-md-1'>
															<span class='comment_rating'>
																<% (comment.comment_rating > 0? '+' : '') + comment.comment_rating; %>
															</span>
														</div>
														<div class='comment_rating_controls col-md-3'>
															<span class='glyphicon glyphicon-chevron-up comment_control comment_upvote'></span>
															<span class='glyphicon glyphicon-chevron-down comment_control comment_downvote'></span>
														</div>	
													</div>

													<div class='comment_controls_container col-md-6'>
														<span class='glyphicon glyphicon-pencil edit_comment_btn'></span>
														<span class='glyphicon glyphicon-remove remove_comment_btn'></span>
														<span class='glyphicon glyphicon-flag report_comment_btn'></span>
													</div>
												</div>
											<div>
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
