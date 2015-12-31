(function()
{
	angular.module('main').controller('navController', function($scope, $rootScope, $uibModal, $log)
	{
		$scope.openLogin	=	function()
		{	
			$rootScope.openModal($uibModal, null, 'templates/user/login.blade.php', 'userController');
		};

		$scope.openRegister	=	function()
		{	
			$rootScope.openModal($uibModal, null, 'templates/user/register.blade.php', 'userController');
		};

		$scope.openLogout	=	function()
		{
			var template	=	'<message-modal title="Sign-out" message="Signing out, one moment please"></message-modal>';
			$rootScope.openModal($uibModal, template, null, 'userController');

			setTimeout(function()
			{
				$rootScope.$broadcast('logoutReq', []);
			}, 3000);
		};
	});
})();
