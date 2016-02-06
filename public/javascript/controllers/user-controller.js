//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	user-controller	
//==================================

(function()
{
	angular.module('main').controller('userController', function($scope, $rootScope, $http, $httpParamSerializer, vcRecaptchaService)
	{
		$scope.loginData		=	{};
		$scope.registerData		=	{};
		$scope.loginResponse	=	null;
		$scope.registerResponse	=	null;
		$scope.loginAttempts	=	0;
		$scope.attemptLimit		=	3;

		$scope.login		=	function()
		{
			$scope.loginAttempts++;
			var data	=	$httpParamSerializer($scope.loginData);	
			if($scope.loginAttempts >= $scope.attemptLimit)
			{
				var response				=	vcRecaptchaService.getResponse();
				data['g-captcha-response']	=	response;
			}

			$http
			({
				url: root_url + '/login',
				data: data,
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
