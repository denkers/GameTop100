(function()
{
	angular.module('main').controller('voteController', function($scope, $rootScope)
	{
		$scope.voteData	=	{};

		$scope.saveVote	=	function(url)
		{
			var params	=	{ site_id: $scope.site.id };
			url			=	$rootScope.setParams(url, params);
			console.log(this.voteData);
		};

	});
})();
