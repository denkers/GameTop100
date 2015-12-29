(function()
{
	angular.module('main').controller('mainController', function($scope, $uibModal, $log)
	{
		$scope.open	=	function()
		{
			var modal	=	$uibModal.open
			({
				animation: true,
				windowClass: 'modal fade in',
				templateUrl: 'templates/user/register.blade.php',
				controller: 'popupController',
				size: 'lg',
			});
		};
	});

	angular.module('main').controller('popupController', function($scope)
	{
		
	});
})();
