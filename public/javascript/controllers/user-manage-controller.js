//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	user-management-controller		
//==================================

(function()
{
	angular.module('main').controller('userManagementController', function($scope, $rootScope)
	{
		$scope.notificationCount	=	0;

		$scope.$on('decNotificationCount', function(event, args)
		{
			if($scope.notificationCount > 0)
				$scope.notificationCount--;
		});
	});
})();
