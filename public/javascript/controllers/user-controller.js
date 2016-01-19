//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	user-controller	
//==================================

(function()
{
	angular.module('main').controller('userController', function($scope, $rootScope, $http, $httpParamSerializer)
	{
		$scope.loginData		=	{};
		$scope.registerData		=	{};
		$scope.loginResponse	=	null;
		$scope.registerResponse	=	null;

		$scope.login		=	function()
		{
			$http
			({
				url: root_url + '/login',
				data: $httpParamSerializer($scope.loginData),
				method: 'POST'
			}).success(function(response)
			{
				$scope.loginResponse	=	response;

				if(response.status)
				{
					setTimeout(function()
					{
						window.location = root_url;
					}, 2000);
				}
			})
			.error(function(response)
			{
				console.log(response);
			});
		};

		$scope.register		=	function()
		{
			$http
			({
				url: root_url + '/register',
				data: $httpParamSerializer($scope.registerData),
				method: 'POST'

			}).success(function(response)
			{
				$scope.registerResponse	=	response;

			}).error(function(response)
			{
				console.log(response);
			});
		};

		$scope.logout		=	function()
		{
			$http.get(root_url + '/user/logout')
			.success(function(response)
			{
				window.location = root_url;

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
