//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	site-controller	
//==================================

(function()
{
	angular.module('main').controller('siteController', function($scope, $rootScope, $http)
	{	
		$scope.selectedSite	=	null;

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

			console.log(url);
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

		$scope.toggleCommentContainer = function(site)
		{
			site.showComments		=	!site.showComments;
			//$scope.selectedSite	=	$scope.selectedSite == index? null : index;
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
			comment.isEdit					=	!comment.isEdit;
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
			var voteBin		=	(isUpvote)? 1 : 0;

			$rootScope.postData(url, data, function(response)
			{
				if(response.status)
				{
					var amount	=	(comment.user_votes.length > 0)? 2 : 1;

					if(comment.user_votes.length > 0 && comment.user_votes[0].isUpvote == voteBin)
					{
						if(isUpvote)
							comment.comment_rating	=	parseInt(comment.comment_rating) - 1;
						else 
							comment.comment_rating	=  parseInt(comment.comment_rating) + 1;

						comment.user_votes.splice(0, 1);
					}

					else
					{
						if(isUpvote)
							comment.comment_rating	=	parseInt(comment.comment_rating) + amount;
						else 
							comment.comment_rating	=  parseInt(comment.comment_rating) - amount;

						if("added_vote" in response)
							comment.user_votes.push(response.added_vote);
						else
							comment.user_votes[0].isUpvote = voteBin;
					}
				}
				
				else
				{
					parent_site.comment_response		=	"Failed to save comment vote";
					parent_site.comment_response.show	=	true;	
				}
			});

		};

		$scope.getSiteVoteCount	=	function(site)
		{
			var votes		=	site.votes;
			var voteCount	=	{ in_votes: 0, out_votes: 0 };

			if(votes.length > 0)
			{
				for(var i = 0; i < votes.length; i++)
				{
					var vote		=	votes[i];
					var num_votes	=	parseInt(vote.num_votes);

					if(vote.isOut == '1')
						voteCount.out_votes	=	num_votes;
					else
						voteCount.in_votes	=	num_votes;	
				}
			}

			return voteCount;
		};

		$scope.redirectSite	=	function(site, outVoteUrl)
		{
			var params		=	{ site_id: site.id };
			outVoteUrl		=	$rootScope.setParams(outVoteUrl, params);
			var data		=	{ site-id: site.id };	
			var msgTemplate	=	'<message-modal title="Redirect notice" message="Redirecting, one moment please"></message-modal>';
			$rootScope.openModal(template, null, 'siteController');

			setTimeout(function()
			{
				$rootScope.postData(outVoteUrl, data, function(response)
				{
					var url			=	site.address;
					window.location	=	url;
				});
			}, 1500);
		};
	});
})();
