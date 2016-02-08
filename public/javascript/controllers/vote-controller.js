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

		$scope.getTimeDifference	=	function(timeA, timeB)
		{
			var difference			=	timeA.diff(timeB);
			var dur					=	moment.duration(difference);
			var timeStr				=	Math.floor(dur.asHours()) + moment.utc(difference).format(':mm:ss');
			
			return timeStr;
		};

		$scope.getTimeFromResponse	=	function(time)
		{
			if(time == undefined || time == null)
				return null;

			else
			{
				console.log(time);
				var formatStr		=	'YYYY-MM-DD hh:mm:ss';	
				var currentTime		=	moment(time.current_time, formatStr);
				var voterTime		=	moment(time.voter_time, formatStr);
				var targetTime		=	moment('12:00:00', 'hh:mm:ss');
				var voterDiff		=	$scope.getTimeDifference(currentTime, voterTime);
				var targetDiff		=	$scope.getTimeDifference(targetTime, moment(voterDiff, 'hh:mm:ss'));

				console.log(targetDiff);
				return targetDiff;
			}
		};
	});
})();
