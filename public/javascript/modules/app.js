angular.module('main', 
[ 
	'ui.bootstrap',
	'ui.bootstrap.tpls'
], function($interpolateProvider)
{
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});
