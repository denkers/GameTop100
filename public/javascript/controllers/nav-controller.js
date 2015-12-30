(function()
{
	angular.module('main').controller('navController', function($scope, $rootScope, $uibModal, $log)
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

		$scope.openLogout	=	function()
		{
			var logoutModal	=	$uibModal.open
			({
				animation: true,
				template: '<message-modal title="Sign-out" message="Signing out, one moment please"></message-modal>',
				controller: 'userController',
				size: 'lg'
			});

			setTimeout(function()
			{
				$rootScope.$broadcast('logoutReq', []);
			}, 3000);
		};
	});
})();
