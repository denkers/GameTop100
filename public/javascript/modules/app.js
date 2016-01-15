//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	app	
//==================================

angular.module('main', 
[
	'ngAnimate',
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

angular.module('main').run(function($rootScope, $uibModal, $uibModalStack, $http, $httpParamSerializer)
{
	$rootScope.openModal	=	function(template, templateUrl, controller, size)
	{
		size = (size == 'undefined')? 'lg' : size;

		$uibModal.open
		({
			animation:true,
			template: template,
			templateUrl: templateUrl,
			controller: controller,
			size: size
		});
	};

	$rootScope.closeModal	=	function()
	{
		$uibModalStack.dismissAll();
	};

	$rootScope.getData		=	function(url, callBack)
	{
		$http.get(url).success(function(response)
		{
			callBack(response);

		}).error(function(response)
		{
			console.log(response);
		});
	};

	$rootScope.postData		=	function(url, data, callBack)
	{
		var serializedData	=	 $httpParamSerializer(data);
		console.log(serializedData);
		$http
		({
			url: url,
			data: $httpParamSerializer(data),
			method: 'POST'
		}).success(function(response)
		{
			callBack(response);

		}).error(function(response)
		{
			console.log(response);
			callBack(response);
		});
	};

	$rootScope.setParams	=	function(url, params)
	{
		var start	=	'%7B';
		var end		=	'%7D';

		for(var key in params)
			url		=	url.replace(start + key + end, params[key]);

		return url;
	};
});
