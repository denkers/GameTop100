@extends('layout.master')

@section('head')
	@parent
	<title>MegaTop100 - Ranking</title>
	{{ HTML::style('css/ranking/ranking.css'); }}
@stop

@section('js')
	@show
	{{ HTML::script('javascript/ranking/ranking.js'); }}	
@stop


@section('content')
	<div id='home_content'>
		<div id='game_nav'>
			<ul id='games_list' class='list-group'>
				<?php $game_list = GamesModel::getGames(); ?>
				@if(isset($games_list))
					@foreach($game as $game_list)
						<li class='list-group-item game_list_item'>$game['name']</li>
					@endforeach	
				@endif
			</ul>
		</div>

		<div id='ranking_content'>
		
		</div>
	</div> 

@stop
