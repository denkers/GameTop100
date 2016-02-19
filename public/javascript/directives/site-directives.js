(function()
{
	angular.module('main').directive('site', function()
	{
		return {
			restrict: 'E',
			templateUrl: root_url + '/templates/sites/site.blade.php',
			link: function(scope, elim, attr)
			{
				scope.siteData		=	JSON.parse(attr.siteData);
				scope.editUrl		=	attr.editUrl;
				scope.addUrl		=	attr.addUrl;
				scope.rateUrl		=	attr.rateUrl;
				scope.deleteUrl		=	attr.deleteUrl;
				scope.redirectUrl	=	attr.redirectUrl;
				scope.siteViewUrl	=	attr.siteViewUrl;
			}
		};
	});
})();
