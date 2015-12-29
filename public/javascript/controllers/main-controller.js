(function()
{
	angular.module('main').controller('mainController', function($scope, $uibModal, $log)
	{
		$scope.open	=	function()
		{
			var modal	=	$uibModal.open
			({
				animation: true,
				templateUrl: 'templates/user/login.blade.php',
				controller: 'popupController',
				size: 'lg',
			});
		};
	});

	angular.module('main').controller('popupController', function($scope)
	{
		
	});
})();
