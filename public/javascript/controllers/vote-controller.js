(function()
{
	angular.module('main').controller('voteController', function($scope, $rootScope, $interval, vcRecaptchaService)
	{
		$scope.voteData			=	{};
		$scope.voteResponse		=	{};
		$scope.countdownFormat	=	'h [hours,] m [minutes,] s [seconds]';

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

		$scope.voteCountdownTask	=	function()
		{
			var voteMoment			=	moment($scope.voteTime, $scope.countdownFormat);
			var hour				=	voteMoment.hour();
			var minute				=	voteMoment.minute();
			var second				=	voteMoment.second();
			
			if(hour == 0 && minute == 0 && second == 0)
			{
				$interval.cancel($scope.voteCountdownTask);
				$scope.voteTime		=	null;
			}

			else
				$scope.voteTime		=	voteMoment.subtract(1, 's').format($scope.countdownFormat);
		};

		$scope.initTimeFromResponse	=	function(time)
		{
			if(time != undefined && time != null && time.voter_time != null)
			{
				var formatStr		=	'YYYY-MM-DD hh:mm:ss';	
				var currentTime		=	moment(time.current_time, formatStr);
				var voterTime		=	moment(time.voter_time, formatStr);
				var targetTime		=	moment('12:00:00', 'hh:mm:ss');
				var voterDiff		=	$scope.getTimeDifference(currentTime, voterTime);
				var targetDiff		=	$scope.getTimeDifference(targetTime, moment(voterDiff, 'hh:mm:ss'));
				var formattedDiff	=	moment(targetDiff, 'hh:mm:ss').format($scope.countdownFormat);

				$scope.voteTime		=	formattedDiff;
				$interval($scope.voteCountdownTask, 1000);
			}

			else
				$scope.voteTime		=	null;
		};
	});
})();
