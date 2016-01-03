(function()
{
	angular.module('main').controller('siteController', function($scope, $rootScope, $http)
	{
		$rootScope.getData(site_list_url, function(response)
		{
			$scope.ranking_list		=	response;
		});

		$rootScope.getData(game_list_url, function(response)
		{
			$scope.game_list	=	response;
		});

		$scope.addComment	=	function(parent_site)
		{
			parent_site.comments.push
			({
				site_id: parent_site.id,
				writter_id: 'kyleruss',
				content: parent_site.comment_add_field
			});	

			parent_site.comment_add_field = '';
		};
	});
})();
