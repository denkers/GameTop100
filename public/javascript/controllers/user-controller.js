(function()
{
	angular.module('main').controller('userController', function($scope, $http, $httpParamSerializer)
	{
		$scope.loginData	=	{};
		
		$scope.login		=	function()
		{
			$http
			({
				url: 'login',
				data: $httpParamSerializer($scope.loginData),
				method: 'POST'
			}).success(function(response)
			{
				console.log(response.message);
			})
			.error(function(response)
			{
				console.log(response);
			})
		};

		$scope.logout		=	function()
		{
			$http.get('user/logout')
			.success(function(response)
			{
				console.log(response);

			}).error(function(response)
			{
				console.log(response);
			});
		};

		$scope.$on('logoutReq', function(event, args)
		{
			$scope.logout();
		});
	});
})();
