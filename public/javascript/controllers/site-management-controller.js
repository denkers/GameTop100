//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	site-management-controller	
//==================================

(function()
{
	angular.module('main').controller('siteManagementController', function($scope, $rootScope)
	{
		$rootScope.getData(site_list_url, function(response)
		{
			$scope.site_list	=	response;	
		});

		$rootScope.getData(game_list_url, function(response)
		{
			$scope.game_list	=	response;
		});
	});
})();
