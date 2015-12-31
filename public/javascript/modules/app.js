angular.module('main', 
[ 
	'ui.bootstrap',
	'ui.bootstrap.tpls'
], function($interpolateProvider)
{
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
}).config(function($httpProvider)
{
	$httpProvider.defaults.headers.post['Accept']		=	'application/json, text/javascript';
	$httpProvider.defaults.headers.post['Content-Type']	=	'application/x-www-form-urlencoded';	
});

angular.module('main').run(function($rootScope, $uibModal, $uibModalStack)
{
	$rootScope.openModal	=	function(template, templateUrl, controller)
	{
		$uibModal.open
		({
			animation:true,
			template: template,
			templateUrl: templateUrl,
			controller: controller,
			size: 'lg'
		});
	};

	$rootScope.closeModal	=	function()
	{
		$uibModalStack.dismissAll();
	};
});
