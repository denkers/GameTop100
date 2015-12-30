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
				console.log(response);
			})
			.error(function(response)
			{
				console.log(response);
			})
		};
	});
})();
