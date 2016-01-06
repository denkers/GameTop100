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
				parent_site.comment_response		=	response;
				parent_site.comment_response.show	=	true;

				if(response.status)
				{
					parent_site.comments.push(response.comment_data);
					parent_site.comment_add_field = '';
				}
			});
		};

		$scope.editComment	=	function(url, comment, parent_site)
		{
			var params		=	{ site_id: comment.site_id, comment_id: comment.id };
			url				=	$rootScope.setParams(url, params);
			var data		=	{ comment_content: comment.content, comment_id: comment.id };

			$rootScope.postData(url, data, function(response)
			{
				parent_site.comment_response		=	response;
				parent_site.comment_response.show	=	true;
			});
		};

		$scope.removeComment	=	function(url, comment, parent_site, index)
		{
			var params		=	{ site_id: comment.site_id, comment_id: comment.id };
			url				=	$rootScope.setParams(url, params);
			var data		=	{ comment_id: comment.id };

			$rootScope.postData(url, data, function(response)
			{
				parent_site.comment_response		=	response;
				parent_site.comment_response.show	=	true;

				if(response.status)
					parent_site.comments.splice(index, 1);
			});
		};
	});
})();
