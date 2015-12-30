(function()
{
	angular.module('main').controller('navController', function($scope, $uibModal, $log)
	{
		$scope.openLogin	=	function()
		{
			var loginModal	=	$uibModal.open
			({
				animation: true,
				templateUrl: 'templates/user/login.blade.php',
				controller: 'userController',
				size: 'lg'
			});
		};

		$scope.openRegister	=	function()
		{
			var registerModal	=	$uibModal.open
			({
				animation: true,
				templateUrl: 'templates/user/register.blade.php',
				controller: 'userController',
				size: 'lg'
			});
		};
	});
})();
