(function()
{
	angular.module('main').controller('rankingController', function($scope, $http)
	{
		$scope.loadRankingList	=	function()
		{
			$http.get(site_list_url).then(function(response)
			{
				console.log(response.data);
				$scope.ranking_list		=	response.data;
			});
		};

		$scope.loadGameList		=	function()
		{
			$http.get(game_list_url).then(function(response)
			{
				console.log("response: " + response);
				$scope.game_list	=	response.data;
			});
		};

		$scope.loadGameList();
		$scope.loadRankingList();
	});
})();
