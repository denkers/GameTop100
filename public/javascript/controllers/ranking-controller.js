(function()
{
	angular.module('main').controller('rankingController', function($scope, $rootScope)
	{
		$rootScope.getData(site_list_url, function(response)
		{
			$scope.ranking_list		=	response;
		});

		$rootScope.getData(game_list_url, function(response)
		{
			$scope.game_list	=	response;
		});	
	});
})();