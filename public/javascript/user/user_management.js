$(function()
{
	$('#login_form').submit(function(e)
	{
		e.preventDefault();
		var data	=	$(this).serialize();
		var url		=	$(this).attr('action');

		$.ajax
		({
			url: url,
			data: data,
			method: 'post',
			dataType: 'json',
			success: function(response)
			{
				showReturnMessage($('#login_alert'), response.status, 
					response.message, $('#login_alert_msg'));
			},

			error: function(xhr, response, error)
			{
				console.log(xhr.responseText);
			}
		});
	});

	$('#login_btn').click(function(e)
	{
		e.preventDefault();
		$('#login_form').submit();
	});
});
