(function()
{
	angular.module('main').controller('mainController', function($scope)
	{
		$scope.show	=	true;
		$scope.closeAlert	=	function()
		{
			$scope.show		=	false;
		};
	});
})();
