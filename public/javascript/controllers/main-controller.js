(function()
{
	angular.module('main').controller('mainController', function($scope, $uibModal, $log)
	{
		$scope.open	=	function()
		{
			var modal	=	$uibModal.open
			({
				animation: true,
				templateUrl: 'template/modal/window.html'	
			});
		};
	});
})();
