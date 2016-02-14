//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	nav-controller	
//==================================

(function()
{
	angular.module('main').controller('notificationController', function($scope, $rootScope)
	{
		$scope.notifications		=	{};
		$scope.notificationResponse	=	{};

		$scope.toggleNotification	=	function(index)
		{
			if(index == $scope.selectedNotification) 
				$scope.selectedNotification = null;
			else 
				$scope.selectedNotification	=	index;
		};

		$scope.removeNotification	=	function(url)
		{
			if(selectedNotification == null) return;
			else
			{
				var notification	=	$scope.notifications[selectedNotification];
				var params			=	{ notification_id: notification.id };
				var data			=	params;
				url					=	$rootScope.setParams(url, params);

				$rootScope.postData(url, data, function(response)
				{
					$scope.notificationResponse			=	response;
					$scope.notificationResponse.show	=	true;

					if(response.status)
					{	
						notifications.splice(selectedNotification, 1);
						selectedNotification	=	null;
					}
				});
			}
		};
	});
})();
