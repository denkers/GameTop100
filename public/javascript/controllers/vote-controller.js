(function()
{
	angular.module('main').controller('voteController', function($scope, $rootScope, vcRecaptchaService)
	{
		$scope.voteData		=	{};
		$scope.voteResponse	=	{};

		$scope.saveVote	=	function(url)
		{
			var params		=	{ site_id: $scope.site.id };
			url				=	$rootScope.setParams(url, params);
			var cResponse	=	vcRecaptchaService.getResponse();
			var siteID		=	$scope.site.id;
			var data		=	{ 'site-id': siteID, 'g-captcha-response': cResponse };

			$rootScope.postData(url, data, function(response)
			{
				$scope.voteResponse			=	response;
				$scope.voteResponse.show	=	true;	
			});

		};

		$scope.closeVoteResponse	=	function()
		{
			$scope.voteResponse		=	{};
		};
	});
})();
