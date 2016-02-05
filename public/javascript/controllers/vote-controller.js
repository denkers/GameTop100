(function()
{
	angular.module('main').controller('voteController', function($scope, $rootScope, vcRecaptchaService)
	{
		$scope.voteData	=	{};

		$scope.saveVote	=	function(url)
		{
			var params		=	{ site_id: $scope.site.id };
			url				=	$rootScope.setParams(url, params);
			var cResponse	=	vcRecaptchaService.getResponse();
			var siteID		=	$scope.site.id;
			var data		=	{ 'site-id': siteID, 'g-captcha-response': cResponse };

			$rootScope.postData(url, data, function(response)
			{
				console.log(response);
			});

		};
	});
})();
