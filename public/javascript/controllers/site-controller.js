//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	site-controller	
//==================================

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

		$scope.addComment	=	function(url, parent_site)
		{
			var params		=	{ site_id: parent_site.id };
			url				=	$rootScope.setParams(url, params);
			var data		=	{ comment_content: parent_site.comment_add_field, comment_site: parent_site.id };

			$rootScope.postData(url, data, function(response)
			{
				console.log(response);
				if(response.status)
				{
					parent_site.comments.push
					({
						site_id: parent_site.id,
						writter_id: 'kyleruss',
						content: parent_site.comment_add_field
					});	
					
					parent_site.comment_add_field = '';
				}
			});
		};

		$scope.editComment	=	function(url, comment)
		{
			var params		=	{ site_id: comment.site_id, comment_id: comment.id };
			url				=	$rootScope.setParams(url, params);
		};

		$scope.removeComment	=	function(url, comment)
		{
			var params		=	{ site_id: comment.site_id, comment_id: comment.id };
			url				=	$rootScope.setParams(url, params);
		};
	});
})();
