(function()
{
	angular.module('main').controller('rankingController', function($scope, $rootScope)
	{
		$scope.selectedCategory	=	0;

		$rootScope.getData(site_list_url, function(response)
		{
			console.log(response);
			$scope.ranking_list		=	response;
		});

		$rootScope.getData(game_list_url, function(response)
		{
			console.log(response);
			$scope.game_category_list	=	response;
		});

		$scope.toggleGameCategory	=	function(index)
		{
			if($scope.selectedCategory == index)
				$scope.selectedCategory =	null;
			else
				$scope.selectedCategory	=	index;
		};
	});
})();
