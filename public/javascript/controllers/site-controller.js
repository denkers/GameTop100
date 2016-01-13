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
			console.log(response);
			$scope.ranking_list		=	response;
		});

		$rootScope.getData(game_list_url, function(response)
		{
			$scope.game_list	=	response;
		});

		$scope.saveComment	=	function(url, parent_site)
		{
			if(parent_site.selectedComment == null)
				$scope.addComment(url, parent_site);
			else
				$scope.editComment(url, parent_site);
		};

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

		$scope.toggleEdit	=	function(comment, index, parent_site)
		{
			if(parent_site.selectedComment != null && parent_site.selectedComment != index)
			{
				var selectedComment			=	parent_site.comments[parent_site.selectedComment];
				selectedComment.isEdit		=	false;
			}

			var isEdit						=	comment.isEdit;
			parent_site.comment_add_field	=	(isEdit)? "" : comment.content;
			parent_site.selectedComment		=	(isEdit)? null : index;
			comment.isEdit					=	!comment.isEdit
		};

		$scope.editComment	=	function(url, parent_site)
		{
			var comment		=	parent_site.comments[parent_site.selectedComment];
			var params		=	{ site_id: comment.site_id, comment_id: comment.id };
			url				=	$rootScope.setParams(url, params);
			var data		=	{ comment_content: comment.content, comment_id: comment.id };

			$rootScope.postData(url, data, function(response)
			{
				parent_site.comment_response		=	response;
				parent_site.comment_response.show	=	true;

				if(response.status)
				{
					comment.content					=	parent_site.comment_add_field;
					parent_site.comment_add_field	=	"";
					comment.isEdit					=	false;
					parent_site.selectedComment		=	null;
				}	
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

		$scope.hideCommentAlert	=	function(item)
		{
			item.comment_response.show	=	false;
		};

		$scope.voteComment	=	function(url, comment, parent_site, isUpvote)
		{
			var params		=	{ site_id: comment.site_id, comment_id: comment.id };
			url				=	$rootScope.setParams(url, params);
			var data		=	{ comment_id: comment.id, is_upvote: isUpvote };
	
			if(comment.user_votes.length)
			{
				var voteBin	=	(isUpvote)? 1 : 0;

				if(comment.user_votes[0].isUpvote == voteBin)
				{
					parent_site.comment_response		=	"You have already voted";
					parent_site.comment_response.show	=	true;	
					return;
				}
			}

			$rootScope.postData(url, data, function(response)
			{
				if(response.status)
				{
					if(isUpvote) comment.comment_rating++;
					else comment.comment_rating--;
				}
				
				else
				{
					parent_site.comment_response		=	"Failed to save comment vote";
					parent_site.comment_response.show	=	true;	
				}
			});
		};
	});
})();
