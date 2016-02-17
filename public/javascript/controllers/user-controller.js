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
			if($scope.loginAttempts >= $scope.attemptLimit)
			{
				var response							=	vcRecaptchaService.getResponse();
				$scope.loginData['g-captcha-response']	=	response;
			}

			var data	=	$httpParamSerializer($scope.loginData);
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
			var response									=	vcRecaptchaService.getResponse();
			$scope.registerData['g-captcha-response']		=	response;
			var data										=	$httpParamSerializer($scope.registerData);

			$http
			({
				url: root_url + '/register',
				data: data, 
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
