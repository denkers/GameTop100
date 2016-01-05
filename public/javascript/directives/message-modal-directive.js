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
})();
