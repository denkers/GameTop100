(function()
{
	angular.module('main').controller('voteController', function($scope, $rootScope, vcRecaptchaService)
	{
		$scope.voteData	=	{};

		$scope.saveVote	=	function(url)
		{
			var params	=	{ site_id: $scope.site.id };
			url			=	$rootScope.setParams(url, params);
			var resp	=	vcRecaptchaService.getResponse();
		};

	});
})();
