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

		$scope.toggleEditSiteContainer = function(site, index)
		{
			if($scope.site_list.selectedSite != null && $scope.site_list.selectedSite != index)
			{
				var selectedSite				=	$scope.site_list[$scope.site_list.selectedSite];
				selectedSite.showViewContainer	=	false;
			}

			site.showViewContainer = !site.showViewContainer
		};
	});
})();
