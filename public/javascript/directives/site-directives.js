(function()
{
	angular.module('main').directive('site', function()
	{
		return {
			restrict: 'E',
			templateUrl: root_url + '/templates/sites/site.blade.php',
			link: function(scope, elim, attr)
			{
				scope.siteData		=	attr.siteData;
			}
		};
	});
})();
