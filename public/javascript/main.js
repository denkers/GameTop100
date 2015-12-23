//Shows a return message in an alert dialog
//container*: pass the .alert container to hold message
//stats: pass true/false or equiv int values for success/fail
//message: the message to be shown in the container
function showReturnMessage(container, status, message, message_container)
{
	var success_class	=	'alert-success';
	var fail_class		=	'alert-danger';
	var fade_time		=	3000;

	$(container).removeClass(fail_class);
	$(container).removeClass(success_class);

	if(status == 0 || status == false) $(container).addClass(fail_class);
	else $(container).addClass(success_class);

	if(typeof message_container == 'undefined')
		message_container = container;

	$(message_container).text(message);
	$(container).hide();
	$(container).removeClass('hide');
	$(container).fadeIn('fast');

	setTimeout(function()
	{
		$(container).fadeOut('fast');
	}, fade_time);
}


function initTooltips()
{
	$('[data-toggle="tooltip"]').tooltip({ container: 'body' });
}


$(function()
{
	$('#register_alert').hide();

	$('#login_alert').hide();

	$('#nav_register_btn').click(function(e)
	{
		e.preventDefault();
		$('#register_modal').modal('show');
	});

	$('#nav_login_btn').click(function(e)
	{
		e.preventDefault();
		$('#login_modal').modal('show');
	});
});
