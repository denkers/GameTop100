(function()
{
	angular.module('main').directive('responseAlert', function()
	{
		return {
			restrict: 'E',
			template: 
			'<uib-alert data-ng-if="{{response.show}}" close="{{dismiss()}}" dismiss-on-timeout="{{dismiss}}"'
			+ 'type="{{response.status? "success" : "danger"}}">'
			+ '<span class="{{response.status? "glyphicon glyphicon-ok-sign" : "glyphicon glyphicon-remove-sign"}}'
			+ '></span>';
			+ '{{response.message}}'
			+ '</uib-alert>',

			link: function(scope, elim, attr)
			{
				scope.response	=	attr.response;
				scope.closeFunc	=	attr.closeFunc;
				scope.dismiss	=	attr.dismiss;
			}
		};
	});
})();
