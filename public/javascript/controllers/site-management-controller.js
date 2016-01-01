(function()
{
	angular.module('main').controller('siteManagementController', function($scope, $http)
	{
		$scope.loadUserSites	=	function()
		{
			$http.get(fetch_site_url).then(function(response)
			{
				$scope.site_list	=	response.data;
			});
		};

		$scope.loadUserSites();
	});
})();
