//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	message-modal-directive	
//==================================

(function()
{
	angular.module('main').directive('messageModal', function()
	{
		return {
			restrict:	'E',
			template:	'<div class="modal-header"><h3 class="modal-title">{{title}}</h3></div>' +
			'<div class="modal-body"><h4 class="message-modal-content">{{message}}</h4></div>',
			link: function(scope, elim, attr)
			{
				scope.title		=	attr.title;
				scope.message	=	attr.message;
			}
		};
	});


	angular.module('main').directive('confirmModal', function()
	{
		return {
			restrict: 'E',
			template: '<div class="modal-header"><h3 class="modal-title">{{title}}</h3></div>' +
			'<div class="modal-body"><h4 class="message-modal-content">{{message}}</h4></div>' +
			'<center><div class="btn-group"><button data-ng-click="{{cancelClick}}" class="btn btn-default">Cancel</buttton>' +
			'<button data-ng-click="{{confirmClick}}" class="btn btn-success>">Confirm</button>',
			link: function(scope, elim, attr)
			{
				scope.title			=	attr.title;
				scope.message		=	attr.message;
				scope.cancelClick	=	attr.cancelClick;
				scope.confirmClick	=	attr.confirmClick;
			}
		};
	});
})();
